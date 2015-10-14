<?php

class Database {
    /**
     * Instance of itself
     * @var Database
     */
    private static $instance;

    // Make the constructor so nobody can say $db = new Database(...);
    private function __construct($host, $username, $password) {
        // Connect to mysql
        echo 'Connecting to mysql...<br />';
        echo 'Host: ' . $host . ' User:' . $username . ' Pass:' . $password;
        echo '<hr />';
    }

    public static function getInstance($host, $username, $password) {

        // If the $instance variable is not set then create an instance of the database in the $instance variable
        if(!isset(self::$instance)) {

            // Identical to saying self::$instance = new Database($host, $username, $password)
            self::$instance = new self($host, $username, $password);
        }

        return self::$instance;
    }
}


/*
 * THIS IS WHAT WE WOULD DO IF WE WERE NOT USING PRIVATE/STATIC (SINGLETON) DESIGN

// Here is the facebook page
$db = new Database('localhost', 'root', 'root');

// A few thousand lines later
$db = new Database('localhost', 'root', 'root');

// In some other class
$db = new Database('localhost', 'root', 'root');

// ALL OF THIS CREATES MULTIPLE CONNECTIONS UNNECESSARILY

*/


// This will only create one instance of the connection despite being written multiple times
$db = Database::getInstance('localhost', 'root', 'root');
$db = Database::getInstance('localhost', 'root', 'root');
$db = Database::getInstance('localhost', 'root', 'root');