<?php
// Establish a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testnew";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();
     
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location: index.html");
    exit();
}

// Access user id from the session
$userId = $_SESSION['user_id'];

// Rest of your code...
