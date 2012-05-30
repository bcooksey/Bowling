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


	public function getScore(){
        // Scoring Rules:
        //   Open Frame - Total Pins
        //   Spare - 10 + next roll
        //   Strike - 10 + next 2 rolls

        $score = 0;
        for ($i = 0; $i < count($this->frames); $i++) {
            if ($this->frames[$i]->isStrike()) {
                if (isset($this->frames[$i+1])) {
                    $next_frame = $this->frames[$i+1];
                    if ($next_frame->isStrike()) {
                        if (isset($this->frames[$i+2])) {
                            $score += array_pop($this->frames[$i+2]->getRolls());
                        }
                        $score += 10; // Next strike
                    }
                    else {
                        $score += array_sum($next_frame->getRolls());
                    }
                }

                $score += 10; // Current Strike
            }
            elseif ($this->frames[$i]->isSpare()) {
                if (isset($this->frames[$i+1])) {
                    $score += array_pop($this->frames[$i+1]->getRolls());
                }
                $score += 10; // Current Spare
            }
            else {
                $score += array_sum($this->frames[$i]->getRolls());
            }
        }
        return $score;
	}
}
