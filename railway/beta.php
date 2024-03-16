<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/beta.css">
    <title>Document</title>
</head>
<body>

<?php include 'header.php';?>
    <div class="body">
        <div class="main">
            <div class="sidebar">
                <div class="ops">
                    <a class="op" href="beta.php"> 
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664z"/>
                      </svg>
                        <span class="label">Info</span>
                    </a>
                    <a class="op" href="downloadticket.php"> 
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bookmark-check" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                            <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1z"/>
                          </svg>
                        <span class="label">Bookings</span>
                    </a>  
                </div>
                <div class="quit">
                    <a class="logout" href="logout.php"> 
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z"/>
                            <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                          </svg>
                        <span class="label" >Log out</span>
                    </a>
                </div>
                
            </div>
            <div class="content">
                <div class="pro">
                <img class="propic" src="img/user.png" alt="">
                </div>
                
                <div class="info">
                    <div class="name">
                        <h3>Name:</h3>
                        <p>
                        <?php echo $firstname. " " .$lastname ; ?>
                               </p>
                    </div>
                    <div class="email">
                        <h3>Email:</h3>
                        <p><?php echo $email ;?></p>
                    </div>
                    <div class="phone">
                        <h3>Phone Number:</h3>
                        <p>+91 9876543210</p>
                    </div>
                    <div class="edit">
                        <a class="reset_btn" href="reset.php">  
                          <p>Reset Password</p> 
                        </a>
                    </div>
                </div>
            </div>
        
        </div>
    </div>
    
    
   
</body>
</html>