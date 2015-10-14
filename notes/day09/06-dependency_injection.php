<?php

class Door {
    /**
     * small/big/gigantic
     * @var string
     */
    protected $size;

    public function __construct($size) {
        $this->size = $size;
    }
}

class Window {
    /**
     * sliding/opening
     * @var string
     */
    protected $type;

    public function __construct($type) {
        $this->type = $type;
    }
}

class Floor {
    /**
     * tile/carpet/linoleum
     * @var string
     */
    protected $material;

    public function __construct($material) {
        $this->material = $material;
    }
}

// ################################################################################################################
// ################################################### MAKE A HOUSE ###############################################
// ################################################################################################################
class House {

    // These are declared for the proper dependency injection constructor
    protected $door;

    protected $window;

    protected $floor;

    protected $optionalWindow;


    /* BAD EXAMPLE THAT DOESN'T USE DEPENDENCY INJECTION
    public function __construct() {
        $mainDoor = new Door('gigantic');
        print_r($mainDoor);

        $kitchenWindow = new Window('sliding');
        print_r($kitchenWindow);

        $bedroomFloor = new Floor('carpet');
        print_r($bedroomFloor);
    }
    */

    // This uses dependency injection - using objects in the parameters of the method
    public function __construct(Door $door, Window $window, Floor $floor) {
        $this->door = $door;
        $this->window = $window;
        $this->floor = $floor;
    }

    // Setter dependency injection is used for optional dependencies
    public function setWindow($optionalWindow) {
        $this->optionalWindow = $optionalWindow;
    }
}

// This was initially written in the incorrectly overly-dependent constructor
// This area of the code can be unofficially called the SERVICE CONTAINER - a location for you to instantiate all of your objects
// and manage dependencies. This is an actual Symfony construct but we can functionally do the same thing here
$mainDoor = new Door('gigantic');
$kitchenWindow = new Window('sliding');
$bedroomFloor = new Floor('carpet');
$house = new House($mainDoor, $kitchenWindow, $bedroomFloor);