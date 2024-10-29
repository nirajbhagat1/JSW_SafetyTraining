<?php
session_start();
if(!isset($_SESSION['loggedin']) || isset($_SESSION['loggedin'])!=true){
    header("location:login.php");
    exit;
}
?>
<?php

include "./connection.php";

$sql = "SELECT about FROM about";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
?>


<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <title> An About Us Page </title>
  
  <link rel="stylesheet" href="./css/about.css">
</head>
<body>
   <?php
   include "navbar.php"

   ?>
  
  <!--<section class="about-us">
    <div class="about">
    <img class="image" src="./assets/img/Fundamental-Analysis-of-JSW-Steel-Cover-Image-1080x675.jpg" class="pic"> 
      <div class="text">
        <h2 class="about">About Us</h2>
        <h5><span>leading </span>Steel manufacturer </h5>
          <p> </p>
             <div class="data">
        <a href="#" class="hire">Hire Me</a>
        </div>
      </div>
    </div>
  </section> -->
  

  <div class="container col-xxl-8 px-4 py-5">
    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
      <div class="col-10 col-sm-8 col-lg-6">
        <img src="./assets/img/Fundamental-Analysis-of-JSW-Steel-Cover-Image-1080x675.jpg" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
      </div>
      <div class="col-lg-6">
        <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">About Us</h1>
        <h2><span>leading </span>Steel manufacturer </h2>
        <p class="lead"> <?php echo $row['about']; ?></p>
        
      </div>
    </div>
  </div>

</body>
</html>

