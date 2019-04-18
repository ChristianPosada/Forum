<?php
/**
 * Created by PhpStorm.
 * User: christianposada
 * Date: 12/5/18
 * Time: 6:50 PM
 */



  session_start();

  // store to test if they *were* logged in
  $old_user = $_SESSION['valid_user'];
  unset($_SESSION['valid_user']);
  session_destroy();
?>
<html>
<body>
<h1>Log out</h1>
<?php
  if (!empty($old_user))
  {
    echo 'You have been logged out.<br />';
  }
  else
  {
    // if they weren't logged in but came to this page somehow
    echo 'You are not logged in.<br />';
  }
?>






