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
	}

    /**
     * @test
     */
    public function bowl_spare() {
        $this->game->bowl(3);
        $this->game->bowl(7);
    }

    /**
     * @test
     */
    public function bowl_strike() {

    }
}
