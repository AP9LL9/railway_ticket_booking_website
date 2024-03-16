<?php
 include 'connect.php';

 // Ensure that the form was submitted
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
     // Retrieve the id from the form data
     $id = $_POST["id"];
 
     // Perform the deletion operation
     $sql = "DELETE FROM user WHERE id = ?";
     $stmt = $conn->prepare($sql);
     $stmt->bind_param("i", $id); // Assuming id is an integer, adjust accordingly if it's a different type
     $stmt->execute();
 
     // Check if the deletion was successful
     if ($stmt->affected_rows > 0) {
         echo "Record deleted successfully";
         header("Location: admindash.php");
     } else {
         echo "Error deleting record: " . $stmt->error;
     }
 
     // Close the statement
     $stmt->close();
 }
 
 // Close the database connection
 $conn->close();

 
 
 ?>
 