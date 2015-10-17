<?php

class CarFactoryTest {

    public static function createCar($make, $model) {

        // Make first character uppercase
        $className = ucfirst($model);

        // Make sure class exists
        if (!class_exists($className)) {
            throw new Exception($className . ' does not exist!');
        }

        // Instantiate object with dynamic name
        $obj = new $className();

        // Make sure parent class is valid
        if(!get_parent_class($obj) == ucfirst($make)) {
            throw new Exception($className . ' is not a subclass of ' . $make);
        }

        // Return object
        return $obj;
    }

}


class Toyota {

}

class Corolla extends Toyota {

}

class Prius extends Toyota {

}

class Camry extends Toyota {

}

//
$car = CarFactoryTest::createCar("Toyota", "Camry");
print_r($car);