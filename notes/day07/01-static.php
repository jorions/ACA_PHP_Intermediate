<?php

class Card {

    protected $allowedSuits = array('D', 'H', 'S', 'C');

    /**
     * @return array
     */
    public function getAllowedSuits()
    {

        return $this->allowedSuits;
    }
}

$card = new Card();
$suits = $card->getAllowedSuits();

echo '<pre>';
print_r($suits);


// ###########################################################################################################################
// ############################################### USING STATIC ##############################################################
// ###########################################################################################################################

class CardStatic {

    protected static $allowedSuits = array('D', 'H', 'S', 'C');

    public static function getAllowedSuits() {

        // Use self:: instead of $this-> to access static properties
        return self::$allowedSuits;
    }

    public function getSuits() {
        return self::$allowedSuits;
    }
}

$suitsStatic = CardStatic::getAllowedSuits();

echo '<pre>';
print_r($suitsStatic);
