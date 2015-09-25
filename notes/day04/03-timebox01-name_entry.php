<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" language="javascript">

        //semicolons are optional in javascript but it is always best practice to use them
        function clickFunction() {

            //use the console.log function to send a message to the console as an error-checking method to make sure the script fires upon clicking the button
            console.log('ITS ALIVE!');

            //set the value of the username based on the value of the text box
            var username = document.getElementById('name').value;

            /*
            set the value of the radio answer based on the value of the radio button
             you can only have 1 item with a certain id so you can't just use the same id for all radio buttons
             as such you have to check
             */
            if(document.getElementById('a-yes').checked) {
                var answer = "Yes";
            } else if(document.getElementById('a-no').checked) {
                var answer = "No";
            } else {
                var answer = "Maybe";
            }

            //if no name entered show an error message
            if(username == "") {
                alert('Enter a name');
            //else display a message
            } else {
                alert('Can we can hang out ' + username + '? ' + answer + '!')
            }




            /*
            ########################################################################################################################
             ############################################# ALTERNATE APPROACH ######################################################
             #######################################################################################################################
             */
            //creates an array of all elements with the name 'answer' and a variable to hold whether the current radio button is checked
            var hangOut = document.getElementsByName('answer');
            var checkedValue = null;

            //loop through the array and identify which of the items in the array is checked
            for(var i = 0; i < hangOut.length; i++) {
                var piece = hangOut[i];

                if(piece.checked) {
                    checkedValue = piece.value;
                }
            }

            //if no name entered show an error message
            if(username == "") {
                alert('Enter a name');
            //else display a message
            } else {
                alert('Can we can hang out ' + username + '? ' + checkedValue + '!')
            }
        }
    </script>
</head>

<body>
    <h3>Can we hang out?</h3>
    <input type="radio" name="answer" value="yes" id="a-yes" />Yes
    <br />
    <input type="radio" name="answer" value="no" id="a-no" />No
    <br />
    <input type="radio" name="answer" value="maybe" id="a-maybe" checked />Maybe So
    <br />
    <br />
    <input type="text" name="name" id="name" placeholder="Your Name" />
    <br />
    <br />
    <input type="button" value="Submit" onclick="clickFunction();" />
</body>
</html>