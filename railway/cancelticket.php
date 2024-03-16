<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the booking_id and userid from the form data
    $booking_id = $_POST["booking_id"];
    $userid = $_POST["userid"];
    $sch_id = $_POST["sch_id"];

    // Start a transaction
    $conn->begin_transaction();

    try {
        // Perform the update operation to set status to "cancelled" in 'bookings' table
        $sql_update_booking = "UPDATE bookings SET status = 'cancelled' WHERE booking_id = ? AND id = ?";
        $stmt_update_booking = $conn->prepare($sql_update_booking);
        $stmt_update_booking->bind_param("ii", $booking_id, $userid);
        $stmt_update_booking->execute();

        // Check if the update in 'bookings' table was successful
        if ($stmt_update_booking->affected_rows > 0) {

            // Perform the update operation to set 'is_booked' to 0 in 'train_seats' table
            $sql_update_train_seats = "UPDATE train_seats SET is_booked=0 WHERE booking_id = ?";
            $stmt_update_train_seats = $conn->prepare($sql_update_train_seats);
            $stmt_update_train_seats->bind_param("i", $booking_id); // Assuming $booking_id is an integer
            
            // Execute the delete in 'train_seats' table
            $stmt_update_train_seats->execute();
            
            // Execute the update in 'trainsch' table
            $updateavail = "UPDATE trainsch SET availableseats = availableseats + 1 WHERE sch_id = ?";
            $stmt_update_avail = $conn->prepare($updateavail);
            $stmt_update_avail->bind_param("i", $sch_id); // Assuming $sch_id is an integer
            $stmt_update_avail->execute();
            $stmt_update_avail->close();
            
            // Check if the update in 'train_seats' table was successful
            if ($stmt_update_train_seats->affected_rows > 0) {
                echo "Ticket cancelled successfully";
                header("refresh:2;url=downloadticket.php");
            } else {
                echo "Error updating 'train_seats' record: " . $stmt_update_train_seats->error;
            }

            // Close the statement for updating 'train_seats' table
            $stmt_update_train_seats->close();

        } else {
            echo "Error updating 'bookings' record: " . $stmt_update_booking->error;
        }

        // Close the statement for updating 'bookings' table
        $stmt_update_booking->close();

        // Commit the transaction
        $conn->commit();
    } catch (Exception $e) {
        // Rollback the transaction if an exception occurs
        $conn->rollback();
        echo "Transaction failed: " . $e->getMessage();
    }
    
    // Close the database connection
    $conn->close();
}
?>
