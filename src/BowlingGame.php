<?php


// Post Roll checks
//   if current frame is now closed
//     if two frames ago and last frame are srikes
//        add current score to two frames ago
//     if last frame is a strike or a spare
//        add current score to last frame
//
//     do frame swapping
//
// Pre Roll checks
//    if current frame is now closed
//       do score updain

include_once 'src/Frame.php';
include_once 'src/FrameWithRollAfter.php';
include_once 'src/TenthFrame.php';

class BowlingGame {
    protected $frames = array();
    protected $current_frame;
    protected $previous_frame;
    protected $two_frames_ago;
    protected $game_over = false;

    public function __construct() {
        $this->current_frame = &$this->frames[];
        $this->current_frame = new Frame();
    }
	
	public function bowl($score){
        if ($this->game_over == true) {
            return;
        }

        $this->current_frame->addRoll($score);
        
        // Scoring Rules:
        //   Open Frame - Total Pins
        //   Spare - 10 + next roll
        //   Strike - 10 + next 2 rolls

        if ($this->current_frame->isClosed()) {
            if (count($this->frames) == 10) {
                $this->game_over = true;
            }
            elseif (count($this->frames) == 9) {
                $this->current_frame = new TenthFrame();   

                $this->frames[] = $this->current_frame;

                // TODO: Some other swapping
            }
            else {
                // Handle previous frame
                if ( isset($this->previous_frame) && $this->previous_frame->isStrike() ) {
                    $this->previous_frame = new FrameWithRollAfter($this->previous_frame, $score);
                }
                
                // Sawp frames
//                echo "~~~~~~~~ Frames before ~~~~~~~~\n";
//                var_dump($this->frames);
                $this->two_frames_ago = &$this->previous_frame;
                $this->previous_frame = &$this->current_frame;
                $this->current_frame  = &$this->frames[];
                $this->current_frame  = new Frame();
//                echo "\n ~~~~~~~~~~ Frames after ~~~~~~~~\n";
//                var_dump($this->frames);
            }
        }
        else {
            // Take care of two frames ago
            if (isset($this->two_frames_ago) && $this->two_frames_ago->isStrike() && $this->previous_frame->isStrike()) {
                $this->two_frames_ago = new FrameWithRollAfter($this->two_frames_ago, $score);
            }

            // Handle previous frame
            if (isset($this->previous_frame) && ($this->previous_frame->isStrike() || $this->previous_frame->isSpare()) ) {
                $this->previous_frame = new FrameWithRollAfter($this->previous_frame, $score);
            }
        }
	}

    public function getScore() {
        $score = 0;
        for ($i = 0; $i < count($this->frames); $i++) {
            $score += $this->frames[$i]->getScore();
        }
        return $score;
	}
}
