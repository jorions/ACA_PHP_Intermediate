<?php

class DatabaseManager {

    /**
     * A static variable for use in the example below
     */
    public static $shouldCache;

    /**
     * Get some data from the DB
     * @return array
     */
    public function getData() {

        // This comes from a database
        return array('persian', 'bob', 'tabby', 'stray');
    }

    /**
     * Get some data formt he DB... again!
     *
     * This "static" function enables you to get the data from the function without having to instantiate a DatabaseManager object
     * This is useful for the example below because without this you need to create a new instance of the DatabaseManager object to access the function
     *
     * @return array
     */
    public static function getStaticData() {
        return array('weiner', 'pug', 'boo bear', 'frog');
    }
}


$query = new DatabaseManager();
$data = $query->getData();

echo '<pre>';
print_r($data);


// This is how you call a static function
$staticData = DatabaseManager::getStaticData();
DatabaseManager::$shouldCache = true;
print_r($staticData);