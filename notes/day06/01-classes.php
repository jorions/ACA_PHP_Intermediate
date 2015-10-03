<?php

// Define a class
class Person {

    // Create properties ("property" = a variable inside of a class)
    public $name;
    public $age;
    public $location;

    protected $socialSecurityNumber;

    private $bankAccountNumber;

    // Create a method ("method" = a function inside of a class)
    // By default the visibility of a method is public if you don't specify
    function isThisPersonCool() {

        // $this is a placeholder that represents the object of an instantiated class (for ex: "chelsea")
        if($this->location == 'Austin') {
            return 'Hell yeah your\'e cool!';
        } else {
            return 'No you\'re not, but please don\'t move here';
        }
    }
}

// Use the class (ie instantiate the class into an object
$chelsea = new Person();

$chelsea->name = 'Chelsea';
$chelsea->age = 24;
$chelsea->location = 'Austin';

echo '<pre>';
print_r($chelsea);