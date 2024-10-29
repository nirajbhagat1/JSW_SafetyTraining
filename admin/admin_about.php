<?php
session_start();
if(!isset($_SESSION['admin_loggedin']) || isset($_SESSION['admin_loggedin'])!=true){
    header("location: admin_login.php");
    exit;
}
?>
<?php

include "../connection.php";
function alert($message) {
    echo "<script type='text/javascript'>alert('$message');</script>";
  }

if (isset($_POST['update'])){
    $about = $_POST['about'];

$sql = "UPDATE about SET about='$about' WHERE id=1 ";
mysqli_query($conn, $sql);

alert("About us Updated Sucessfully");

}

// Fetch current contact details for display in the form
$sql = "SELECT about FROM about";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin About| Jsw Safety</title>
    <link rel="stylesheet" href="../css/adminabout.css">
    
</head>

<body>

 <?php
  include "admin_navbar.php";
  ?>

<div class="container" style="margin-top:0;">
    <form style="margin-top: 10%;" action="admin_contact.php" method="post">
        <fieldset>
            <legend>About us Information</legend>

        
            <div>

                <label for="about">About us:</label>
                <textarea id="about" name="address" required><?php echo $row['about']; ?></textarea>
           
            </div>

            <button style="background-color: #2744a0;" type="submit" name="update">Update</button>
        </fieldset>
    </form>

</div>
    
</body>
</html>