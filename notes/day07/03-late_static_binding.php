<?php

class Army {
    public static $strength = 20;

    public static function getStrength() {
        return self::$strength;
    }
}

class Batallion Extends Army {
    public static $strength = 10;
}

echo 'Army strength: ' .Army::getStrength() . '<br />';

// Even though we have redefined the $strength property this will output the original value of 20
echo 'Batallion strength: ' . Batallion::getStrength() . '<br /><br /><br />';


// ###########################################################################################################################
// ############################################# USING LATE STATIC BINDING ###################################################
// ###########################################################################################################################

class ArmyLate {
    public static $strength = 20;

    public static function getStrength() {

        // This means that if a child class calling the method has a static $strength property, that will override
        return static::$strength;
    }
}

class BatallionLate Extends ArmyLate {
    public static $strength = 10;
}

class UnitLate extends BatallionLate {
    public static $strength = 5;
}

echo 'Army strength: ' .ArmyLate::getStrength() . '<br />';

// This will now output 10 because we used late static binding
echo 'Batallion strength: ' . BatallionLate::getStrength() . '<br />';

echo 'Unit strength: ' .UnitLate::getStrength() . '<br />';
