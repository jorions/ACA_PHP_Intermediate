<?php

class PlayingCard {
    public $suite;
    public $rank;

    // It is a best practice to always have a constructor, and to set every piece of data that you will need in it
    public function __construct($s, $r) {
        $this->suite = $s;
        $this->rank = $r;
    }
}

$aceOfSpades = new PlayingCard('Spades', 'Ace');

echo '<pre>';
print_r($aceOfSpades);