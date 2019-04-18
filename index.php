<?php include_once ('header.html'); ?>

<?php
/**
 * Created by PhpStorm.
 * User: christianposada
 * Date: 11/28/18
 * Time: 6:53 PM
 */
session_start();

//include ('header.html');
include 'dbconnect.php';

if (isset($_SESSION['valid_user'])) {
    echo "<h1>Logged In!</h1>
<p>You are now logged in, {$_SESSION['user']}!</p>";
}

echo '<h1>Most Recent Postings</h1>';
//$page = $_GET['page'];


if (isset($_GET['page']))
{
    $startpos = ($_GET['page'] -1) * 5;

}
else
    $startpos = 0;




$query = "SELECT  username, DATE_FORMAT(date_entered,'%M %d, %Y'), body, post_id FROM posts, users WHERE posts.user_id = users.user_id 
          ORDER BY date_entered DESC LIMIT ?,5;";

$stmt = $mysqli ->prepare($query);
$stmt->bind_param("i",$startpos);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result( $username, $date, $body, $post_id);
$x = $stmt->num_rows();




if ( $x > 0){
// Table header.
    echo '<table width="130%">
	<thead>
	<tr>
		<th align="left">Name</th>
		<th align="left">Date Registered</th>
		<th align="left">Body</th>
	</tr>
	</thead>
	<tbody>
';
while($stmt->fetch()){


    //echo '<a href="posts.php?post_id=' . $post_id .'"</a>';
    echo '<tr><td align="left">' . $username . '</td><td align="left">' . $date. '</td><td align="left">' . $body. '
           <p><a href="posts.php?post_id='.$post_id. '" > View Post </a></p></td></tr>
     ';


}

}
$query = "SELECT COUNT(*) FROM posts";
$stmt = $mysqli -> prepare($query);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($count);
while ($stmt->fetch()){
    echo '<p>Page: ';
    if($count % 5 != 0){
        $pages = ($count/5) + 1;
    }
    else{
        $pages = $count/5;
    }

    $page = $_GET['page'];
    if($page > 1){
        echo '<a href="index.php?page=' . ($page - 1) . '"> Previous Page <a> | ';
    }

    for($i = 1; $i <= $pages; $i++){
        echo '<a href="index.php?page=' . $i . '"> ' . $i . ' <a> | ';
    }
    if($page < $pages-1){
        echo '<a href="index.php?page=' . ($page + 1) . '"> Next Page <a> | ';
    }
    echo '</p>';
}


$stmt->free_result();
$stmt->close();



$mysqli->close();

if (isset($_SESSION['valid_user'])) {
    echo "</div>
<footer class=\"footer\">
    <div class=\"container\">
        <p class=\"text-muted\"><p>Copyright &copy; 2018</p>
        <p><a href='logout.php'>Logout </a></p>
    </div>
</footer>";

}
else{


include('footer.html');
}
?>