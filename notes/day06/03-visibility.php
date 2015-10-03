<?php

class Animal {

    public $name;
    public $hasHair;

    // Protected properties can only be used inside their class or classes that extend from that class
    protected $isWealthy;
}

class Human extends Animal {

    /**
     * This is a second way to get past the protected $isWealthy - because this function is public it can be access outside of the class,
     * and because this method is inside the class it can access the protected $isWealthy
     */
    public function __construct($isWealthy) {
        $this->wealthy = $isWealthy;
    }



    /**
     * If the person is wealthy say they are, otherwise say they are not (this is one way to get around the protected $isWealthy from
     * the animal class)
     * @return string
     */
    public function checkWealth() {
        if($this->isWealthy) {
            return 'Yeah you\'re doing good.';
        } else {
            return 'Do more work!';
        }
    }
}


$dog = new Animal();
$dog->name = 'Maximus';
$dog->hasHair = true;


$jared = new Human();