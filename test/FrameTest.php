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
}
