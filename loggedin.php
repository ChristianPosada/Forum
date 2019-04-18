<?php # Script 12.9 - loggedin.php #2
// The user is redirected here from login.php.
session_start(); // Start the session.
// If no session value is present, redirect the user:
require 'login_functions.inc.php';
if (!isset($_SESSION['valid_user'])) {
	// Need the functions:
	require('login_functions.inc.php');
	redirect_user();
}
// Set the page title and include the HTML header:
$page_title = 'Logged In!';
include 'header.html';
// Print a customized message:
echo "<h1>Logged In!</h1>
<p>You are now logged in, {$_SESSION['user']}!</p>
<p><a href=\"logout.php\">Logout</a></p>";
redirect_user();
include('footer.html');
?>