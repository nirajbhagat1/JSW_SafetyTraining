<?php
session_start();
if(!isset($_SESSION['admin_loggedin']) || isset($_SESSION['admin_loggedin'])!=true){
    header("location: admin_login.php");
    exit;
}
?>

<?php
// Connect to the database
include "../connection.php";
function alert($message) {
    echo "<script type='text/javascript'>alert('$message');</script>";
  }
// If form is submitted, update contact details
if (isset($_POST['update'])) {

  $admin = $_POST['admin'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];

  $sql = "UPDATE contact_details SET admin='$admin', email='$email', phone='$phone', address='$address' WHERE id = 1";
  mysqli_query($conn, $sql);
  
  alert("Contacts Updated Sucessfully");

  
}

// Fetch current contact details for display in the form
$sql = "SELECT admin, email, phone, address FROM contact_details";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Contacts | Jsw Safety</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  

<link rel="stylesheet" href="../css/admin_contact.css">
</head>
<body >
  <?php
  include "admin_navbar.php";
  ?>
<h1>Admin Panel - Contact Details</h1>

<?php if (isset($_POST['update'])): ?>
    <p class="success">Contact details updated successfully!</p>
<?php endif; ?>

<div style="margin-top: 2%;" class="container">

<form action="admin_contact.php" method="post">
    <fieldset>
        <legend>Contact Information</legend>

        <div>
            <label for="admin">Admin Name:</label>
            <input type="text" id="name" name="admin" value="<?php echo $row['admin']; ?>" required>
        </div>
 
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required>
        </div>
        <div>
            <label for="phone">Phone:</label>
            <input type="tel" id="phone" name="phone" value="<?php echo $row['phone']; ?>" required>
        </div>
        <div>
            <label for="address">Address:</label>
            <textarea id="address" name="address" required><?php echo $row['address']; ?></textarea>
        </div>
        <button type="submit" name="update">Update Contact Details</button>
    </fieldset>
</form>
</div>


</body>
</html>
