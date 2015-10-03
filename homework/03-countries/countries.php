<!DOCTYPE html>
<html>
<head>
    <title>Countries on Earth</title>
</head>
<body>
    <h3>Countries on Earth</h3>
    <form action="<?php echo($_SERVER['PHP_SELF']); ?>" method="POST">
        Enter Country Name: <input type="text" name="country" placeholder="Enter a country" />
        <input type="submit" name="submit" value="Get Details" />
    </form>

    <hr />

    <?php
    // If form has been submitted - this is functionally similar to isset($_POST["submit"])
    if($_POST) {

        // If country is not blank
        if($_POST["country"] != "") {

            $country = $_POST["country"];
            echo "The user entered " . $country . "<br /><br />";

            // Prepare string for API
            $country = strtolower($country);
            $country = htmlentities($country);

            // Get API data and decode into array
            // The @ hides the error that arises if the given country does not exist. This is typically not good to hide an error but in this case
            //   it is dealt with below so it is OK to hide
            $countryArray = @file_get_contents("http://restcountries.eu/rest/v1/name/" . $country);

            if(!empty($countryArray)) {

                // Encode array for use in PHP
                $countryArray = json_decode($countryArray);

                // Iterate through all returned countries
                foreach($countryArray as $countryObject) {

                    // Output
                    // json_decode returns a standard class object, which is like an associative array that you access with arrows instead of keys
                    echo '<h3>' . $countryObject->name . '</h3>';
                    echo 'Capital: ' . $countryObject->capital . '<br />';
                    echo 'Region: ' . $countryObject->region . '<br />';
                    echo 'Population: ' . number_format($countryObject->population) . '<br />';
                    echo 'Languages: ' . implode(', ', $countryObject->languages) . '<br />';
                }

            }

        } else {

            echo "Please enter a country";
        }
    }

    ?>

</body>
</html>