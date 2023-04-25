<?php
// start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// unset all session variables
$_SESSION = array();

// destroy the session
session_destroy();

// redirect to login page
header("Location: index.html");
exit;
?>
