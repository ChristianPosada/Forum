<?php # Script 12.2 - login_functions.inc.php
// This page defines two functions used by the login/logout process.
/* This function determines an absolute URL and redirects the user there.
 * The function takes one argument: the page to be redirected to.
 * The argument defaults to index.php.
 */
session_start();
require 'dbconnect.php';
function redirect_user($page = 'index.php') {
	// Start defining the URL...
	// URL is http:// plus the host name plus the current directory:
	$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
	// Remove any trailing slashes:
	$url = rtrim($url, '/\\');
	// Add the page:
	$url .= '/' . $page;
	// Redirect the user:
	header("Location: $url");
    echo '<h1> logged in </h1>';
	exit(); // Quit the script.
} // End of redirect_user() function.
/* This function validates the form data (the email address and password).
 * If both are present, the database is queried.
 * The function requires a database connection.
 * The function returns an array of information, including:
 * - a TRUE/FALSE variable indicating success
 * - an array of either errors or the database result
 */
function check_login($mysqli, $email = '', $pass = '') {
	$errors = []; // Initialize error array.
	// Validate the email address:
	if (empty($email)) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$email = mysqli_real_escape_string($mysqli, trim($email));
	}
	// Validate the password:
	if (empty($pass)) {
		$errors[] = 'You forgot to enter your password.';
	} else {
		$pass = mysqli_real_escape_string($mysqli, trim($pass));
	}
	if (empty($errors)) { // If everything's OK.
		// Retrieve the user_id and first_name for that email/password combination:
		$q = "SELECT user_id, username FROM users WHERE email= ? AND password=?";
        $stmt = $mysqli -> prepare($q);
        $stmt->bind_param('ss',$email,$pass);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id,$u);








		// Check the result:
		if ($stmt->num_rows == 1) {
			// Fetch the record:

            $stmt->fetch();
            $_SESSION['valid_user'] = $id;
            $_SESSION['user'] = $u;
            $row[] = $id;
			$row[] = $u;
			return [true, $row];
		} else { // Not a match!
			$errors[] = 'The email address and password entered do not match those on file.';
		}
	} // End of empty($errors) IF.
	// Return false and the errors:
	return [false, $errors];
} // End of check_login() function.