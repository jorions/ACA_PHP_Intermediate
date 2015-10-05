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

        // Iterate through the allowed suits and automatically build a deck
        foreach($this->allowedSuits as $suit) {

            for($i=0; $i<14; $i++) {

                $this->deck[] = new Card($suit, $i);
            }
        }
    }

    /*
    ###################################################################################################################################
    ###################################### ALTERNATE METHOD THAT MAY BE CLOSER TO INSTRUCTIONS ########################################
    ###################################################################################################################################
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


class Player extends Deck {

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

    /**
     * A string containing every card in the players hand in an HTML-ready format
     * @var string
     */
    public $handRender = "";

    public $score = 0;

    /**
     * Create a player with a name and empty hand of cards
     * @param string $name The player's name
     */
    public function __construct($name) {

        $this->name = $name;
    }

    /*
     * ###################################################################################################################################
     * ######################################## WHEN IS IT APPROPRIATE TO USE "STATIC" METHODS? ##########################################
     * ###################################################################################################################################
     */
    /**
     * Add a card to the player's hand
     * @param Card $card A card object the player receives to put in their hand
     * @return void
     */
    public function receiveCard(Card $card) {

        $this->hand[] = $card;
    }

    /*
    ###################################################################################################################################
    ############################################### WHY DOES THIS NOT WORK? ###########################################################
    ###################################################################################################################################
    public function showHand() {
        foreach($this->hand as $card) {
            $card->render();
        }
    }
    */

    /**
     * Combine all of the player's cards into 1 string that is HTML-ready
     * @return string
     */
    public function showHand() {

        // Start by adding the HTML-formatted player's name to the output string
        $this->handRender = "<div class='hand'><div class='name'><b>$this->name's Cards</b></div>";

        // Iterate through the player's hand and add the HTML-formatted string representation of the card to the output string
        foreach($this->hand as $card) {


            $this->handRender .= "<div class='card-$card->color'>
            <div class='cardValueTopLeft'>$card->finalRank$card->icon</div>
            <div class='cardValueTopRight'>$card->finalRank$card->icon</div>
            <div class='cardSuitMiddle'>$card->icon</div>
            <div class='cardValueBottomLeft'>$card->finalRank$card->icon</div>
            <div class='cardValueBottomRight'>$card->finalRank$card->icon</div>
            </div>";
        }

        $this->handRender .= "</div>";

        return $this->handRender;
    }
}

class Dealer extends Player {

    /**
     * An array of all of the players in the game
     * @var array
     */
    public $players = array();

    /**
     * The number of cards that each player should be dealt
     * @var int
     */
    public $numCards;

    /**
     * A string containing every card in the deck in an HTML-ready format
     * @var string
     */
    public $deckRender = "";

    /**
     * A string containing all player's scores in an HTML-ready format
     * @var string
     */
    public $scoreRender = "";

    /**
     * The array of all winners of the game
     * @var array
     */
    public $winnerArray = array();

    /**
     * The highest score of any of the players
     * @var int
     */
    public $highScore = 0;

    /*
     * ###################################################################################################################################
     * #### IS IT BAD TO USE THE SAME VARIABLE NAME HERE AND IN THE DECK PARENT CLASS? THE VARIABLE DOESN'T EVEN SEEM NECESSARY HERE #####
     * ###################################################################################################################################
     */
    //public $deck;

    public function __construct($allPlayers, $num, Deck $deck) {
        $this->players = $allPlayers;
        $this->numCards = $num;

        /*
         * ###################################################################################################################################
         * ########################### WHY IS THIS REQUIRED? ISN'T THE DECK VARIABLE INHERITED FROM THE PARENT CLASS? ########################
         * ###################################################################################################################################
         */
        $this->deck = $deck;
    }


    public function setupGame() {

        if (count($this->players) > count($this->deck->deck) / $this->numCards) {

            // Initialize variables to count how many more decks are needed
            $extraCardsNeeded = (count($this->players) * $this->numCards) - count($this->deck->deck);
            $extraDecksNeeded = ceil($extraCardsNeeded / count($this->deck->deck));

            // Initialize variables to hold new decks to be added
            $extraCards = array();

            // Create additional decks to add
            for ($i = 0; $i < $extraDecksNeeded; $i++) {

                // Loop through deck and build additional cards array
                foreach ($this->deck->deck as $card) {
                    $extraCards[] = $card;
                }
            }

            // Add new decks to original deck
            $this->deck->deck = array_merge($this->deck->deck, $extraCards);

            // Tell users what happened
            if ($extraDecksNeeded == 1) {
                return "<div class='message'>There are too many players so we have added 1 more deck</div>";
            } else {
                return "<div class='message'>There are too many players so we have added  $extraDecksNeeded more decks</div>";
            }
        }
    }

    public function deals() {
        $this->deck->shuffle();

        foreach ($this->players as $player) {

            for ($i = 0; $i < $this->numCards; $i++) {

                $player->receiveCard($this->deck->getCard());
            }
        }
    }

    public function scoreGame() {
        foreach($this->players as $player) {
            foreach($player->hand as $card) {
                $player->score += $card->rank;
            }
        }
    }

    public function showDeck() {

        $this->deckRender = "<div class='hand'>";

        // Iterate through the deck and add an HTML-formatted string representation of the card image to the output string
        for($i=0; $i<count($this->deck->deck); $i++) {
            $this->deckRender .= "<div class='card-black'><img src='images/card.png' /></div>";
        }

        $this->deckRender .= '</div>';
        return $this->deckRender;
    }

    public function showScores() {

        foreach($this->players as $player) {
            $this->scoreRender .= "<div class='hand'><div class='name'><b>$player->name's Score</b></div>
            <div class='score'>$player->score</div></div>";
        }

        return $this->scoreRender;
    }


    public function determineWinners() {
        foreach($this->players as $player) {
            if($player->score > $this->highScore) {
                $this->highScore = $player->score;
                $this->winnerArray = array();
                $this->winnerArray[] = $player->name;
            } else if($player->score == $this->highScore) {
                $this->winnerArray[] = $player->name;
            }
        }
        return $this->winnerArray;
    }

    public function showWinners() {

        if(count($this->winnerArray) == 1) {
            return "<div class='score'>" . $this->winnerArray[0] . '! With a score of ' . $this->highScore . '!</div>';
        } else if(count($this->winnerArray) == 2) {
            return "<div class='score'>Both " . $this->winnerArray[0] . ' and ' . $this->winnerArray[1] . ' tied with a score of ' . $this->highScore . '!</div>';
        } else if(count($this->winnerArray) >= 3) {
            $tempString = "";
            foreach($this->winnerArray as $winner) {
                $tempString .= $winner . ", ";
            }
            $tempString = substr($tempString, 0, -2);
            return "<div class='score'>" . $tempString . ' all won with a score of ' . $this->highScore . '!</div>';
        }
    }
}



$deck = new Deck();

$jared = new Player("Jared");
$jacy = new Player("Jacy");
$jeremy = new Player("Jeremy");

$allPlayers = array($jared, $jacy, $jeremy);

$dealer = new Dealer($allPlayers, 3, $deck);

echo $dealer->setupGame();

echo "<div class='table'>";

    echo "<div class='headline'><b>The Deck</b></div>";

    echo $dealer->showDeck();

    echo "<div class='divider'></div>";

    $dealer->deals();

    /*
    ###################################################################################################################################
    ####################################### USE THIS APPROACH IF THERE IS NO SHOWHAND() METHOD ########################################
    ###################################################################################################################################
    echo "<div class='table'><div class='hand'>";

    foreach($jared->hand as $card) {
        echo $card->render();
    }

    echo "</div></div>";
    */

    echo "<div class='headline'>Player's Hands</div>";

    foreach($allPlayers as $player) {
        echo $player->showHand();
    }

    echo "<div class='divider'></div>";

    echo "<div class='headline'><b>Score</b></div>";

    $dealer->scoreGame();

    $dealer->determineWinners();

    echo $dealer->showScores();

    echo "<div class='divider'></div>";

    echo "<div class='headline'><b>And The Winner Is...</b></div>";

    echo $dealer->showWinners();


echo "</div>";
/*
 * ###################################################################################################################################
 * ##################################################### OTHER QUESTIONS #############################################################
 * ###################################################################################################################################
 *
 * Can you talk more about ::? What does it really mean? What is a good example of when we could use it for this game?
 *
 * What was the proper method of extending classes from one another? Is there an issue with my implementation?
 *
 * At the top of every class do you put every property you will use, or only those that will be returned by a function? Also, is it okay
 * to assign those properties a value at the top of the class?
 *
 * Is it bad to have a method depend on another method running beforehand? What is the best way to account for this? Ex: $dealer->determineWinners()
 * needs to run before $dealer->showWinners()
 *
 * I did not run an exception throw/catch because the structure of the Deck constructor builds a deck based on the allowedSuits variable. Is this
 * okay? Is it bad to do this because information should be as deconstructed as possible, which would mean it should be made explicitly clear what
 * information is going into building the deck outside of the class itself?
 */