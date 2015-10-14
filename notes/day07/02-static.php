<?php

class DatabaseAccess {
    public static $shouldCache = false;

    public function getData() {
        if (self::$shouldCache == true) {
            return 'data from cache';
        } else {
            return 'data from database';
        }
    }
}

// Getting user data
$db = new DatabaseAccess();
$dataOriginal = $db->getData();
echo $dataOriginal;
echo '<br />';



// Getting a blog post
DatabaseAccess::$shouldCache = true;
$db1 = new DatabaseAccess();
$data = $db1->getData();
echo 'DB1 data: ' .$data;
echo '<br />';

// Get another blog post
$db2 = new DatabaseAccess();
$data = $db2->getData();
echo 'DB2 data: ' .$data;
echo '<br />';

// Look at original value again
echo 'DB-Original: ' .$dataOriginal;


// ###########################################################################################################################
// ##### BASICALLY, IF YOU UPDATE A STATIC PROPERTY ALL NEW INSTANTIATIONS OF THAT OBJECT WILL USE THAT UPDATED VALUE, #######
// ############### BUT ALL INSTANCES THAT WERE CREATED PRIOR TO THE CHANGE STILL HAVE THEIR OWN UNIQUE VALUE #################
// ###########################################################################################################################