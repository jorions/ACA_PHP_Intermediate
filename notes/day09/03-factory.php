<?php

// Structure of a "factory"
// 1. Accept simple inputs
// 2. Normalize that input to match class naming convention
// 3. Validate that class exists
// 4. If the class doesn't exist throw an error, if the class does exist return the object
class CarFactory {

    /**
     * Make a car
     * @param $make Make of the car i.e. toyota, honda, etc...
     * @param $model Model of the car ie. corolla, prius, etc...
     * @throws Exception
     * @return mixed
     */
    public static function getCar($make, $model) {

        // Create first-character-uppercase version of the passed model of the car to be consistent with class names
        $className = ucfirst($model);

        // Make sure the class name is valid
        if(!class_exists($className)) {
            throw new Exception($className . ' has not been created!');
        }

        // Now that we know the class name is valid, create a new object dynamically using the passed model
        $carObject = new $className();

        // Now that we have created an object, pass that object into the get_parent_class function
        $parentClass = get_parent_class($carObject);

        // Now lastly, check to make sure the make is valid (make sure the make given is actually the parent of the model given)
        if(ucfirst($make) != $parentClass) {
            throw new Exception($make . ' is not valid for ' . $model);
        }

        return $carObject;
    }
}

abstract class Toyota {

}

class Corolla extends Toyota {

}

class Camry extends Toyota {

}

class Prius extends Toyota {

}


try {
    $car = CarFactory::getCar('toyota', 'corolla');
    echo '<pre>';
    print_r($car);
} catch (Exception $e) {
    echo '<color="red">' . $e->getMessage();
}