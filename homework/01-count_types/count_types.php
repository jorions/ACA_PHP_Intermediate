<?php

// Create an input string using heredoc syntax
// Heredoc syntax requires that you add a tag (in this case "MYSTR") and permits you to use special characters without using the escape character \
// The tag can be anything you want - it just indicates when the block of text ends
$inputString
    = <<<MYSTR
Can you feel the pulse in your wrist? For humans the normal pulse is 70 heartbeats per minute.
Elephants have a slower pulse of 27 and for a canary it is 1000!
If all the blood vessels in your body were laid end to end, they would reach about 60,000 miles.
In one day your heart beats 100,000 times.
Half your body’s red blood cells are replaced every seven days.
By the time you are 70.5 you will have easily drunk over 12,000 gallons of water.
Coughing can cause air to move through your windpipe faster than the speed of sound – over a thousand feet
per second, this is a true statement!
Germs only cause disease, right? But a common bacterium, E. Coli, found in the intestine helps us digest
green vegetables and beans (also making gases – pew!). These same bacteria also make vitamin K, which
causes blood to clot. If we didn’t have these germs we would bleed to death whenever we got a small cut!
It takes more muscles to frown than it does to smile, this is not false and a fact.
That dust on rugs and your furniture is not only dirt. It’s mostly made of dead skin cells.
Everybody loses millions of skin cells every day which fall on the floor and get kicked up to
land on all the surfaces in a room. You could say, “That’s me all over.”
It takes food 7.64 seconds to go from the mouth to the stomach via the esophagus.
MYSTR;

function counter($inputString) {

    //prepare the initial counting array
    /** @var array $countArray Result array that contains the counts. You will populate this array with appropriate numbers */
    $countArray = array('num_numeric' => 0, 'num_string' => 0, 'num_bool' => 0);

    //specify the characters to ignore
    $badChars = array("?", ".", "!", ",", "'", "–", "(", ")", "\""); //copied the "-" straight from the test output in my browser because manually typing "-" didn't work. Why?

    //replace new line characters with spaces to prep the string for the explode function
    //you need to use \\ instead of \ to escape the escape character \n
    $inputString = str_replace("\\n", " ", $inputString);

    //replace bad characters with nothing to prep the string for the explode function
    $inputString = str_replace($badChars, "", $inputString);

    //break the string into an array
    /** @var array $wordArray Array of every word in the input string */
    $wordArray = explode(" ", $inputString);

    //count # of integers - create array of all integers and then count the length of that array
    $intArray = array_filter($wordArray, 'is_numeric');
    $countArray['num_numeric'] = count($intArray);

    //count # of bools - iterate through wordArray and count bools
    foreach($wordArray as $item) {
        if(strtolower($item) == "true" || strtolower($item) == "false") {
            $countArray['num_bool']++;
        }
    }

    //count # of strings - count wordArray length then subtract # of ints and bools
    $countArray['num_string'] = count($wordArray) - $countArray['num_numeric'] - $countArray['num_bool'];


/*
    //iterate through the array and identify what each item in the array is
    foreach($wordArray as $item) {
        if(is_int($item)) {
            $countArray['num_numeric']++;
        //search for bool first instead of string so that "true" and "false" aren't counted as strings
        } else if(is_bool($item)) {
            $countArray['num_bool']++;
        } else if(is_string($item)) {
            $countArray['num_string']++;
        }
    }
*/

    echo "<h3># of numbers</h3>";
    echo $countArray['num_numeric'] . "<br />";
    echo "<h3># of strings</h3>";
    echo $countArray['num_string'] . "<br />";
    echo "<h3># of booleans</h3>";
    echo $countArray['num_bool'];
}

counter($inputString);
?>

    