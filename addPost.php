<?php
/**
 * Created by PhpStorm.
 * User: christianposada
 * Date: 12/18/18
 * Time: 8:35 PM
 */
include "header.html";
session_start();
include_once 'dbconnect.php';



if(isset($_SESSION['valid_user']))
{
    echo '<form method="post" action="addPost.php">';
    echo '<table>';
    echo '<tr><td>Title:</td>';
    echo '<td><input type="text" name="title"></td></tr>';
    echo '<tr><td>Post:</td>';
    echo '<td><textarea name="body" cols="40" rows="5"></textarea></td></tr>';
    echo '<tr><td colspan="2" align="center">';
    echo '<input type="submit" value="Submit"></td></tr>';
    echo '</table></form>';



    if (isset($_POST['title']) && isset($_POST['body'])){
        $title = $_POST['title'];
        $body = $_POST['body'];
        $user = $_SESSION['valid_user'];


        $query = "INSERT INTO posts (title, body, user_id, date_entered) VALUES (?, ?, ?, NOW() )";


        $stmt = $mysqli-> prepare($query);
        $stmt->bind_param('sss', $title, $body, $user);
        $stmt->execute();

        redirect_user('index.php');



    }

}
else{
    echo"you must be logged in";
}



?>