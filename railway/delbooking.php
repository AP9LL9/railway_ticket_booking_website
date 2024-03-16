

<?php
 include 'connect.php';

 // Ensure that the form was submitted
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
     // Retrieve the booking_idfrom the form data
     $booking_id= $_POST["booking_id"];
     
     // Perform the deletion operation
     $sql = "DELETE FROM bookings WHERE booking_id = ?";
     $stmt = $conn->prepare($sql);
     $stmt->bind_param("i", $booking_id); // Assuming booking_idis an integer, adjust accordingly if it's a different type
     $stmt->execute();
 
     // Check if the deletion was successful
     if ($stmt->affected_rows > 0) {
         echo "Record deleted successfully";
         header("Location: booked.php");
     } else {
         echo "Error deleting record: " . $stmt->error;
     }
 
     // Close the statement
     $stmt->close();
 }
 
 // Close the database connection
 $conn->close();

 
 
 ?>
 