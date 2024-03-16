<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/ticket45.css">
    <title>Bookings</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
</head>

<body>

<?php
include 'header.php';
$sql = "SELECT * FROM bookings INNER JOIN trainsch ON bookings.sch_id = trainsch.sch_id  WHERE bookings.id = $userId ORDER BY booking_date DESC;";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
$bookid=$row['booking_id'];
?>
<div class="ticketbox">
<div class="mainbox">
<div class="circle1"></div>
<div class="circle2"></div>
<div class="box1">
    <?php
    $seat_query = "SELECT
    b.booking_id,
    b.passenger_name,
    b.passenger_age,
    b.passenger_email,
    b.passenger_phone,
    b.passenger_gender,
    b.status,
    ts.seat_no
FROM
    bookings b
INNER JOIN
train_seats ts ON b.booking_id = ts.booking_id
    WHERE
        b.booking_id = $bookid;
";

    $seat_result = $conn->query($seat_query);

    if ($seat_result && $seat_result->num_rows > 0) {
        // Rename the variable to avoid conflict with the outer $row
        $seat_row = $seat_result->fetch_assoc();
        $seat_no = $seat_row['seat_no'];
        if($seat_no==null){
            $stat="train has been cancelled"; 
        }
        else{
            $stat=$seat_no;
        }
    }
    ?>
    <div class="top">

<div class="image">
<img class="train" src="img/Train.gif" alt="">
</div>
<div class="details">
<div class="titlebox">
    <div class="title" >
        <h1>TRAIN TICKET</h1>
        

<?php
        
echo "<p><span>No:</span> " . $row['trainid'] . " Date: " . $row['travel_date'] ."    Seat No: " . $stat . "</p>";
// echo "<p style='text-align:right;'> Seat No: " . $seat_no . "</p>";

            ?>
        </div>
    </div>
</div>
<div class="statusbox">
    <p>Status:</p>
    <?php
    if($row['status'] == 'confirmed'){
        ?>
        <div style="background-color:#93e9be; width:10px; height:10px; border-radius:50%; "></div>
        <?php
    }
    else{
        ?>
        <div style="background-color:#ff5c5c; width:10px; height:10px; border-radius:50%; "></div>
    <?php
    }
    ?>

    </div>
</div>
<div class="main">
    <div class="mainright">
        <div class="from">
            <p1>From</p1>
            <?php echo "<p2> " . $row['depstation'] . "</p2>"; ?>
        </div>

        <div class="time">
            <?php

            // Assuming you have a DateTime object for 'deptime'
            $deptime = new DateTime($row['deptime']);

            // Format 'deptime' to display only hours and minutes
            $formattedDeptime = $deptime->format('H:i');

            // Print the formatted time
            echo "<h1>" . $formattedDeptime . "</h1>";

            ?>
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                class="bi bi-arrow-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
            </svg>
            <?php

        // Assuming you have a DateTime object for 'deptime'
        $deptime = new DateTime($row['arrtime']);

        // Format 'deptime' to display only hours and minutes
        $formattedDeptime = $deptime->format('H:i');

        // Print the formatted time
        echo "<h1>" . $formattedDeptime . "</h1>";

        ?>

    </div>
    <div class="to">
        <p1>To</p1>
        <?php echo "<p2>" . $row['arrstation'] . "</p2>"; ?>
    </div>
</div>
<div class="mainleft">
    <div class="type">
        <p1>TYPE</p1>
        <p2>DIRECT</p2>
    </div>
    <div class="duration">
    <?php
    // Calculate the duration in hours
    $deptime = new DateTime($row['deptime']);
    $arrtime = new DateTime($row['arrtime']);
    $duration = $deptime->diff($arrtime);

    // Get the total hours
    $totalHours = $duration->h + $duration->i / 60;

    // Round off to 2 decimal places
    $totalHoursRounded = round($totalHours, 2);

    echo "<p> " . $totalHoursRounded . " hours</p>";
    ?>

</div>
<div class="cost">
    <p1>COST</p1>
    <?php echo "<p> " . $row['price'] . " $" . "</p>"; ?>

</div>
</div>



            </div>


        </div>


        <div class="box2">
            <div class="QR_box">
                <img class="image2" src="img/rick.jpg" alt="">
            </div>
        </div>
    </div>
    <div class="btn_box">
    <?php if ($row['status'] == 'confirmed') {

     echo "<form  method='post' action='cancelticket.php' onsubmit='return confirmDelete()'>";
     echo "<input type='hidden' name='booking_id' value='" . $row["booking_id"] . "'>";
     echo "<input type='hidden' name='userid' value='" . $userId . "'>";
     echo "<input type='hidden' name='sch_id' value='" . $row["sch_id"] . "'>";
       echo "<button class='cancel' type='submit'>CANCEL</button>";
       
       echo "</form>";
 }
 else{
//   <button id='download-pdf' class='print'>PRINT</button>
 }?>
                
            </div>
            </div>
            <?php
        }
    }
    else {
        echo "<h2 style='text-align: center;'>No bookings found!!!!!!!!</h2>";
    }
    ?>
</body>
<script>
      function confirmDelete() {
        return confirm("Are you sure you want to delete this record?");
    }

    const btnDownloadPDF = document.getElementById('download-pdf');
    const ticketElement = document.querySelector('.ticketbox'); // Target the specific 'div' to download

    btnDownloadPDF.addEventListener('click', () => {
        const doc = new jsPDF();
        doc.fromHTML(ticketElement, 15, 15);

        // Uncomment the next line if you want to open the print dialog after generating the PDF
        // doc.autoPrint();

        // Save the PDF
        doc.save('ticket.pdf');
    });
</script>
</html>
