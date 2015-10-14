<?php
session_start();

if(isset($_POST) && !empty($_POST)) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username == 'jared' && $password == '123') {

        echo 'You are logged in';

        $_SESSION['logged_in'] = true;
        $_SESSION['name'] = 'Jared Selcoe';
    } else {

        echo 'That is not the correct password';
    }
}

if(isset($_SESSION) && isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
    echo 'Welcome back ' . $_SESSION['name'];
    echo '<input type="button" value="logout" />';
} else { ?>

    <form action="<?php echo($_SERVER['PHP_SELF']);?>" method="post">
        Username: <input type="text" name="username" />
        <br />
        Password: <input type="text" name="password" />
        <br />
        <input type="submit" value="Login"/>
    </form>
<?php } ?>