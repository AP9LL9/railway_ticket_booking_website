<?php
// Establish a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();
$firstname=$_POST["firstname"];
$lastname=$_POST["lastname"];
$email=$_POST["email"];
$username=$_POST["username"];
$password=$_POST["password"];
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
} else {
    $stmt = $conn->prepare("INSERT INTO user(firstname, lastname, email, username, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $firstname, $lastname, $email, $username, $password);

    // Assuming these variables are set elsewhere in your code
    $stmt->execute();
    $stmt->close();
    $conn->close();

    // Redirect after executing the query
    header("Location: index.html");
    exit(); // Ensure no further code is executed after the redirect
}
?>
