<?php
// Check for admin login
session_start();
if(!isset($_SESSION['admin_loggedin']) || isset($_SESSION['admin_loggedin'])!=true){
    session_destroy(); 
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
    $allowed_types = array('doc', 'docx', 'pdf', 'ppt', 'pptx');


    $file_type = pathinfo($file['name'], PATHINFO_EXTENSION);
    //The pathinfo() function in PHP returns information about a file path. It can return an associative array containing information about the file or a specific piece of information if a second parameter is provided.
    //$file['name'] retrieves the original name of the uploaded file from the $_FILES superglobal array. This name includes the file extension (e.g., "example.pdf").
    //PATHINFO_EXTENSION is a constant used as the second parameter of the pathinfo() function. It specifies that only the file extension should be returned.


    if (!in_array($file_type, $allowed_types)) {
        alert ("Invalid file type. Only doc, docx, pdf, ppt, and pptx files are allowed.");
    } elseif ($file['size'] > 50000000) { // Assuming a maximum file size of 50MB
        alert("File size exceeds the limit of 47MB.");
    } else { 
        // Sanitize file name and extension separately to mitigate risks
        $file_name = mysqli_real_escape_string($conn, pathinfo($file['name'], PATHINFO_FILENAME));
        $file_extension = mysqli_real_escape_string($conn, $file_type);

        // Generate a unique file name to avoid overwrites
        $new_file_name = uniqid() . '.' . $file_extension;

        // Move uploaded file to a secure location (outside of the web root)
        $upload_dir = "uploads/";
        move_uploaded_file($file['tmp_name'], $upload_dir . $new_file_name);

        // Store file information in the database, manually escaping values
        $sql = "INSERT INTO documents (title, file_path, type, upload_date) VALUES ('" . $file_name . "', '" . $upload_dir . $new_file_name . "', '" . $file_type . "', NOW() )";      
        mysqli_query($conn, $sql);

        alert("Documnet Uploaded Sucessfully");

        echo "<script>window.location.href = '".$_SERVER['PHP_SELF']."';</script>"; // Redirect using JavaScript
        exit();
       
        ;
    }
}

//Delete videos
if (isset($_GET["delete_id"])) {
  $delete_id = $_GET["delete_id"];
  $sql = "DELETE FROM documents WHERE id = $delete_id";

  if ($conn->query($sql) === TRUE) {
     alert("Document Deleted Sucessfully");
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
    <title>Admin Documents | Jsw Safety </title>
    <link rel="stylesheet" href="../css/admin_videos.css">
</head>
<body >
    

<?php
include "admin_navbar.php";
?>


<div class="upload_docs">
<h2 style="margin-top: 10%;" >Upload The Document</h2>
<p>file type: Only doc, docx, pdf, ppt, and pptx files are allowed.</p>
<p>File size limit : 47MB</p>
<form method="post" enctype="multipart/form-data">
    <input id="Choose_file" type="file" name="document">
   <input id="upload_document" type="submit" name="upload" value="Upload Document"> 
</div>



<div class="tabel">
<?php
//for table

$sql = "SELECT * FROM documents";

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




