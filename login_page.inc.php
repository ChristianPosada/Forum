<?php # Script 12.1 - login_page.inc.php
// This page prints any errors associated with logging in
// and it creates the entire login page, including the form.
// Include the header:
$page_title = 'Login';
//include('includes/header.html');
// Print any error messages, if they exist:
if (isset($errors) && !empty($errors)) {
	echo '<h1>Error!</h1>
	<p class="error">The following error(s) occurred:<br>';
	foreach ($errors as $msg) {
		echo " - $msg<br>\n";
	}
	echo '</p><p>Please try again.</p>';
}
// Display the form:
?>
<?php //include('includes/footer.html'); ?>