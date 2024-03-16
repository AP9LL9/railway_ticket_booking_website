<?php
 include 'connect.php';

 // Ensure that the form was submitted
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Disable foreign key checks
        $sql = "SET foreign_key_checks = 0";
        $conn->query($sql);

     // Retrieve the trainid from the form data

     $trainid = $_POST["trainid"];
     $schid = $_POST["schid"];
     // Perform the deletion operation
     $sql = "DELETE FROM trainsch WHERE trainid = ?";
     $stmt = $conn->prepare($sql);
     $stmt->bind_param("i", $trainid); // Assuming trainid is an integer, adjust accordingly if it's a different type
     $stmt->execute();
     $del= "DELETE from train_seats where sch_id=?";
     $stmtdel = $conn->prepare($sql);
     $stmtdel->bind_param("i", $schid); // Assuming trainid is an integer, adjust accordingly if it's a different type
     $stmtdel->execute();
    
 
     // Check if the deletion was successful
     if ($stmt->affected_rows > 0) {
         echo "Record deleted successfully";
         header("Location: admindash.php");
     } else {
         echo "Error deleting record: " . $stmt->error;
     }
  // enable foreign key checks
        $sql = "SET foreign_key_checks = 1";
        $conn->query($sql);
     // Close the statement
     $stmt->close();
 }


 // Close the database connection
 $conn->close();

 
 
 ?>
 