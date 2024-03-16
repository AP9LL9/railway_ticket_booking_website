<!DOCTYPE html>
<html lang="en">

<?php include 'header.php';?>
<link rel="stylesheet" href="book.css">
   
        
        <!-- <div class="box"> 
            <div class=box1>
                <div class=box2>
        <p>Booking ID: $row['booking_id']  "</p>
        <p>Train ID:   $row['trainid']  </p>
        <p>Train Name:   $row['trainname']  </p>
        <p>Passenger Name:   $row['passenger_name']  </p>
        <p>Date:   $row['booking_date']  </p>
        <p>Price:   $row['price']  </p>
        </div>
    <div class="buttam">
          <button type='submit'>CANCEL</button>
</div>
</div> -->

                <?php
        
        $sql = "SELECT * FROM bookings INNER JOIN trainsch ON bookings.sch_id = trainsch.sch_id WHERE bookings.id = $userId;";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Print the booking details
                ?><div class="box"> 
                <div class=box1>
                    <div class=box2><?php
               
                echo "<p>Booking ID: " . $row['booking_id'] . "</p>";
                echo "<p>Train ID: " . $row['trainid'] . "</p>";
                echo "<p>Train Name: " . $row['trainname'] . "</p>";
                echo "<p>Passenger Name: " . $row['passenger_name'] . "</p>";
                echo "<p>Date: " . $row['travel_date'] . "</p>";
                echo "<p>Price: " . $row['price'] . "</p>";
                echo "<p>Status: " . $row['status'] . "</p>";
                ?>
        </div>
    <div class="buttam">
        <?php
     // Check if the status is 'confirmed' before showing the cancel button
     if ($row['status'] == 'confirmed') {
     
        echo "<form  method='post' action='cancelticket.php' onsubmit='return confirmDelete()'>";
        echo "<input type='hidden' name='booking_id' value='" . $row["booking_id"] . "'>";
        echo "<input type='hidden' name='userid' value='" . $userId . "'>";
        
          echo "<button type='submit'>CANCEL</button>";
          echo "</form>";

    }

    // Add more details as needed
    echo "<hr>"; // Add a horizontal line between bookings for clarity
    ?>
    </div>
    </div>
<?php
}
        }
?>
   
          

   

</body>
<script>
function confirmDelete() {
    return confirm("Are you sure you want to delete this record?");
}
</script>
</html>
