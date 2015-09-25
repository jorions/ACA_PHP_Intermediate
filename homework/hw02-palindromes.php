<?php
function palindrome($string) {
    //get length of string
    $length = strlen($string);

    //define variables
    $first_half = array();
    $reverse_second_half = array();

    //if string is even number of chars
    if($length % 2 == 0) {

        //build first array
        for($i = 0; $i < $length/2; $i++) {
            $first_half[] = $string[$i];
        }

        //build second array
        for($i = $length-1; $i >= $length/2; $i--) {
            $reverse_second_half[] = $string[$i];
        }

        //compare arrays
        if($first_half == $reverse_second_half) {
            echo "$string is a palindrome!";
        } else {
            echo "$string is not a palindrome!";
        }

    } else {

        //build first array
        for($i = 0; $i < ($length-1)/2; $i++) {
            $first_half[] = $string[$i];
        }

        //build second array
        for($i = $length-1; $i >= ($length+1)/2; $i--) {
            $reverse_second_half[] = $string[$i];
        }

        //compare arrays
        if($first_half == $reverse_second_half) {
            echo "$string is a palindrome!";
        } else {
            echo "$string is not a palindrome!";
        }
    }
}

palindrome("saas");
echo "<br />";
palindrome("asdf");
echo "<br />";
palindrome("saaas");
echo "<br />";
palindrome("asdfj");
echo "<br />";