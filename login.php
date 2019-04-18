<?php
/**
 * Created by PhpStorm.
 * User: christianposada
 * Date: 11/19/18
 * Time: 4:29 PM
 */

include 'header.html';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    //short variable names for user input
    //check to validate user input
    require('login_functions.inc.php'); //login functions
    require('dbconnect.php'); //connection to database

    //$check is true if login worked
    //$check is false if login didnt work
    //$data has row if login worked
    //$data has error list if it did not
    list($check, $data) = check_login($mysqli, $_POST['email'], $_POST['pass']);

    if ($check) {
        //set the session data
        /*session_start();
        $_SESSION['user_id'] = $data['user_id'];
        $_SESSION['username'] = $data['username'];
        echo "logged in";*/
        redirect_user('loggedin.php');



    } else {
        $errors = $data;
        $mysqli->close();
        //put the form with the errors
        //include ('login_page.inc.php');
       // include('login_page.inc.php');

        if (isset($errors) && !empty($errors)) {
            echo '<h1>Error!</h1>
	<p class="error">The following error(s) occurred:<br>';
            foreach ($errors as $msg) {
                echo " - $msg<br>\n";
            }
            echo '</p><p>Please try again.</p>';
        }
    }
}
?>

<html><h1>Login</h1>
<form action="login.php" method="post">
    <p>Email Address: <input type="email" name="email" size="20" maxlength="60"> </p>
    <p>Password: <input type="password" name="pass" size="20" maxlength="20"></p>
    <p><input type="submit" name="submit" value="Login"></p>
</form>
</html>
<?php include('footer.html'); ?>








