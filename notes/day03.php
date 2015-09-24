<?php
echo "<h1>Scope</h1>";

echo "You must specifically define a variable within a scope of the function in order for it to be accessed.<br />";

echo "Incorrect implementation:<br />";
$outsideFunction = "outside";
wrongFunction();
function wrongFunction() {
    $insideFunction = "inside";
    echo "Outside: $outsideFunction\n";
    echo "Inside: $insideFunction\n";
}

echo "Correct implementation<br />";
rightFunction();
function rightFunction() {
    $outsideFunction = "outside";
    $insideFunction = "inside";
    echo "Outside: $outsideFunction\n";
    echo "Inside: $insideFunction\n";
}

/*
 * #################################################################################################################
 * ##################################### Private/Protected/Public ##################################################
 * #################################################################################################################
 */


echo "<h1>Private/Protected/Public</h1>";

echo "private can only be seen by the parent class<br />";
echo "protected can be seen by the father class and any class that extends the parent class<br />";
echo "public can be seen by any class<br /><br />";

class Vehicle {
    public $wheels;
    public $hydraulics;
    public $brand;

    private $vin;

    protected $safetyRating = "AAA";
}

class SUV extends Vehicle {
    public $name;
    public $price;
    public $SUVSafety;

    //constructor function that is used when an instance of the SUV class is created (instantiated)
    function __construct() {
        echo "Constructor called<br />";
        $SUVSafety = $this->safetyRating;
    }
}

function makeSUV() {
    $Jeep = new SUV();
    $Jeep->name = "Jeep";
    $Jeep->wheels = "Offroad Tires";

    return $Jeep;
}

//instantiate an instance of the SUV class using the makeSUV function.
//you cannot access protected variables outside of a class so SUVSafety will return nothing (??IS THIS CORRECT??)
$myJeep = makeSUV();
echo "Jeep Info: $myJeep->name, $myJeep->wheels, $myJeep->SUVSafety";


/*
 * #################################################################################################################
 * #################################################### Arrays #####################################################
 * #################################################################################################################
 */

echo "<h1>Arrays</h1>";

$zoo = array(
    'zone_1' => "Monkey",
    'zone_2' => "Giraffe",
    'zone_3' => "Rhino");

print_r($zoo);
echo "<br />";

$newZone = 'zone_4';
$newAnimal = "Lemur";

//add a new animal to the zoo using the key we just defined
$zoo[$newZone] = $newAnimal;
print_r($zoo);
echo "<br />";

//update the information for an item in the array using a defined key
$zoo['zone_2'] = "Gorilla";
print_r($zoo);
echo "<br />";

//remove a piece of data from the array using a defined key
unset($zoo['zone_1']);
print_r($zoo);
echo "<br />";

//make one of the zones an array and then add an animal
$zoo['zone_2'] = array($zoo['zone_2'], "Chimpanzee");
print_r($zoo);
echo "<br />";

//associative arrays do not have indexes so the following won't work
echo "This is going to be an error:";
echo "$zoo[1] <br />";

//but the following will work
echo $zoo['zone_2'][0];


/*
 * #################################################################################################################
 * ################################################## Challenges ###################################################
 * #################################################################################################################
 */

echo "<h1>Challenge 1</h1>";
echo "Take a theoretically infinitely large integer as a string, add 1, and then return that value.<br />";


function stringAddTwo($num) {
    //get index location of last item in string
    $lastNum = strlen($num) - 1;

    $finalNum = "";

    //turn string into array
    $num = str_split($num);

    //if the last number is less than nine then simply add 1 and you're done
    if($num[$lastNum] < 9) {
        $num[$lastNum]++;
        foreach($num as $digit) {
            $finalNum .= $digit;
            return $finalNum;
        }
    //else
    } else {
        $indexFirstNonNine = getFirstNonNineIndex($num);
        $num[$indexFirstNonNine]++;
        for($i = ($indexFirstNonNine + 1); $i < count($num); $i++) {
            $num[$i] = "0";
        }
        foreach($num as $digit) {
            $finalNum .= $digit;
            return $finalNum;
        }
    }
}

function getFirstNonNineIndex($numArray) {
    $index = count($numArray);
    for($i = count($numArray) - 1; $i >= 0; $i--) {
        if($numArray[$i] != 9) {
            return $index;
        } else {
            $index--;
        }
    }
}

print_r(stringAddTwo("12349"));



/*
 * #################################################################################################################
 * ########################################## By Reference vs By Value #############################################
 * #################################################################################################################
 */

echo "<h1>By Reference VS By Value</h1>";

//this will actually edit the passed variable in memory
function byRef(&$val) {
    $val++;
    return 1;
}

//this will make a copy of the passed variable and edit it
function byVal($val) {
    $val++;
    return 1;
}

$num = 3;

echo $num . "<br />";

byVal($num);
echo "After By Value: $num<br />";
byRef($num);
echo "After By Reference: $num<br />";