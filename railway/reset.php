<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body{
            font-family: poppins;
            background-color: #f2f2f2;
        }
        .f_box{
            margin:150px auto;
            width:fit-content;
            padding:60px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        h1{
            margin:0px;
            font-weight: 500;
        }
        p{
            margin:0px;
            margin-bottom: 25px;
            color: gray;
        }
        form{
          
            display: flex;
            width: 400px;
            font-size: 17px;
            flex-direction: column;
            gap:10px;
          
        }
        form label{
           
            font-weight: 600;
        }
        form input{
            width:95%;
            height: 40px;
            font-size: 17px;
            padding-left: 10px;

        }
        .bt{
            width: 50%;
            height: fit-content;
            background-color: #007bff;
            color:white;
            border: none;
            padding: 10px;
            font-size:15px;
            border-radius: 5px;
            margin-top: 10px;
        
        }

        form button:hover{
            box-shadow: 0 0 10px rgba(3, 3, 3, 0.3);
            cursor: pointer;
        }
    </style>
</head>
<body>
<?php
include 'header.php';

$errorMessage = ''; // Initialize the error message variable

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // $oldPassword = $_POST['oldpassword'];
    $newPassword = $_POST['newpassword'];
    $confirmPassword = $_POST['confirmpassword'];

    if ($newPassword == $confirmPassword) {
        // Use the existing database connection
        // Note: This code is vulnerable to SQL injection; use prepared statements in production
        $sql = "UPDATE user SET password = '$newPassword' WHERE id = $userId";

        if (mysqli_query($conn, $sql)) {
            // Password updated successfully
            header("Location: index.html");
            exit();
        } else {
            // Error updating password
            $errorMessage = "Error updating password: " . mysqli_error($conn);
        }
    } else {
        $errorMessage = "Passwords do not match.";
    }
    // Close the database connection
    mysqli_close($conn);
}
?>


    <div class="f_box">
        <h1>Reset Password</h1>
        <p>The password should have atleast 3 characters</p>
        <?php
        // Display error message if present
        if (!empty($errorMessage)) {
            echo "<p style='color: red;'>$errorMessage</p>";
        }
        ?>
        <form action="" method="POST"  onsubmit="return validateForm()">
            
            <label for="newpassword">New Password</label>     
            <input type="text" name="newpassword" id="newpassword" placeholder="New password" required>
      
            <label for="confirmpassword">Confirm Password </label>
            <input type="password" name="confirmpassword" id="confirmpassword" placeholder="Confirm password" required>
           
            <button class="bt" type="submit">RESET</button>
        </form>
        <br><p>After successfully updating password <br> you will be redirected to login page</p>
    </div>
 
</body>
<script>
     function validateForm() {
        var password = document.getElementById('newpassword').value;
        var confirmPassword = document.getElementById('confirmpassword').value;
        var errorDiv = document.getElementById('passwordError');

        if (password !== confirmPassword) {
            // Display error message
            errorDiv.innerHTML = 'Passwords do not match';
            return false;
        } else {
            // Clear error message
            errorDiv.innerHTML = '';
            return true;
        }
    }
</script>
</html>