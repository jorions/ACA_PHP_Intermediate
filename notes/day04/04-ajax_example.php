
<html>
<head></head>
<body>
<form name="collectDataForm" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
    <!-- Use a ternary operator to keep the value of the last-entered name or nothing if starting with an empty page -->
    <input type="text" name="favoritePet" size="20" value="<?php echo (isset($_POST['favoritePet']) ? $_POST['favoritePet'] : null); ?>" />
    <input type="submit" value="Do work!" />
</form>
</body>
</html>


<?php

echo $_POST['favoritePet'];

/*
$classMates = array('alex', 'jerry', 'simon', 'samir', 'brian', 'traci', 'jared');

echo $classMates[rand(0,count($classMates)-1)] . " is awesome!";
*/



/*
echo 'GET:';
print_r($_GET);
echo '<br />';

echo 'POST:';
print_r($_POST);
echo '<br />';

//REQUEST is a combination of both GET and POST
echo 'REQUEST:';
print_r($_REQUEST);
echo '<br />';
*/




?>