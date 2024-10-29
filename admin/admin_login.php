<?php
    session_start();
    // if(isset($_SESSION['username'])){
    //     header("Location: all_users.php");
    // }
  ?>

<?php
  if(isset($_POST['submit'])){
    include "../connection.php";
  
    $username = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

      
    $sql =  "SELECT * FROM admin WHERE username = '$username' OR email = '$username'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count_user = mysqli_num_rows($result);
    function alert($message) {
      echo "<script type='text/javascript'>alert('$message');</script>";
    }

    if ($count_user != 0) {
        if ($password == $row["password"]) {
           session_start(); 
            $sql = "SELECT username FROM admin WHERE username = '$username' OR email = '$username'";
            $r =  mysqli_fetch_array(mysqli_query($conn, $sql), MYSQLI_ASSOC); 
                   
            $_SESSION['username'] = $r['username'];        
            $_SESSION['admin_loggedin'] = true;
          

            header("Location: all_users.php");
            exit();
           
        } 
        elseif($password != $row["password"]){
          alert("Wrong password, please enter correct password");
        }
    }
    
    
    elseif($count_user = 0 ) {
          alert("invlid username/email");
      }
    
  }

  ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Admin Login | Jsw Safety </title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    
    </head>  
<body>
  <div class="container">
    <div class="title Registration"><img class="login-logo" src="../assets/img/JSWSTEEL.NS-5d2dda26.png" alt="JSW-LOGO"> Admin Login</div>
    <div class="content">
      <form action="admin_login.php" method="post">
        <div class="user-details">
          <div class="input-box">

            <span class="details">Email or Username</span>
            <input type="text" name="email" placeholder="Enter your email or Username" required>
          
          <div class="input-box">
            <span class="details password-detail">Password</span>
            <input style="width: 300px;" name="password" type="password" placeholder="Enter your password" required>
         
        </div>

        
        <div class="button">
          <input type="submit" name="submit" value="Log in">
          <a href="../login.php"><input style="margin-top:15px;"  type="button" name="user_login" value="User Login"></a>
       
        </div>
      </form>
    </div>
  </div>

</body>
</html>