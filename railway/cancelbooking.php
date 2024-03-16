<?php
 include 'connect.php';

 // Ensure that the form was submitted
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
     // Retrieve the booking_idfrom the form data
     $booking_id= $_POST["booking_id"];
 
     // Perform the deletion operation
     $sql = "UPDATE bookings SET status = 'cancelled' WHERE booking_id = ?";
     $stmt = $conn->prepare($sql);
     $stmt->bind_param("i", $booking_id); // Assuming booking_idis an integer, adjust accordingly if it's a different type
     $stmt->execute();
 
     // Check if the deletion was successful
     if ($stmt->affected_rows > 0) {

            // Perform the update operation to set 'is_booked' to 0 in 'train_seats' table
            $sql_update_train_seats = "UPDATE train_seats SET is_booked=0 WHERE booking_id = ?";
            $stmt_update_train_seats = $conn->prepare($sql_update_train_seats);
            $stmt_update_train_seats->bind_param("i", $booking_id); 
            
            // Execute the delete in 'train_seats' table
            $stmt_update_train_seats->execute();
            
            // Execute the update in 'trainsch' table
            $updateavail = "UPDATE trainsch SET availableseats = availableseats + 1 WHERE sch_id = ?";
            $stmt_update_avail = $conn->prepare($updateavail);
            $stmt_update_avail->bind_param("i", $sch_id); 
            $stmt_update_avail->execute();
            $stmt_update_avail->close();
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
 