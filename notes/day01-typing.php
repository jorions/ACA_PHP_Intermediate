<?php
/**
 * Created by PhpStorm.
 * User: jaredselcoe
 * Date: 9/15/15
 * Time: 8:53 PM
 */
$name = 'Jared';
$age = 24;
$location = 'Austin';
$bankBalance = 25.14;
$pets = array('dog', 'cat', 't-rex');

$fruit = new stdClass();
$fruit->name = 'Apple';
$fruit->color = 'Red';
$fruit->price = 4.33;

if (is_string($name)) {
    echo 'Name is a string';
} else {
    echo 'Name is not a string';
}

echo '<br />';

if (is_int($age)) {
    echo 'Age is an int';
} else {
    echo 'Age is not an int';
}

echo '<br />';

if(is_string($location)) {
    echo 'Location is a string';
} else {
    echo 'Location is not a string';
}

echo '<br />';

if(is_float($bankBalance)) {
    echo 'Bank balance is a float';
} else {
    echo 'Bank balance is not a float';
}

echo '<br />';

// $floatString = (is_float($bankBalance) ? 'Bank balance is a float' : 'Bank balance is not a float');

echo '<b>Alternative method (ternary operator)</b>: ' . (is_float($bankBalance) ? 'Bank balance is a float' : 'Bank balance is not a float');

echo '<br />';

if(is_array($pets)) {
    echo 'Pets is an array';
} else {
    echo 'Pets is not an array';
}

echo '<br />';

if(is_a($fruit, "stdClass")) {
    echo 'Fruit is a standard class';
} else {
    echo 'Fruit is not a standard class';
}
