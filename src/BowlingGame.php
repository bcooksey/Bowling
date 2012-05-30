<?php

include_once 'src/Frame.php';

class BowlingGame {
    protected $frames;
    protected $current_frame;
	
	public function bowl($score){
        if (is_null($this->current_frame) || $this->current_frame->isClosed()) {
            $this->current_frame = new Frame();
            $this->frames[] = $this->current_frame;
        }

        $this->current_frame->addRoll($score);
	}

    public function getScore() {
        // Scoring Rules:
        //   Open Frame - Total Pins
        //   Spare - 10 + next roll
        //   Strike - 10 + next 2 rolls

        $score = 0;
        for ($i = 0; $i < count($this->frames); $i++) {
            if ($this->frames[$i]->isStrike()) {
                $score += $this->scoreStrike($i);
            }
            elseif ($this->frames[$i]->isSpare()) {
                $score += $this->scoreSpare($i);
            }
            else {
                $score += array_sum($this->frames[$i]->getRolls());
            }
        }
        return $score;
	}

    protected function scoreStrike($i) {
        $frame_score = 0;
        if (isset($this->frames[$i+1])) {
            $next_frame = $this->frames[$i+1];
            if ($next_frame->isStrike()) {
                if (isset($this->frames[$i+2])) {
                    $frame_score += array_pop($this->frames[$i+2]->getRolls());
                }
                $frame_score += 10; // Next strike
            }
            else {
                $frame_score += array_sum($next_frame->getRolls());
            }
        }

        $frame_score += 10; // Current Strike
        return $frame_score;
    }

    protected function scoreSpare() {
        $frame_score = 0;
        if (isset($this->frames[$i+1])) {
            $frame_score += array_pop($this->frames[$i+1]->getRolls());
        }

        $frame_score += 10; // Current Spare
        return $frame_score;
    }
}
