<?php
// Check for admin login
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

// Handle file upload
if (isset($_POST['upload'])) {

   
    // Get uploaded file information
    $file = $_FILES['document'];

    // Validate file type and size
    $allowed_types = array('avi','mp4', 'mov');
    $file_type = pathinfo($file['name'], PATHINFO_EXTENSION);

    if (!in_array($file_type, $allowed_types)) {
        alert("Invalid file type. Only avi, mov, mp4 files are allowed.");
    } 
    elseif ($file['size'] >  1073741824) { // Assuming a maximum file size of 1GB
        alert("File size exceeds the limit of 1GB.");
    } 
    else { 
        // Sanitize file name and extension separately to mitigate risks
        $file_name = mysqli_real_escape_string($conn, pathinfo($file['name'], PATHINFO_FILENAME));
        $file_extension = mysqli_real_escape_string($conn, $file_type);

        // Generate a unique file name to avoid overwrites
        $new_file_name = uniqid() . '.' . $file_extension;

        // Move uploaded file to a secure location (outside of the web root)
        $upload_dir = "uploaded_videos/";
        move_uploaded_file($file['tmp_name'], $upload_dir . $new_file_name);

        // Store file information in the database, manually escaping values
        $sql = "INSERT INTO videos (title, file_path, type, upload_date) VALUES ('" . $file_name . "', '" . $upload_dir . $new_file_name . "', '" . $file_type . "', NOW() )";      
        mysqli_query($conn, $sql);

        alert("Video Uploaded Sucessfully");

        echo "<script>window.location.href = '".$_SERVER['PHP_SELF']."';</script>"; // Redirect using JavaScript
        exit();
      
    }
}

//Delete videos
if (isset($_GET["delete_id"])) {
  $delete_id = $_GET["delete_id"];
  $sql = "DELETE FROM videos WHERE id = $delete_id";

  if ($conn->query($sql) === TRUE) {
     alert("Video Deleted Sucessfully");
     echo "<script>window.location.href = '".$_SERVER['PHP_SELF']."';</script>"; // Redirect using JavaScript
     exit();
  } else {
      alert( "Error: " . $sql . "<br>" . $conn->error);
  }
}










// Display file upload form
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Videos | Jsw Safety </title>
    <link rel="stylesheet" href="../css/admin_videos.css">

    

</head>
<body>
    

<?php
include "admin_navbar.php";
?>

<div sclass="container">

<div  class="upload_docs">

<h1 style="margin-top: 10%; " >Upload The Video</h1>
<p>File type: Only avi, mov, mp4 files are allowed.</p>
<p>File size limit : 1GB</p>
<form method="post" enctype="multipart/form-data">
    <input id="Choose_file" type="file" name="document">
   <input id="upload_document" type="submit" name="upload" value="Upload Video"> 
</div>

<div class="tabel">
<?php
//for table

$sql = "SELECT * FROM videos";

// Execute query
$result = $conn->query($sql);

// Display table header

echo "<table border='1'>";
echo "<tr>
       <th>Sr No.</th>
       <th>Title</th>
       <th>File Path</th>
       <th>File Type</th>
       <th>Upload Date</th>
       <th>Delete</th>
       </tr>";
 
// Display user data if results exist
if ($result->num_rows > 0) {
  $i=0;
    while ($row = $result->fetch_assoc()) {
        $i=$i+1;
        echo "<tr>";
        echo "<td>" . $i . "</td>";
        echo "<td>" . $row['title'] . "</td>";
        echo "<td>" . $row['file_path'] . "</td>";
        echo "<td>" . $row['type'] . "</td>";
        echo "<td>" . $row['upload_date'] . "</td>";  
        echo "<td><a href='?delete_id=" . $row['id'] . "'>Delete</a></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7'>No users found.</td></tr>";
}

echo "</table>";


?>
</div>
</div>
<?php
mysqli_close($conn);
?>

</body>
</html>




