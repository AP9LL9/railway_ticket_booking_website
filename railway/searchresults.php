<html>
    <head>
        <title>Search Results</title>
        <link rel="stylesheet" href="css/searchresults.css">
    </head>
    
    
<body>
<?php include 'header.php';?>
<div class="main_container">

<div class="content">
  
  <div class="results">
      <div class="rbox">
        <div class="rbox_txt">
          <?php
          $departure = $_POST['from'];
          $arrival = $_POST['to'];
          $date = $_POST['date'];
          ?>
          <p><?php echo  $departure; ?></p> <span class="right-arrow"><img src="https://www.confirmtkt.com/images/Mail/arrow.png" alt="arrow_icon" height="11px" width="18px"></span> <p><?php echo $arrival;?></p> 
        </div>
          <div class="cal" >
              <p><?php echo $date;?></p>
          </div>
    </div>
    
  <div class="rslt">
    <div class="rslt_box">
      <!-- ------------------------------------------ -->
    
      <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get user input from the HTML form
        $departure = $_POST['from'];
        $arrival = $_POST['to'];
        $date = $_POST['date'];
    
        // Check if the required variables are set
        if (isset($departure, $arrival, $date)) {
            // Perform the SQL query to search for matching records
            $sql = "SELECT * FROM trainsch WHERE depstation = ? AND arrstation = ? AND date = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $departure, $arrival, $date);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0 ) {
        while ($row = $result->fetch_assoc()) {
        ?>
          <div class="train-box">
            <div class="train-data">
              <h3><?php echo $row["trainname"] . ' - ' . $row["trainid"]; ?></h3>
              <p><?php echo 'Departure: ' . $row["depstation"]; ?></p>
              <p>Arrival: <?php echo $row["arrstation"]; ?></p>
              <p>Departure Time: <?php echo $row["deptime"]; ?></p>
              <p>Arrival Time: <?php echo $row["arrtime"]; ?></p>
              <p>Duration: <?php echo round((strtotime($row["arrtime"]) - strtotime($row["deptime"])) / 3600, 2); ?> hours</p>
              <p><?php echo 'Available Tickets: ' . $row["availableseats"]; ?></p>
            </div>
            <?php
            if ($row['availableseats'] != 0) {

          ?>
          <form method="POST" action="bookticket.php">
            <input type="hidden" name="sch_id" value="<?php echo $row["sch_id"]; ?>">
            <input type="hidden" name="trainid" value="<?php echo $row["trainid"]; ?>">
            <input type="hidden" name="price" value="<?php echo $row["price"]; ?>">
            <input type="hidden" name="date" value="<?php echo $row["date"]; ?>">

            <button type="submit" class="book-now-btn" name="book">Book $<?php echo $row["price"]; ?></button>
        </form>    
      <?php
        }else{
          echo "Seats not available!!!";
        }
        ?>    
          </div>
        <?php
        }
      }else{
        ?>
        <div class="train-box">
        <?php echo "No Trains Found!!!";
        ?>
        <a href="home.php" class="book-now-btn" name="modify">MODIFY SEARCH</a>
    </div>
    <?php 
    }
      }
    }
        ?>

          

        <!-- ---------------------------------- -->

  
      
  </div>
  <!-- --------------------------------------------- -->
    </div>
    <!-- RESULT BOX END -->
      
  </div>
</div>

    </body>
</html>
