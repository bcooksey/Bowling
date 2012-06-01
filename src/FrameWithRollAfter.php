<?php

// Decorate's a Frame with an additional roll,
// allowing a frame to compute its own score.

include_once 'src/Frame.php';

class FrameWithRollAfter extends Frame{
    protected $frame;
    protected $roll;

    public function __construct(Frame $frame, $roll) {
        $this->frame = $frame;
        $this->roll = $roll;
    }

    public function getScore() {
        return $this->roll + $this->frame->getScore();
    }

    public function getRolls() { return $this->frame->getRolls(); }
    public function isSpare() { return $this->frame->isSpare(); }
    public function isStrike() { return $this->frame->isStrike(); }
    public function isClosed() { return $this->frame->isClosed(); }
}
