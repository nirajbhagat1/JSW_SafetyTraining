<?php
session_start();
if(!isset($_SESSION['loggedin']) || isset($_SESSION['loggedin'])!=true){
    header("location:login.php");
    exit;
}
?>
<?php
// Connect to the database
include "./connection.php";

// Fetch contact details from the database
$sql = "SELECT admin, email, phone, address FROM contact_details";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html>
<head>
<title>Contact Us</title>

<style>
body {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    margin: 0;
}

.container {
    text-align: center;
    border: 1px solid #ccc;
    padding: 20px;
    max-width: 400px; /* Adjust the max-width as needed */
}
    </style>
</head>
<body>
    <?php
    include"navbar.php"

    ?>
<div class="container">
<h1>Contact Us</h1>
<p>Admin Name: <?php echo $row['admin']; ?></p>
<p>Email: <?php echo $row['email']; ?></p>
<p>Phone: <?php echo $row['phone']; ?></p>
<p>Address: <?php echo $row['address']; ?></p>

</div>

</body>
</html>
