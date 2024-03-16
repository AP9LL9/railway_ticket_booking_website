<!DOCTYPE html>
<html lang="en">
    <?php
    include 'connect.php';
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header1.css">
    <title>Document</title>
</head>
<body>

    <header class="header">
        <a href="home.php" class="menu">
            <img class="logo" src="https://img.icons8.com/external-flatart-icons-outline-flatarticons/64/FFFFFF/external-train-hotel-services-and-city-elements-flatart-icons-outline-flatarticons.png" alt="">
            <h1>IRTBS</h1>
        </a>
        <div>
            <div class="options">
                    
                        <a class="option" href="home.php">Home</a>
                        <a class="option" href="downloadticket.php">Bookings</a>
                        <a class="option" href="logout.php">Logout</a>
                        
                    
                
                    <a class="option1" href="beta.php">
                        <div href="" class="">
                            <svg class="pro_pic" xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                              </svg>
                            </div>
                        </a>
                          
                    
              </div>
             
            </div>
        </div>
    
    </header>
    </body>
    <?php
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
        
        // Assuming $conn is your database connection
        $stmt = $conn->prepare("SELECT * FROM user WHERE id = ?");
        $stmt->bind_param("i", $userId); // Assuming user ID is an integer
        $stmt->execute();
        
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $username = $row['username'];
            $firstname= $row['firstname'];
            $lastname= $row['lastname'];
            $email= $row['email'];
            ?>
           
            <?php
        } else {
            echo "User not found";
        }

        $stmt->close();
    } else {
        echo "User not logged in";
    }
    ?> 
</html>