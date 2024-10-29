<?php
if(isset($_POST['submit'])){
  include "./connection.php";
  
  $full_name = mysqli_real_escape_string($conn,$_POST['full_name']);
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  /* 
      mysqli_real_escape_string() is a PHP function that plays a crucial role in securing database interactions.

      Purpose:
      1) It escapes special characters in a string, making it safe to incorporate into an SQL query.
      
      2)This helps prevent SQL injection attacks, a common security vulnerability.  
  */
  $email =mysqli_real_escape_string($conn, $_POST['email']);
  $phone_number = mysqli_real_escape_string($conn,$_POST['phone_number']);
  $employee_id = mysqli_real_escape_string($conn,$_POST['employee_id']);
  $contractor = mysqli_real_escape_string($conn,$_POST['contractor']); 
  $password = mysqli_real_escape_string($conn,$_POST['password']);
  $confirm_password =mysqli_real_escape_string($conn, $_POST['confirm_password']);
 



  $sql =  "SELECT * FROM user WHERE username = '$username'"; 
  $result = mysqli_query($conn, $sql); // mysqli_query($conn, $sql) fetch the rows in form of array
  //mysqli_query($conn, $sql) sends the query to the database and returns the result set, 
  //which contains the rows that match the query, in the form of a MySQLi result object. 
  //This result object is then stored in the $result variable.

  $count_user = mysqli_num_rows($result);
  //This line counts the number of rows in the result set returned by mysqli_query.
  //mysqli_num_rows($result) returns the number of rows in the result set, which is stored in the $count_employee variable.

  $sql =  "SELECT * FROM user WHERE email = '$email'"; 
  $result = mysqli_query($conn, $sql); // mysqli_query($conn, $sql) fetch the rows in form of array
  $count_email = mysqli_num_rows($result);

  $sql =  "SELECT * FROM user WHERE employee_id = '$employee_id'"; 
  $result = mysqli_query($conn, $sql); // mysqli_query($conn, $sql) fetch the rows in form of array
  $count_employee = mysqli_num_rows($result);
/*
  if ($result) {
    echo "Registration successful!";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }*/
  
  
  function alert($message) {
    echo "<script type='text/javascript'>alert('$message');</script>";
  }
  

  if($count_user==0 AND $count_email==0 AND $count_employee==0){

      if($password==$confirm_password){
       /* $hash = password_hash($password, PASSWORD_DEFAULT); */
        $sql = "INSERT INTO user (full_name, username, email, phone_number, employee_id, contractor, password) VALUES ('$full_name', '$username', '$email', '$phone_number', '$employee_id', '$contractor',  '$password')";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
         }
      alert("You have Sucessfully Created a account ");
      }
      else{

        alert("password do not match ");
        echo "<script>window.location.href = 'register.php';</script>";

      }

  }
  elseif($count_user != 0){
    alert("Username Already Exists! Please Enter a New One");
    echo "<script>window.location.href = 'register.php';</script>";

  }
  elseif($count_email!= 0){
    alert("Email Already Exists! Please Enter a New One");
    echo "<script>window.location.href = 'register.php';</script>";
  }
  elseif($count_employee!= 0){
    alert("Employee Already Exists! Please Enter a New One");
    echo "<script>window.location.href = 'register.php';</script>";
  }
}
?>



<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Register | Jsw Safety</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/register.css">
    </head>

  
<body>
  <div class="container">
    
    
    <div class="title Registration"><img class="login-logo" src="./assets/img/JSWSTEEL.NS-5d2dda26.png" alt="JSW-LOGO"> Registration</div>
    <div class="content">
      <form action="./register.php" method="post">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Full Name</span>
            <input type="text" name="full_name" placeholder="Enter your name" required>
          </div>
          <div class="input-box">
            <span class="details">Username</span>
            <input type="text" name="username" placeholder="Enter your username" required>
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="email" name="email" placeholder="Enter your email" required>
          </div>
          <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="tel" name="phone_number" placeholder="Enter your number" required>
          </div>
          <div class="input-box">
            <span class="details">Employee id</span>
            <input type="text" name="employee_id" placeholder="Enter your number" required>
          </div>
          <div class="input-box">
            <span class="details">Contractor</span>
            <input style="border-color: #ccc;" type="text" name="contractor" placeholder="Contractor's Name" >
          </div>
          <div class="input-box">
            <span class="details">Password</span>
            <input type="password" name="password" placeholder="Enter your password" required>
          </div>
          <div class="input-box">
            <span class="details">Confirm Password</span>
            <input type="password" name="confirm_password" placeholder="Confirm your password" required>
          </div>
        </div>
        
        <p class="sign-in" style="text-align: center; margin:30px;" >already have an account? <a href="./login.php">Sign in</a></p>

        <div class="button">
          <input type="submit" name="submit" value="Register">
        </div>
      </form>
    </div>
  </div>

</body>
</html>