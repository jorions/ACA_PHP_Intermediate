<!DOCTYPE html>

<html>
<head>
    <title>Todo List</title>
    <link href="styles.css" type="text/css" rel="stylesheet" />
</head>
<body>
<?php
//enable use of $_SESSION variables
session_start();

//if the reset button was pressed, clear the session data
if(isset($_POST['reset'])) {
    unset($_SESSION['todo']);
    unset($_SESSION['complete']);
    unset($_SESSION['id']);
    //why does session_destroy(); require that the reset button be hit twice to work
}

//initializes the arrays on the first start of the page to avoid overwriting them on each submit
if(!isset($_SESSION['todo'])) {
    $_SESSION['todo'] = array();
    $_SESSION['complete'] = array();
    $_SESSION['id'] = 0;
}

//if a new item was entered into the textbox add it to the array
if(isset($_POST['add'])) {
    if($_POST['newItem'] != "") {
        $_SESSION['todo'][] = array($_POST['newItem'], 1);
        //if nothing was entered to add, tell the user
    } else {
        echo "<div class='error'><p>ENTER SOMETHING TO DO</p></div>";
    }
}

//reset id for all to-do items (for use in next foreach)
$count = count($_SESSION['todo']); //declare this instead of integrating into the for loop because the count will increase as we add more data
for($newID = 0; $newID <= $count; $newID++) {
    $_SESSION['todo'][$newID][1] = $newID;
    print_r($_SESSION['todo'][$newID][1]);
    $newID++;
}


//checks for list update inputs


$removeCount = 0;
$id = 0;
foreach ($_SESSION['todo'] as $item) {
    //if initial array value is 0 then it is the first item of the array and it should not be output
    if ($item[1] != 0) {
        //create temporary item name with " " replaced with "_" because names can't be stored with spaces
        $tempItem = $item[0];
        //$tempItem = str_replace(" ", "_", $item[0]);

        //if the Complete button has been pressed
        if (isset($_POST["complete-$tempItem-$id"])) {
            $_SESSION['complete'][] = $_SESSION['todo'][$removeCount][0];
            unset($_SESSION['todo'][$removeCount]);
            $_SESSION['todo'] = array_values($_SESSION['todo']); //Re-indexes array
            //if the Delete button has been pressed
        } else if (isset($_POST["remove-$tempItem-$id"])) {
            unset($_SESSION['todo'][$removeCount]);
            $_SESSION['todo'] = array_values($_SESSION['todo']); //Re-indexes array
            //only applied as an else statement here and below because if a value in the array was unset then we wouldn't want to increase the removeCount's value
        } else {
            $removeCount++;
        }
    }
}
?>

<!--create the input box-->
<div class="add-box">
    <form action="checklist.php" method="POST">
        <input type="text" name="newItem" placeholder="ADD A TASK" value="">
        <input class="green-wide" type="submit" name="add" value="ADD"><br />
        <input onclick="resetList()" class="red-wide" type="submit" name="reset" value="RESET LIST">
    </form>
</div>

<div class="spacer"></div>

<!--create the "to-do" list-->
<?php if (count($_SESSION['todo'])){ ?>
    <div class="section-title">
        <h1>TO-DO</h1>
    </div>
    <div class="section-box">
        <form action="checklist.php" method="POST">
            <table cellspacing="0px" cellpadding="0px">
                <?php
                foreach($_SESSION['todo'] as $item) { ?>
                    <tr>
                        <td><input class="green" type="submit" name="complete-<?php echo str_replace(" ", "_", $item[0]) . "-" . $item[1]; ?>" value="&#10003;"></td>
                        <td class="todo-item"><?php echo $item[0]; ?></td>
                        <td><input class="red" type="submit" name="remove-<?php echo str_replace(" ", "_", $item[0]) . "-" . $item[1]; ?>" value="X"></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </form>
    </div>
<?php } ?>

<div class="spacer"></div>

<!--create the "completed" list-->
<?php
if (count($_SESSION['complete']) > 0) {
    ?>
    <div class="section-title"><h1>COMPLETED</h1></div>
    <div class="section-box">
        <table>
            <?php
            foreach ($_SESSION['complete'] as $item) {
                echo "<tr><td class='complete-item'>$item</td></tr>";
            } ?>
        </table>
    </div>
<?php } ?>

</body>
</html>












<!DOCTYPE html>

<html>
<head>
    <title>Todo List</title>
    <link href="styles.css" type="text/css" rel="stylesheet" />
</head>
<body>
<?php
//enable use of $_SESSION variables
session_start();

//if the reset button was pressed, clear the session data
if(isset($_POST['reset'])) {
    unset($_SESSION['todo']);
    unset($_SESSION['complete']);
    //why does session_destroy(); require that the reset button be hit twice to work
}

//initializes the arrays on the first start of the page to avoid overwriting them on each submit
if(!isset($_SESSION['todo'])) {
    $_SESSION['todo'] = array();
    $_SESSION['complete'] = array();
}

//if a new item was entered into the textbox add it to the array
if(isset($_POST['add'])) {
    if($_POST['newItem'] != "") {
        $_SESSION['todo'][] = $_POST['newItem'];
        //if nothing was entered to add, tell the user
    } else {
        echo "<div class='error'><p>ENTER SOMETHING TO DO</p></div>";
    }
}

//checks for list update inputs
$removeCount = 0;
foreach ($_SESSION['todo'] as $item) {

    //create temporary item name with " " replaced with "_" because names can't be stored with spaces
    $tempItem = str_replace(" ", "_", $item);

    //if the Complete button has been pressed
    if (isset($_POST["complete-$tempItem"])) {
        $_SESSION['complete'][] = $_SESSION['todo'][$removeCount];
        unset($_SESSION['todo'][$removeCount]);
        $_SESSION['todo'] = array_values($_SESSION['todo']); //Re-indexes array
    } else if (isset($_POST["remove-$tempItem"])) {
        unset($_SESSION['todo'][$removeCount]);
        $_SESSION['todo'] = array_values($_SESSION['todo']); //Re-indexes array
        //only applied as an else statement here and below because if a value in the array was unset then we wouldn't want to increase the removeCount's value
    } else {
        $removeCount++;
    }
}
?>

<!--create the input box-->
<div class="add-box">
    <form action="checklist.php" method="POST">
        <input type="text" name="newItem" placeholder="ADD A TASK" value="">
        <input class="green-wide" type="submit" name="add" value="ADD"><br />
        <input onclick="resetList()" class="red-wide" type="submit" name="reset" value="RESET LIST">
    </form>
</div>

<div class="spacer"></div>

<!--create the "to-do" list-->
<?php if (count($_SESSION['todo'])){ ?>
    <div class="section-title">
        <h1>TO-DO</h1>
    </div>
    <div class="section-box">
        <form action="checklist.php" method="POST">
            <table cellspacing="0px" cellpadding="0px">
                <?php
                foreach($_SESSION['todo'] as $item) { ?>
                    <tr>
                        <td><input class="green" type="submit" name="complete-<?php echo str_replace(" ", "_", $item); ?>" value="&#10003;"></td>
                        <td class="todo-item"><?php echo $item; ?></td>
                        <td><input class="red" type="submit" name="remove-<?php echo str_replace(" ", "_", $item); ?>" value="X"></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </form>
    </div>
<?php } ?>

<div class="spacer"></div>

<!--create the "completed" list-->
<?php
if (count($_SESSION['complete']) > 0) {
    ?>
    <div class="section-title"><h1>COMPLETED</h1></div>
    <div class="section-box">
        <table>
            <?php
            foreach ($_SESSION['complete'] as $items) {
                echo "<tr><td class='complete-item'>$items</td></tr>";
            } ?>
        </table>
    </div>
<?php } ?>

</body>
</html>
