<?php

/**
 * Return an array that represents a deck of cards
 *
 * @return array
 */
function getDeck()
{
    // Initialize variables to build deck
    $suits = array("D", "H", "S", "C");
    $deck = array();

    // Initialize variable to build associative array keys
    $keys = array();

    // Loop through card suits and append # to build deck
    foreach($suits as $card) {
        for($i=1; $i<15; $i++) {
            $deck[] = $i . $card;
        }
    }

    // Build associative array names
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
    // Initialize array for storing shuffled deck
    $tempDeck = array();

    // Iterate through the deck of cards
    foreach($deck as $card) {


        // Iterate th
        foreach($tempDeck as $tempCard) {
            if($card == $tempCard) {

            }
        }
    }
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

}


getDeck();