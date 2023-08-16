<?php
// Start the session to access session variables
session_start();

// Destroy all session data to log out the user
session_destroy();

// Redirect the user to the login page or any other desired page
header("Location: login.php");
exit();
?>
