<?php

include_once 'src/TenthFrame.php';

class TenthFrameTest extends PHPUnit_Framework_TestCase {
	
	private $frame;

	public function setUp(){
		$this->frame = new TenthFrame();
	}

    /**
     * @test
     */
    public function isClosed() {
        $this->frame->addRoll(9);
        $this->assertFalse($this->frame->isClosed());
        $this->frame->addRoll(0);
        $this->assertTrue($this->frame->isClosed());
    }

    /**
     * @test
     */
    public function isClosed_spare() {
        $this->frame->addRoll(9);
        $this->assertFalse($this->frame->isClosed());
        $this->frame->addRoll(1);
        $this->assertFalse($this->frame->isClosed());
        $this->frame->addRoll(1);
        $this->assertTrue($this->frame->isClosed());
    }

    /**
     * @test
     */
    public function isClosed_turkey() {
        $this->frame->addRoll(10);
        $this->assertFalse($this->frame->isClosed());
        $this->frame->addRoll(10);
        $this->assertFalse($this->frame->isClosed());
        $this->frame->addRoll(10);
        $this->assertTrue($this->frame->isClosed());
    }

}
