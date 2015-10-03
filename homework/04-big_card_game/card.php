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

    /**
     * The suit of the card
     * @var string
     */
    protected $suit;

    /**
     * The rank of the car
     * @var int
     */
    protected $rank;

    /**
     * The color of the card (red or black)
     * @var string
     */
    protected $color;

    /**
     * The HTML format of the card suit
     * @var string
     */
    protected $icon;

    /**
     * The final value of the card (A, J, Q, K, or 1-10)
     * @var string or int
     */
    protected $finalRank;

    /**
     * The various permitted suits for the cards
     * @var array
     */
    protected $allowedSuits = array("Heart", "Diamond", "Spade", "Club");

    /**
     * @param string $suit
     * @param int $rank
     * @throws Exception
     */
    public function __construct($suit, $rank) {
        $this->suit = $suit;
        $this->rank = $rank;

        // NOTE: These functions must go after the property definitions otherwise the function won't know what "suit" or "card" is
        // Make sure the suit is valid
        $this->checkSuit();

        // Assign the card a color based on suit
        $this->colorCard();

        // Create the HTML format of the card suit
        $this->createIcon();

        // Set the final rank for the card (1-10, A, J, Q, K)
        $this->setRank();
    }

    /**
     * Check to see if the suit is valid
     * @throws Exception
     * @return void
     */
    protected function checkSuit() {

        // If the suit of the given card is not listed in the array of legitimate suits then throw an exception
        if(!in_array($this->suit, $this->allowedSuits)) {

            throw new Exception($this->suit . ' is not allowed! You can pass: ' . implode(', ', $this->allowedSuits));
        }
    }

    /**
     * Set the color of the card
     * @return void
     */
    protected function colorCard() {

        // If the card is a diamond or heart, color it red. Otherwise, color it black
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

        // Assign html format icon for card based on its suit
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

        // Assign the face value for the card based on its rank
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

        // Return the div structure for creating a playing card
        return "<div class='card-$this->color'>
            <div class='cardValueTopLeft'>$this->finalRank$this->icon</div>
            <div class='cardValueTopRight'>$this->finalRank$this->icon</div>
            <div class='cardSuitMiddle'>$this->icon</div>
            <div class='cardValueBottomLeft'>$this->finalRank$this->icon</div>
            <div class='cardValueBottomRight'>$this->finalRank$this->icon</div>
        </div>";
    }
}



class Deck extends Card {

    /**
     * The array of the deck of cards
     * @var array
     */
    public $deck = array();

    /**
     * The card object returned from the $deck array
     * @var Card
     */
    public $returnedCard;

    /**
     * Create the deck using the permitted suits
     */
    public function __construct() {
        foreach($this->allowedSuits as $suit) {
            for($i=0; $i<14; $i++) {
                $this->deck[] = new Card($suit, $i);
            }
        }
    }

    /*
    public function __construct($cardArray) {
        $this->deck = $cardArray();
    }
    */

    /**
     * Shuffles the $deck
     * @return void
     */
    public function shuffle() {

        shuffle($this->deck);
    }

    /**
     * Returns the last card from the deck and removes that card from the $deck array
     * @return Card
     */
    public function getCard() {

        $this->returnedCard = array_pop($this->deck);
        return $this->returnedCard;
    }
}


class Player extends Card {

    /**
     * The player's name
     * @var string
     */
    public $name;

    /**
     * The player's hand - an array of card objects
     * @var array
     */
    public $hand = array();

    public function __construct($name) {

        $this->name = $name;
        $this->hand = array();
    }


    public function receiveCard(Card $card) {
        $this->hand[] = $card;
    }

    public function showHand() {
        foreach($this->hand as $card) {
            $card->render();
        }
    }
}







$deck = new Deck();
$jared = new Player("Jared");

echo "<div class='table'><div class='hand'>";

$i = 0;
foreach($deck->deck as $card) {
    echo $card->render();
    if($i<3) {
        $jared->receiveCard($card);
        $i++;
    }
}

$jared->showHand();