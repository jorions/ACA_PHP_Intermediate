<html>
<head>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <script>
        // The $ symbol is equivalent to saying jQuery, which is why document is in ( ) - document is an argument for the $ function
        $(document).ready(function() {

            // Bind to the click even of the button based on its ID
            // Use function() { } because "function" is essential for the code to be executed. It won't work if you just use the "console.log" portion in lieu of "function()"
            $("#btn-fetch-data").on('click', function () {
               console.log('I was clicked!');

                // Display data output from server_data.php
                $.ajax({
                    url: "server_data.php",
                    dataType: "json",
                    // Will put the following information in as parameters to the called page server_data.php
                    // ex: server_data.php?action=get_scores&student=Jared+Selcoe
                    data: {
                        action: 'get_scores',
                        list: 'Jared Selcoe'
                    },
                    // This runs when the json is successfully called
                    success: function(jsonData) {

                        // Example of looping through array of json data
                        //for(key in jsonData) {
                        //    console.log('key=' + key);
                        //    console.log('value=' + jsonData[key]);
                        //}

                        // How to create an array using json data structure
                        //var arr = {'name' : 'cat'}; // Equivalent of $arr = array('name' => 'cat');
                        //console.log(arr['name']);

                        // This is where I can access each piece of data
                        var name = jsonData.name;
                        var time = jsonData.time;

                        // Adds the data after the div where it is implemented in the HTML below
                        $("#div-data").after(name + ' ' + time + '<br />');

                        //console.log('name=' + name);
                        //console.log('time=' + time);

                        console.log(jsonData);
                    }
                });
            });
            console.log('document is ready!');
        });
    </script>
</head>
<body>

    <input type="button" value="Fetch Data" class="cls-button" id="btn-fetch-data" />
    <div id="div-data"></div>
</body>
</html>