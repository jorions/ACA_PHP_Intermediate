<?php

// This is a contract for the children classes to follow
// This is where you list the methods that all classes that implement the interface must follow
// You cannot define properties like you can with abstract classes
interface ProductPriceInterface {

    public function getPrice();

    // You cannot have bodies for your functions, only single lines indicating the method's name and parameters
    public function setPrice($price);
}

// This class implements the interface described above
// Classes can implement multiple interfaces at the same time
class Product implements ProductPriceInterface {

    protected $name;
    protected $price;

    public function __construct($name, $price) {
        $this->name = $name;
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }
}