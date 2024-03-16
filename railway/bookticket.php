<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="css/bookticket1.css">
    </head>
    <body>
        
        <div class="main_container">
            <?php include 'header.php';?>

</div>
        <div class="content">
          
          <div class="results">

<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the previous form (searchresults.php)
    $trainid = $_POST["trainid"];
    $sch_id = $_POST["sch_id"];
    $price = $_POST["price"];
    $date = $_POST["date"]; // Assuming the travel date is in 'travel_date' field

    // Display Train Information Section
    $sql = "SELECT * FROM trainsch WHERE sch_id = ? AND date = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $sch_id, $date);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Continue with the rest of your code...
    } else {
        echo "No matching rows found.";
    }

    // Close the statement
    $stmt->close();
}

$conn->close();
?>
    
        <div class="rslt_box">
    
        <h2>Train Details</h2>
         <?php
        //Display Train Information Section (similar to bookticket.php)
        if (!empty($row)) {
        echo '<div class="ull">';
        echo '<h3>Train Information</h3>';
        echo '<p>Train Name: ' . $row["trainname"] . '</p>';
        echo '<p>Train ID: ' . $row["trainid"] . '</p>';
        echo '<p>Departure: ' . $row["depstation"] . '</p>';
        echo '<p>Arrival: ' . $row["arrstation"] . '</p>';
        echo '<p>Departure Time: ' . $row["deptime"] . '</p>';
        echo '<p>Duration: ' . round((strtotime($row["arrtime"]) - strtotime($row["deptime"])) / 3600, 2) . ' hours</p>';
        echo '</div>';
    }
    ?>
      </div>
    
    <div class="form">
                    
<div class="pdetails"> 
<h2>Passenger Details</h2>
    <div class="inp">
    <form  method="post" action="payment.php">
        <!-- Common Fields for all Tickets -->
        <input type="hidden" name="sch_id" value="<?php echo $sch_id; ?>">
        <input type="hidden" name="trainid" value="<?php echo $trainid; ?>">
        <input type="hidden" name="price" value="<?php echo $price; ?>">
        <input type="hidden" name="travel_date" value="<?php echo $date; ?>">

        <!-- Repeat the passenger details for each ticket -->
        <div class="form-row">
            <label for="passenger_name">Passenger Name:</label>
            <input type="text" name="passenger_name" required>
        </div>
        <div class="form-row">
            <label for="passenger_age">Passenger Age:</label>
            <input type="text" name="passenger_age" required>
        </div>
        <div class="form-row">
            <label for="passenger_email">Passenger Email:</label>
            <input type="text" name="passenger_email" required>
        </div>
        <div class="form-row">
            <label for="passenger_phone">Passenger Phone:</label>
            <input type="tel" name="passenger_phone" required>
        </div>
        <div class="form-row">
            <label for="passenger_gender">Passenger Gender:</label>
            <select name="passenger_gender" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
        </div>
    </div>
</div>
    <!-- Payment Details Section -->
<div class="cardinfo">  
    <h2>Payment Details</h2>
    <div class="inp">
    <div class="form-row">
        <!-- Payment Fields (Add more as needed) -->
        <label for="card_number">Card Number:</label>
        <input type="text" name="card_number" required>
    </div>
    <div class="form-row">
        <label for="card_holder_name">Card Holder Name:</label>
        <input type="text" name="card_holder_name" required>
    </div>
    <div class="cvv">
        <div class="form-row">
            <label for="expiration_date">Expiration Date:</label>
            <input type="month" name="expiration_date" placeholder="MM/YYYY" required>
        </div>
        <div class="form-row">
            <label for="cvv">CVV:</label>
            <input type="text" name="cvv" required>
        </div>
    </div>
    <!-- Add more payment details fields as needed -->

    <div class="form-row"> <!-- Confirm Booking Button -->
        <button type="submit" name="confirm_booking">Confirm Booking</button>
    </div>
    </div>
</div>
</form>
        </div>  
        </div>          
</div>

           
              
        
         <!-- </div> -->
     </body>
 </html>
 