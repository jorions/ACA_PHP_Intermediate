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

    // Initialize variable to build associative array keys
    $keys = array();

    // Loop through card suits and append # to build deck
    foreach($suits as $card) {
        for($i=1; $i<15; $i++) {
            $deck[] = $i . $card;
        }
    }

    // Build associative array keys
    for($i=0; $i<count($deck); $i++) {
        $keys[] = $i;
    }

    // Combine keys and deck to form new associative array deck
    $deck = array_combine($keys, $deck);

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
    // Shuffle the deck
    shuffle($deck);
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

    // Create array of players
    for($i=0; $i<$players; $i++) {
        $allPlayers[] = array('name' => "Player $i", 'cards' => array());
    }

    // If there are too many players add more decks to original deck
    if($players > count($shuffledDeck)/$numCards) {

        // Initialize variables to count how many more decks are needed
        $extraCardsNeeded = ($players * $numCards) - count($shuffledDeck);
        $extraDecksNeeded = ceil($extraCardsNeeded / count($shuffledDeck));

        // Initialize variables to hold new decks to be added
        $extraKeys = array();
        $extraCards = array();
        $extraDecks = array();

        // Initialize key incrementing variable
        $newKey = count($shuffledDeck);

        // Tell users what happened
        if($extraDecksNeeded == 1) {
            echo "There are too many players so we have added 1 more deck.";
        } else {
            echo "There are too many players so we have added $extraDecksNeeded more decks";
        }

        // Create additional decks to add
        for($i=0; $i<$extraDecksNeeded; $i++) {

            // Loop through deck and build additional keys and cards arrays
            foreach($shuffledDeck as $key => $card) {
                $extraKeys[] = count($shuffledDeck) - 1 + $newKey;
                $extraCards[] = $card;

                // Increase key counter
                $newKey++;
            }
        }

        // Combine keys and deck to form new associative array of extra decks
        $extraDecks = array_combine($extraKeys, $extraCards);

        // Add new decks to original deck
        $shuffledDeck = array_merge($shuffledDeck, $extraDecks);
    }

    print_r($shuffledDeck);
    // Loop through array of players and deal cards based on what is available
    foreach($allPlayers as $currentPlayer) {

        // Deal all players their cards
        for($i=0; $i<$numCards; $i++) {

            // Initialize array of available keys
            $availableKeys = array_keys($shuffledDeck);

            // Get a random key from available cards
            $dealtCardKey = $availableKeys[rand(0, count($availableKeys)-1)];

            // Recast key as string for use as key
            $dealtCardKey = (string)$dealtCardKey;

            // Add card to player's hand
            $currentPlayer['cards'][] = $shuffledDeck[$dealtCardKey];

            // Unset selected card
            unset($shuffledDeck["$dealtCardKey"]);

            // Re-index array
            $shuffledDeck = array_values($shuffledDeck);
        }
    }

    // Return all players and their cards
    foreach($allPlayers as $currentPlayer) {
        echo "<h3>" . $currentPlayer['name'] . "'s Hand</h3>";
        print_r($currentPlayer['cards']);
    }

}

$newDeck = getDeck();

shuffleDeck($newDeck);

deal(5, 50, $newDeck);