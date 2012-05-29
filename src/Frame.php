<?php

class Frame {
    private $rolls = array();

    public function getRolls() { return $this->rolls; }
    public function addRoll($score) {
        $this->rolls[] = $score;
    }

}
