<?php
    session_start();
    // if(isset($_SESSION['username'])){
    //     header("Location:index.php");
    //     exit();
    // }
  ?>

<?php
  if(isset($_POST['submit'])){
    include "./connection.php";
  
    $username = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

      
    $sql =  "SELECT * FROM user WHERE username = '$username' OR email = '$username'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
 // This line fetches a result row as an associative array from the result set $result.
//  mysqli_fetch_array($result, MYSQLI_ASSOC) retrieves one row from the result set as an 
//  associative array and stores it in the $row variable. The MYSQLI_ASSOC parameter ensures that the array keys are the column names.
    $count_user = mysqli_num_rows($result);
    function alert($message) {
      echo "<script type='text/javascript'>alert('$message');</script>";
    }

    if ($count_user != 0) {
        if ($password == $row["password"]) {
           
            $sql = "SELECT * FROM user WHERE username = '$username' OR email = '$username'";
            $r =  mysqli_fetch_array(mysqli_query($conn, $sql), MYSQLI_ASSOC); 
                   
            $_SESSION['username'] = $r['username'];   
            $_SESSION['full_name'] = $row["full_name"];
            $_SESSION['employee_id'] = $row["employee_id"];
            $_SESSION['phone_number'] = $row["phone_number"];
                
            $_SESSION['loggedin'] = true;
            header("Location: index.php");
           
        } 
        elseif($password != $row["password"]){
          alert("Wrong password, please enter correct password");
        }
    }
    
    
    elseif($count_user == 0 || $password !== $row["password"]) {
          alert("invlid username/email");
      }
  }

  ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Login | Jsw Safety </title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/login.css">
    </head>  
<body>
  <div class="container">
    <div class="title Registration"><img class="login-logo" src="./assets/img/JSWSTEEL.NS-5d2dda26.png" alt="JSW-LOGO"> Login</div>
    <div class="content">
      <form action="login.php" method="post">
        <div class="user-details">
          <div class="input-box">

            <span class="details">Email or Username</span>
            <input type="text" name="email" placeholder="Enter your email or Username" required>
          
          <div class="input-box">
            <span class="details password-detail">Password</span>
            <input style="width: 300px;" name="password" type="password" placeholder="Enter your password" required>
         
        </div>

        <p class="sign-in" style="text-align: center; margin:5px;">Don't have an account?  <a href="./register.php">Sign Up</a></p>
        
        <div class="button">
          <input type="submit" name="submit" value="Log in">
          <a href="./admin/admin_login.php"><input style="margin-top:15px;"  type="button" name="user_login" value="Admin Login"></a>
       
        </div>
      </form>
    </div>
  </div>

</body>
</html>   