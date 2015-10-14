<?php

// A session will create a cookie locally, which will get sent to the server on every HTTP request
// The cookie has a unique ID that the server associates with your browser
// Even if you open a separate php file on the server the cookie will persist

// This sends a cookie to the browser in the "response header" if the cookie doesn't exist
session_start();

// This will return nothing
echo '<pre>';
print_r($_SESSION);

// This adds data to the cookie. Once this is run once, even if it is removed from the code the value will persist
$_SESSION['name'] = 'Jared';

// This will now output info
print_r($_SESSION);
