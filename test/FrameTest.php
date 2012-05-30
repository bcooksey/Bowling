<?php

include_once 'src/Frame.php';

class FrameTest extends PHPUnit_Framework_TestCase {
	
	private $frame;

	public function setUp(){
		$this->frame = new Frame();
	}

    /**
     * @test
     */
	public function rolls() {
        $this->assertEmpty($this->frame->getRolls());
        $this->frame->addRoll(5);
        $this->assertCount(1, $this->frame->getRolls());
	}

    /**
     * @test
     */
    public function isSpare() {
        $this->frame->addRoll(5);
        $this->frame->addRoll(5);
        $this->assertTrue($this->frame->isSpare());
    }

    /**
     * @test
     */
    public function isSpare_strike_bowled() {
        $this->frame->addRoll(10);
        $this->assertFalse($this->frame->isSpare());
    }

    /**
     * @test
     */
    public function isStrike() {
        $this->frame->addRoll(10);
        $this->assertTrue($this->frame->isStrike());
    }

    /**
     * @test
     */
    public function isClosed() {
        $this->frame->addRoll(1);
        $this->frame->addRoll(1);
        $this->assertTrue($this->frame->isClosed());
    }

    /**
     * @test
     */
    public function isClose_strike() {
        $this->frame->addRoll(10);
        $this->assertTrue($this->frame->isClosed());
    }
}
