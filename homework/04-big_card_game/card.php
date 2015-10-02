<!DOCTYPE html>
<html>
<head>
    <title>Card Game</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>



<?php


/**
 * Class Card represents and encapsulates data and functionality for a playing card
 */
class Card {

    // Define properties
    protected $suit;
    protected $rank;

    protected $color;
    protected $icon;
    protected $finalRank;

    protected $allowedSuits = array("Heart", "Diamond", "Spade", "Club");

    /**
     * @param string $suit
     * @param int $rank
     * @throws Exception
     */
    public function __construct($suit, $rank) {
        $this->suit = $suit;
        $this->rank = $rank;

        // This must go after the property definitions otherwise the function won't know what "suit" or "card" is
        $this->checkSuit();

        $this->colorCard();

        $this->createIcon();

        $this->setRank();
    }

    /**
     * Check to see if the suit is valid
     * @throws Exception
     * @return void
     */
    protected function checkSuit() {
        if(!in_array($this->suit, $this->allowedSuits)) {
            throw new Exception($this->suit . ' is not allowed! You can pass: ' . implode(', ', $this->allowedSuits));
        }
    }

    /**
     * Set the color of the card
     * @return void
     */
    protected function colorCard() {
        if($this->suit == 'Diamond' || $this->suit == 'Heart') {
            $this->color = 'red';
        } else {
            $this->color = 'black';
        }
    }

    /**
     * Create an icon for the card
     * @return void
     */
    protected function createIcon() {
        switch($this->suit) {
            case "Heart":
                $this->icon = "&hearts;";
                break;
            case "Diamond":
                $this->icon = "&diams;";
                break;
            case "Spade":
                $this->icon = "&spades;";
                break;
            case "Club":
                $this->icon = "&clubs;";
        }
    }

    /**
     * Set the face value for the card
     * @return void
     */
    public function setRank() {
        switch($this->rank) {
            case 0:
                $this->finalRank = "A";
                break;
            case 11:
                $this->finalRank = "J";
                break;
            case 12:
                $this->finalRank = "Q";
                break;
            case 13:
                $this->finalRank = "K";
                break;
            default:
                $this->finalRank = $this->rank;
                break;
        }
    }

    /**
     * Return the final card with color, suite, and rank
     * @return string
     */
    public function render() {

        return "<div class='card-$this->color'>
            <div class='cardValueTopLeft'>$this->finalRank$this->icon</div>
            <div class='cardValueTopRight'>$this->finalRank$this->icon</div>
            <div class='cardSuitMiddle'>$this->icon</div>
            <div class='cardValueBottomLeft'>$this->finalRank$this->icon</div>
            <div class='cardValueBottomRight'>$this->finalRank$this->icon</div>
        </div>";
    }
}


echo "<div class='table'><div class='hand'>";

function getDeck()
{
    // Initialize variables to build deck
    $suits = array("Diamond", "Heart", "Spade", "Club");
    $deck = array();

    // Loop through card suits and append # to build deck
    foreach($suits as $card) {
        for($i=0; $i<14; $i++) {
            $deck[] = $i . $card;
            $tempCard = new Card($card, $i);
            echo $tempCard->render();

        }
    }
    // Return deck array
    //return $deck;
}

getDeck();