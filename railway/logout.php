<?php
// Start the session (if not already started)
session_start();

// Destroy the session to log the user out
session_destroy();

// Redirect the user to the login page
header("Location: index.html");
exit();

?>
