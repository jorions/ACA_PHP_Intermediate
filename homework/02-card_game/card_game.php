<!DOCTYPE html>
<html>
<head>
    <title>Card Game</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>


    <?php

    /**
     * Return an array that represents a deck of cards
     *
     * @return array
     */
    function getDeck()
    {
        // Initialize variables to build deck
        $suits = array("&diams;", "&hearts;", "&spades;", "&clubs;");
        $deck = array();

        // Loop through card suits and append # to build deck
        foreach($suits as $card) {
            for($i=0; $i<15; $i++) {
                $deck[] = $i . $card;
            }
        }

        /*
        // Color code the deck (using by reference for each card to value changes apply outside of foreach
        foreach($deck as &$card) {

            // If the card is diamonds or hearts make it red
            if(strpos($card, "&diams;") || strpos($card, "&hearts;")) {
                $card = "<span style='color:red'>$card</span>";
            }
        }
        */

        // Return deck array
        return $deck;
    }

        /**
         * Shuffle the deck of cards
         *
         * @param array $deck Full deck of cards (passed by ref)
         *
         * @return void
         */
    function shuffleDeck(&$deck)
    {
        // Write a custom function. Don't just use shuffle($deck)

        // Initialize variables to hold shuffled deck and size of original deck
        $shuffledDeck = array();
        $deckSize = count($deck);

        // Iterate through the deck array, constrained by original array size to make sure every card is handled
        for($i=0; $i<$deckSize; $i++) {

            // Define a random card index
            $index = rand(0, count($deck)-1);

            // Move a card from the original deck into the shuffled deck
            $shuffledDeck[] = $deck[$index];
            unset($deck[$index]);

            // Re-index the deck array
            $deck = array_values($deck);
        }

        // Give the deck the shuffledDeck value
        $deck = $shuffledDeck;
    }

    /**
     * @param array $players      An array of player names
     * @param int   $numCards     How many cards to give each player
     * @param array $shuffledDeck A shuffled deck of cards
     *
     * @return array
     */
    function deal($players, $numCards, &$shuffledDeck)
    {
        // Initialize array of players
        $allPlayers = array();

        // Create associative array of players
        for($i=0; $i<count($players); $i++) {
            $allPlayers[$players[$i]] = array();
        }

        // If there are too many players add more decks to original deck
        if(count($players) > count($shuffledDeck)/$numCards) {

            // Initialize variables to count how many more decks are needed
            $extraCardsNeeded = (count($players) * $numCards) - count($shuffledDeck);
            $extraDecksNeeded = ceil($extraCardsNeeded / count($shuffledDeck));

            // Initialize variables to hold new decks to be added
            $extraCards = array();

            // Tell users what happened
            if($extraDecksNeeded == 1) {
                ?><script type="text/javascript" language="javascript">alert('There are too many players so we have added 1 more deck');</script><?php
            } else {
                ?><script type="text/javascript" language="javascript">alert('There are too many players so we have added <?php echo $extraDecksNeeded; ?> more decks');</script><?php
            }

            // Create additional decks to add
            for($i=0; $i<$extraDecksNeeded; $i++) {

                // Loop through deck and build additional cards array
                foreach($shuffledDeck as $card) {
                    $extraCards[] = $card;
                }
            }

            // Add new decks to original deck
            $shuffledDeck = array_merge($shuffledDeck, $extraCards);
        }

        // Loop through array of players and deal cards based on what is available
        for($p=0; $p<count($players); $p++) {

            // Deal all players their cards
            for($i=0; $i<$numCards; $i++) {

                // Get a random index from available cards
                $dealtCardIndex = rand(0, count($shuffledDeck)-1);

                // Add card to player's hand
                $allPlayers[$players[$p]][] = $shuffledDeck[$dealtCardIndex];

                // Unset selected card from the deck
                unset($shuffledDeck[$dealtCardIndex]);

                // Re-index array
                $shuffledDeck = array_values($shuffledDeck);
            }
        }

        // Return array of players
        return $allPlayers;
    }

    /**
     * @param $allPlayers An associative array of all player's name and their hand of cards
     */
    function printHands($allPlayers) {

        // Wrap entire output in styled div
        echo "<div class='table'>";

            // Iterate through array of players
            foreach($allPlayers as $player => $hand) {

                // Wrap each player's hand in styled div
                echo "<div class='hand'>";

                    echo "<div class='name'><b>$player's Hand</b></div>";

                    // Iterate though current player's hand and format output of each card
                    foreach($hand as $card) {

                        // If card value is 10 or greater replace with face (deal with this first and then deal with cards containing "0")
                        if(substr($card, strpos($card, "&")-2, 1) == "1") {
                            $card = str_replace("11", "J", $card);
                            $card = str_replace("12", "Q", $card);
                            $card = str_replace("13", "K", $card);
                            $card = str_replace("14", "K", $card);

                        // Else if the a card contains 0 replace with "A"
                        } else {
                            $card = str_replace("0", "A", $card);
                        }

                        // Color code and print the cards
                        if(strpos($card, "&diams;") || strpos($card, "&hearts;")) {
                            echo "<div class='card-red'>";
                        } else {
                            echo "<div class='card-black'>";
                        }
                                echo "<div class='cardValueTopLeft'>$card</div>";
                                echo "<div class='cardValueTopRight'>$card</div>";
                                echo "<div class='cardSuiteMiddle'>" . substr($card, strpos($card, "&"), 8) . "</div>";
                                echo "<div class='cardValueBottomLeft'>$card</div>";
                                echo "<div class='cardValueBottomRight'>$card</div>";
                            echo "</div>";
                    }

                echo "</div>";
            }
        echo "</div>";
    }


    /**
     * @param $deck An array of a deck of cards
     * @param $label A string that will display above the output deck of cards
     */
    function printDeck($deck, $label) {

        // Wrap entire output in styled div
        echo "<div class='table'>";

            // Wrap deck in styled div
            echo "<div class='hand'>";

                echo "<div class='name'><b>$label</b></div>";

                // Iterate through deck array
                foreach($deck as $card) {

                    // If card value is 10 or greater replace with face (deal with this first and then deal with cards containing "0")
                    if(substr($card, strpos($card, "&")-2, 1) == "1") {
                        $card = str_replace("11", "J", $card);
                        $card = str_replace("12", "Q", $card);
                        $card = str_replace("13", "K", $card);
                        $card = str_replace("14", "K", $card);

                        // Else if the a card contains 0 replace with "A"
                    } else {
                        $card = str_replace("0", "A", $card);
                    }

                    // Color code and print the cards
                    if(strpos($card, "&diams;") || strpos($card, "&hearts;")) {
                        echo "<div class='card-red'>";
                    } else {
                        echo "<div class='card-black'>";
                    }
                            echo "<div class='cardValueTopLeft'>$card</div>";
                            echo "<div class='cardValueTopRight'>$card</div>";
                            echo "<div class='cardSuiteMiddle'>" . substr($card, strpos($card, "&"), 8) . "</div>";
                            echo "<div class='cardValueBottomLeft'>$card</div>";
                            echo "<div class='cardValueBottomRight'>$card</div>";
                        echo "</div>";
                }

            echo "</div>";
        echo "</div>";
    }


    // Crack open a brand new deck of cards
    $deck = getDeck();

    // Shuffle the deck
    shuffleDeck($deck);

    echo 'Deck after shuffling, but before dealing: <br/>';
    print_r($deck);

    printDeck($deck, "Deck After Shuffling, But Before Dealing");

    echo '<br />';
    echo '<br />';

    $players = array('Joe', 'Mary', 'Zim');
    $numCards = 3;

    $playerHands = deal($players, $numCards, $deck);

    //echo 'Hands each player has: <br/>';
    //echo print_r($playerHands);

    printHands($playerHands);

    echo '<br />';
    echo '<br />';


    echo 'Deck after dealing: <br/>';
    echo print_r($deck);

    printDeck($deck, "Deck After Dealing");

    /*
    $newDeck = getDeck();

    shuffleDeck($newDeck);

    deal(5, 5, $newDeck);
    */
?>
</body>
</html>

