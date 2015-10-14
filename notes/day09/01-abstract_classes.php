<?php

// Abstract classes cannot be instantiated. They only serve as a template/blueprint for children classes
abstract class Product {

    protected $name;

    protected $price;

    public function __construct($price) {
        $this->price = $price;
    }

    // This indicates to programmers that the method must be implemented by children. Functionally the children classes would work the same without this
    // This cannot have any methods or functions in it. It can only be a line of code
    // This is because the purpose of an abstract class is to serve as a template/blueprint for other classes
    abstract function getPrice();

    // You can have non-abstract methods in an abstract class
    public function getName() {
        return $this->name;
    }
}

class HomePageProduce extends Product {

    public function getPrice() {
        return $this->price;
    }
}

class ShoppingCardProduct extends Product {

    public function getPrice() {
        $qty = 10;
        return $this->price * $qty;
    }
}