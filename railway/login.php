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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the user's input from the HTML form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Query the database to check user credentials and usertype
    $sql = "SELECT id, usertype FROM user WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // User login successful
        $row = $result->fetch_assoc();
        $userId = $row['id'];
        $userType = $row['usertype'];

        session_start(); // Start a session (if not already started)
        $_SESSION['user_id'] = $userId; // Store the user id in the session

        // Redirect based on usertype
        if ($userType == 1) {
            // User is a regular user, redirect to home.html
            header("Location: home.php?id=$userId");
        } elseif ($userType == 0) {
            // User is an admin, redirect to admindash.php
            header("Location: admindash.php?id=$userId");
        } else {
            // Invalid usertype (handle accordingly)
            echo "Invalid usertype";
        }

        exit(); // Ensure no further code is executed after the redirect
    } else {
        // Invalid credentials
        echo "Login failed. Please check your username and password.";
        header("refresh:2;url=index.html");
    }
}
?>
