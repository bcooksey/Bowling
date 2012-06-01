<?php

include_once 'src/BowlingGame.php';

class BowlingGameTest extends PHPUnit_Framework_TestCase {
	
	private $game;

	public function setUp(){
		$this->game = new BowlingGame();
	}

    /**
     * @test
     */
	public function bowl(){
        $this->game->bowl(3);
        $this->game->bowl(4);
        $this->assertEquals(7, $this->game->getScore());
	}

    /**
     * @test
     */
    public function bowl_spare() {
        $this->game->bowl(3);
        $this->game->bowl(7);
        $this->game->bowl(1);
        $this->assertEquals(12, $this->game->getScore());
    }

    /**
     * @test
     */
    public function bowl_strike() {
        $this->game->bowl(10);
        $this->game->bowl(7);
        $this->game->bowl(2);
        $this->assertEquals(28, $this->game->getScore());
    }

    /**
     * @test
     */
    public function bowl_double() {
        $this->game->bowl(10);
        $this->game->bowl(10);
        $this->game->bowl(2);
        $this->game->bowl(2);
        $this->assertEquals(40, $this->game->getScore());
    }

    /**
     * @test
     */
    public function bowl_turkey() {
        $this->game->bowl(10);
        $this->game->bowl(10);
        $this->game->bowl(10);
        $this->game->bowl(2);
        $this->game->bowl(2);
        $this->assertEquals(70, $this->game->getScore());
    }

    /**
     * @test
     */
    public function bowl_tenth_frame() {
        for ($i = 0; $i < 18; $i++) {
            $this->game->bowl(0);
        }
        $this->game->bowl(10);
        $this->game->bowl(10);
        $this->game->bowl(10);
        $this->assertEquals(30, $this->game->getScore());
    }
}
