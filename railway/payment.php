<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="searchresults1.css">
    </head>
    <body>
    <?php include 'header.php';?>
        <div class="main_container">
       

        <?php

if (isset($_POST['confirm_booking'])) {

    try {
        $conn->query("SET foreign_key_checks = 0");
        $userId = $_SESSION['user_id'];
        $trainId = $_POST['trainid'];
        $price = $_POST['price'];
        $travelDate = $_POST['travel_date'];
        $sch_id = $_POST["sch_id"];

        // Retrieve passenger details for the single ticket
        $passengerName = $_POST["passenger_name"];
        $passengerAge = $_POST["passenger_age"];
        $passengerEmail = $_POST["passenger_email"];
        $passengerPhone = $_POST["passenger_phone"];
        $passengerGender = $_POST["passenger_gender"];

// Perform the booking logic (insert into the 'bookings' table)
$bookingSql = "INSERT INTO bookings (id, booking_date, passenger_name, passenger_age, passenger_email, passenger_phone, passenger_gender, price, travel_date, sch_id) VALUES (?, NOW(),?,?,?,?,?,?,?,?)";
$stmt = $conn->prepare($bookingSql);

// Bind parameters
$stmt->bind_param("ssssssssi", $userId, $passengerName, $passengerAge, $passengerEmail, $passengerPhone, $passengerGender, $price, $travelDate, $sch_id);

if ($stmt->execute()) {
    // Get the last inserted ID (booking_id)
    $bookingId = $conn->insert_id;

    // Update available seats count in 'trainsch'
    $updateSeatsSql = "UPDATE trainsch SET availableseats = availableseats - 1 WHERE sch_id = ?";
    $stmtUpdate = $conn->prepare($updateSeatsSql);
    $stmtUpdate->bind_param("i", $sch_id);

    if ($stmtUpdate->execute()) {

    
        // Insert values into 'train_seats' table using stored procedure
        $insertTrainSeatsSql = "CALL BookSeats(?, ?)";
        $stmtTrainSeats = $conn->prepare($insertTrainSeatsSql);

        // Bind parameters for stored procedure 'InsertTrainSeats'
        $stmtTrainSeats->bind_param("ii", $bookingId, $sch_id);

    if ($stmtTrainSeats->execute()) {
        // Display the details of the booked ticket
        header("Location: downloadticket.php");
    } else {
        echo "Error inserting values into 'train_seats': " . $stmtTrainSeats->error;
    }

            // Close the 'train_seats' statement
            $stmtTrainSeats->close();
            } else {
                echo "Error updating available seats: " . $stmtUpdate->error;
            }

            // Close the update statement
            $stmtUpdate->close();
        } else {
            echo "Error booking ticket: " . $stmt->error;
        }

        // Close the booking statement
        $stmt->close();
    } catch (Exception $e) {
        // Handle exceptions, if any
        echo "Error: " . $e->getMessage();
    }
}

// Close the database connection
$conn->close();
?>

            </div>
        </div>
    </body>
</html>
