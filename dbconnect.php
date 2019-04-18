<?php
/**
 * Created by PhpStorm.
 * User: christianposada
 * Date: 11/28/18
 * Time: 6:54 PM
 */

    $mysqli = new mysqli("localhost", "posada", "christian5083", "posada_forum");

//check if connection has been established
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }


?>