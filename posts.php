
<?php
/**
 * Created by PhpStorm.
 * User: christianposada
 * Date: 12/5/18
 * Time: 7:33 PM
 */
include "header.html";
require 'dbconnect.php';
session_start();

$query2 = "SELECT body, user_id, date_entered FROM comments WHERE post_id = ? ";

$post_id = $_GET['post_id'];

$stmt2 = $mysqli ->prepare($query2);
$stmt2->bind_param("s",$post_id);
$stmt2->execute();
$stmt2->store_result();
$stmt2->bind_result( $comment, $user_id,$date);
$x = $stmt2->num_rows();

if ( $x > 0) {
// Table header.
    echo '<table width="80%">
	<thead>
	<tr>
		<th align="left">Name</th>
		<th align="left">Date</th>
		<th align="left">Body</th>
	</tr>
	</thead>
	<tbody>
';
}

    while ($stmt2->fetch()) {
        echo '<tr><td align = "left">' . $user_id . '</td><td align="left">' . $date . '</td><td align="left">' . $comment . '
           </td></tr>
     ';



    }


echo "</table>";




    include "footer.html";


?>