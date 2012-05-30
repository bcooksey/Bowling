<?php

class Frame {
    private $rolls = array();

    public function getRolls() { return $this->rolls; }

    public function addRoll($score) {
        $this->rolls[] = $score;
    }

    public function isSpare() {
        return (array_sum($this->rolls) == 10 && count($this->rolls) == 2) ? true : false;
    }

    public function isStrike() {
        return ($this->rolls[0] == 10) ? true : false;
    }

    public function isClosed() {
        return (count($this->rolls) == 2) ? true : false;
    }
}
