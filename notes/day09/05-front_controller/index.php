<?php


// THE .HTACCESS FILE REROUTES EVERY URL REQUEST THE CURRENT FOLDER THROUGH THIS FILE, WHICH IS HOW THIS FILE ACTS AS A CONTROLLER


echo '<pre>';
print_r($_SERVER);

$url = $_SERVER['PHP_SELF'];

echo '$url=' . $url . '<br />';

$request = str_replace(str_replace(str_replace(__DIR__, "", __FILE__), "", $url), "", $_SERVER['REQUEST_URI']);

echo $request;