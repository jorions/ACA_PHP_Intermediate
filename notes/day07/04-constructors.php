<?php

class Animal {

    protected $name;

    public function __construct($name) {

        $this->name = $name;
        $this->doWork();
    }

    public function doWork() {
        // Do work!
    }
}

class Person extends Animal {

    protected $address;

    // Child constructors overwrite parent constructors
    public function __construct($name, $address) {

        // Call the parent constructor to save time
        parent::__construct($name);

        // Assign an additional value
        $this->address = $address;
    }
}