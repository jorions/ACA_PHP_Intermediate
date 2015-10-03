<?php
/**
 * Created by PhpStorm.
 * User: jaredselcoe
 * Date: 9/29/15
 * Time: 7:27 PM
 */


// Set the header of the page - this needs to happen before any other echo statements
// This will impact the way the data is viewed (default is text/html)
header('Content-Type: application/json');

$classMates = array('alex', 'jerry', 'simon', 'samir', 'brian', 'traci', 'jared', array('cat' => 'kelly'));
$numClassMates = count($classMates);
$index = rand(0, $numClassMates -1);

// Anything that you are echoing should use a json_encode
//echo $classMates[$index] . ' ' . date('Y-m-d h:i:s');


// Echo data encoded as json data. You can only do this once in a page otherwise it is invalid
echo json_encode(
    array(
        'name' => $classMates[$index],
        'time' => date('Y-m-d h:i:s')
    )
);

// json = JavaScript Object Notation
// json is a data structure/object that javascript is able to work with
// There are 2 types of databases: SQL (MySQL, Mongo, etc) and NOSQL
// SQL: tables
// NOSQL: arrays like {...,...}
// Most NOSQL database are json datatype
// So we are using json in this example because we are trying to put data from php into a Javascript script, and Javascript needs data to be of type json


/*
 * Data structure
 *
 *  */