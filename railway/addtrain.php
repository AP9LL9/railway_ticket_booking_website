<!doctype html>
<html lang="en">
  <?php
  include 'connect.php';
 
  ?>
  <head>
    <meta charset="UTF-8" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/admin1.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  
    <title>Add Train</title>
  </head>
  <body>
    <div class="sidebar">
      <div class="sidebar_logo">
        <div class="logo_cont">            
          <img height="45px"  src="https://img.icons8.com/external-flatart-icons-outline-flatarticons/64/FFFFFF/external-train-hotel-services-and-city-elements-flatart-icons-outline-flatarticons.png" alt="LOGO">
          <h2>IRTBS</h2></div>
        
      </div>

      <div class="sidebar_menu">
        <ul>
        <li> 
            <a href="admindash.php"><span class="img"></span>
              <span class="disc">Dashboard</span>
            </a>

          </li>

          <li> 

            <a href="admindash.php"><span class="img"></span>
              <span class="disc">Trains</span>
            </a>

          </li>
          <li> 

          <a href="addtrain.php"><span class="img"></span>
            <span class="disc">Add Train</span>
          </a>

          </li>
          <li> 

            <a href="userlist.php"><span class="img"></span>
              <span class="disc">Users</span>
            </a>

          </li>
          <li> 

            <a href="booked.php"><span class="img"></span>
              <span class="disc">Reserved</span>
            </a>

          </li>
          <li> 

            <a href="logout.php"><span class="img"></span>
              <span class="disc">Logout</span>
            </a>

          </li>
        </ul>
      </div>

    </div>

    <div class="main_container">
      <header>
          <div class="menu_box">
            <img  height="30px" src="https://img.icons8.com/ios-filled/50/00000/menu--v1.png" alt="menu--v1"/>
            <h2>Dashboard</h2>
          </div>
          

        

         <div class="user_wrapper">
          <svg xmlns="http://www.w3.org/2000/svg" height="3rem" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#007bff}</style><path d="M399 384.2C376.9 345.8 335.4 320 288 320H224c-47.4 0-88.9 25.8-111 64.2c35.2 39.2 86.2 63.8 143 63.8s107.8-24.7 143-63.8zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm256 16a72 72 0 1 0 0-144 72 72 0 1 0 0 144z"/></svg>
            <div>
            <?php
                if (isset($_SESSION['user_id'])) {
                    
                  $userId = $_SESSION['user_id'];
                    // Assuming $conn is your database connection
                    $stmt = $conn->prepare("SELECT username FROM user WHERE id = ?");
                    $stmt->bind_param("i", $userId); // Assuming user ID is an integer
                    $stmt->execute();
                    
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $username = $row['username'];
                        ?>
                        <h3><?php echo $username; ?></h3>
                        <?php
                    } else {
                        echo "User not found";
                    }

                    $stmt->close();
                } else {
                    echo "User not logged in";
                }
                ?>
              <small>Admin</small>
            </div>
        </div>

      </header>

      <main>
      <div class="cards">
          <div class="card">
            <div>
            <?php
              $sql = 'SELECT COUNT(status) AS count FROM bookings where status="confirmed"';
              $result = $conn->query($sql);

              $count = ($result && $row = $result->fetch_assoc()) ? $row['count'] : 0;
              ?>

              <h1><?php echo $count; ?></h1>

              <span>Passengers</span>
            </div>

            <div class="img_card">
              <svg class="ico_card" xmlns="http://www.w3.org/2000/svg" height="3rem" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M432 96a48 48 0 1 0 0-96 48 48 0 1 0 0 96zM347.7 200.5c1-.4 1.9-.8 2.9-1.2l-16.9 63.5c-5.6 21.1-.1 43.6 14.7 59.7l70.7 77.1 22 88.1c4.3 17.1 21.7 27.6 38.8 23.3s27.6-21.7 23.3-38.8l-23-92.1c-1.9-7.8-5.8-14.9-11.2-20.8l-49.5-54 19.3-65.5 9.6 23c4.4 10.6 12.5 19.3 22.8 24.5l26.7 13.3c15.8 7.9 35 1.5 42.9-14.3s1.5-35-14.3-42.9L505 232.7l-15.3-36.8C472.5 154.8 432.3 128 387.7 128c-22.8 0-45.3 4.8-66.1 14l-8 3.5c-32.9 14.6-58.1 42.4-69.4 76.5l-2.6 7.8c-5.6 16.8 3.5 34.9 20.2 40.5s34.9-3.5 40.5-20.2l2.6-7.8c5.7-17.1 18.3-30.9 34.7-38.2l8-3.5zm-30 135.1l-25 62.4-59.4 59.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L340.3 441c4.6-4.6 8.2-10.1 10.6-16.1l14.5-36.2-40.7-44.4c-2.5-2.7-4.8-5.6-7-8.6zM256 274.1c-7.7-4.4-17.4-1.8-21.9 5.9l-32 55.4L147.7 304c-15.3-8.8-34.9-3.6-43.7 11.7L40 426.6c-8.8 15.3-3.6 34.9 11.7 43.7l55.4 32c15.3 8.8 34.9 3.6 43.7-11.7l64-110.9c1.5-2.6 2.6-5.2 3.3-8L261.9 296c4.4-7.7 1.8-17.4-5.9-21.9z"/></svg>
            </div>

          </div>

          <div class="card">
            <div>
            <?php
                $sql = 'SELECT COUNT(trainid) AS count FROM trainsch';
                $result = $conn->query($sql);

                $count = ($result && $row = $result->fetch_assoc()) ? $row['count'] : 0;
                ?>

                <h1><?php echo $count; ?></h1>


              <span>Trains</span>
            </div>

            <div class="img_card">
              <svg class="ico_card" xmlns="http://www.w3.org/2000/svg" height="3rem" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M96 0C43 0 0 43 0 96V352c0 48 35.2 87.7 81.1 94.9l-46 46C28.1 499.9 33.1 512 43 512H82.7c8.5 0 16.6-3.4 22.6-9.4L160 448H288l54.6 54.6c6 6 14.1 9.4 22.6 9.4H405c10 0 15-12.1 7.9-19.1l-46-46c46-7.1 81.1-46.9 81.1-94.9V96c0-53-43-96-96-96H96zM64 96c0-17.7 14.3-32 32-32H352c17.7 0 32 14.3 32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V96zM224 288a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg>              
            </div>
            
          </div>

          <div class="card">
            <div>
            <?php
                 
                 $sql = "SELECT COUNT(*) AS count FROM bookings WHERE status = 'cancelled'";
                 $result = $conn->query($sql);
                 
                 $count = ($result && $row = $result->fetch_assoc()) ? $row['count'] : 0;
                 ?>
                 
                 <h1><?php echo $count; ?></h1>
              <span>Cancelled Tickets</span>
            </div>

            <div class="img_card">
              <img class="ico_card" src="img/cancel.png" alt="" height="37">       
            </div>
            
           </div>
           <div class="card">
           <div>
            <?php
                $sql = 'SELECT SUM(price) AS total FROM bookings where status ="confirmed"';
                $result = $conn->query($sql);
                if ($result && $row = $result->fetch_assoc()) {
                    $total = $row['total'];
                } else {
                    $total = 0;
                }
                ?>
                <h1><?php echo $total; ?> $</h1>
              <span>Earings</span>
            </div>

            <div class="img_card">
              <img class="ico_card" src="img/money.png" alt="" height="37">       
            </div>
            
           </div>
          
           <div class="card">
           <div>
            <?php
             $sql = 'SELECT COUNT(username) AS count FROM user';
             $result = $conn->query($sql);

             $count = ($result && $row = $result->fetch_assoc()) ? $row['count'] : 0;
             ?>
                <h1><?php echo $count; ?> </h1>
              <span>Users</span>
            </div>

            <div class="img_card">
              <img class="ico_card" src="img/users.png" alt="" height="37">       
            </div>
            
           </div>
          <div class="card">
            <div>
            <?php
                $sql = 'SELECT sum(AvailableSeats) AS count FROM trainsch';
                $result = $conn->query($sql);

                $count = ($result && $row = $result->fetch_assoc()) ? $row['count'] : 0;
                ?>

                <h1><?php echo $count; ?></h1>
              <span>Available Tickets</span>
            </div>

            <div class="img_card">
            <img class="ico_card" src="img/tickets.png" alt="" height="37">   
           </div>
            
          </div>
        </div>
          
            <!-- -------users box end ------------- -->
           <div class="formbox">
            <div class="addtrain">
              <h2>Enter Train Details</h2>
        <div class="trainfrom">
          <form  method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

            <div class="inpu">
              <div>
                <div class="form-row1">
                  <label for="trainid">Train ID:</label>
                   <input type="text" name="trainid" required><br>
                 </div> 
                 <div class="form-row1">
                   <label for="trainname">Train Name:</label>
                   <input type="text" name="trainname" required><br>
                </div>
                   <div class="form-row1">
                   <label for="depstation">Departure Station:</label>
                   <input type="text" name="depstation" required><br>
                 </div>
                   <div class="form-row1">
                   <label for="arrstation">Arrival Station:</label>
                   <input type="text" name="arrstation" required><br>
                 </div>
                   <div class="form-row1">
                   <label for="deptime">Departure Time:</label>
                   <input type="time" name="deptime" required><br>
                 </div>
                 
              </div>
               <div>
                <div class="form-row2">
                  <label for="date">Date:</label>
                  <input type="date" name="date" placeholder="YYYY-MM-DD" required><br>
                </div>
                <div class="form-row2">
                  <label for="price">Price:</label>
                  <input type="text" name="price" required><br>
                 </div>
                  <div class="form-row2">
                  <label for="totalSeats">Total Seats:</label>
                  <input type="text" name="totalSeats" required><br>
               </div>
               <div class="form-row2">
                  <label for="availableSeats">Available Seats:</label>
                  <input type="text" name="availableSeats" required><br>
                </div>
                <div class="form-row2">
                   <label for="arrtime">Arrival Time:</label>
                   <input type="time" name="arrtime" required><br>
                 </div>
              
                <div class="form-row2">
                  <button type="submit">Submit</button>
               </div>
               </div>
            </div>
         </form>
        </div>
            </div>
           </div>

    <?php
    
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Fetch train details from the form
        $trainid = $_POST['trainid'];
        $trainname = $_POST['trainname'];
        $depstation = $_POST['depstation'];
        $arrstation = $_POST['arrstation'];
        $deptime = $_POST['deptime'];
        $arrtime = $_POST['arrtime'];
        $date = $_POST['date'];
        $price = $_POST['price'];
        $totalSeats = $_POST['totalSeats'];
        $availableSeats = $_POST['availableSeats'];

        // Your SQL query for inserting data into the 'trainsch' table
        $sql = 'INSERT INTO `trainsch` (`trainid`, `trainname`, `depstation`, `arrstation`, `deptime`, `arrtime`, `date`, `price`, `TotalSeats`, `AvailableSeats`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';

        // Prepare the statement
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bind_param('isssssssii', $trainid, $trainname, $depstation, $arrstation, $deptime, $arrtime, $date, $price, $totalSeats, $availableSeats);

        // Execute the statement
        $result = $stmt->execute();

        // Check for execution success
        if ($result) {
            echo "Data inserted successfully!";
        } else {
            // echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }

    // Close the database connection
    $conn->close();
    ?>







            </div>

        </div>

      </main>

    </div>
    
    <script type="module" src="main.js"></script>
    
<script>
function confirmDelete() {
    return confirm("Are you sure you want to delete this record?");
}
</script>
  </body>
  
</html>
