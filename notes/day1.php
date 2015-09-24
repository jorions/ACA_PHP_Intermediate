<?php
/**
 * Created by PhpStorm.
 * User: jaredselcoe
 * Date: 9/15/15
 * Time: 7:45 PM
 */


/*
 * HOTKEYS
 * Command + D duplicates the current line
 * Command + Option + L formats a line of code
 */


/*
 * You can use single  comments as your normal block commenting method
 */


/**
 * You can use double ** comments as doc-block notation
 * @param $name First name only
 * @param $age Age as a number only
 */
function test ($name, $age){
    echo "I am " . $name . " and I am " . $age . " years old.";
}

echo 'I am here';
// This will not create a new line on the page because it is not HMTL, and that's what the browser reads
echo "\n";
// This will create a new line because it is HTML
echo "<br />";
echo 'So am I';


/*
 * PHP is a loosely typed (like data types) language, meaning you give it data, and it fluidly assigns the data type
 * String, integer, floats, and booleans
 */
$name = 'Jared'; // string
$age = 26; // int
$balance = 17.26; // float
$isCool = false; // bool

/*
 * 2 more interesting data types
 */
$fruits = ['orange', 'apple', 'papaya', ['foo', 'bar']]; // shorthand array declaration
$pets = array('dog', 'cat', 'giraffe', 26); // longhand array declaration


/*
 * you can use the <pre> tag in conjuction with print_r to print arrays in an interesting format that
 * is good for visualizing the array
 */

echo '<h4>Printing an array</h4>';
echo '<pre>';
print_r($fruits);
echo '</pre>';


/*
 * Associative Arrays
 */
$user = array(
    'name' => 'Jared',
    'age' => 24,
    'location' => 'Austin'
);

echo '<h4>Associative Array</h4>';
echo '<pre>';
print_r($user);
echo '</pre>';


/*
 * Standard Class Object
 */
$user2 = new stdClass();

$user2->name = 'Jared';
$user2->age = 24;
$user2->location = 'Austin';

echo '<h4>Standard class object</h4>';
echo '<pre>';
print_r($user2->location); // note the syntax is the same as when you refer to class methods
echo '</pre>';


/*
 * When you do a database or API call you receive information as either an associate array or a standard class object
 *
 */

echo '<h4>Problem: Create an array containing the numbers 1 to 100,000</h4>';

$bigarr = [];
for($i = 1; $i <= 100000; $i++) {
    $bigarr[] = $i;
}

echo '<br /><br />';

echo '<h4>Problem: </h4>';