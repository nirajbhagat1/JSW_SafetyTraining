<?php
// 1. Connect to the database:
include "./connection.php";

// 2. Retrieve document information (manual escaping):
$id = mysqli_real_escape_string($conn, $_GET['id']); // Sanitize the ID to mitigate SQL injection risks
$sql = "SELECT title, file_path FROM documents WHERE id = $id";
$result = mysqli_query($conn, $sql);


// Error handling for query:
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);

if (!$row) {
    die("File information not found.");
}

// 3. Validate file existence and authorization:
$file_path = realpath($row['file_path']);
echo $file_path;



//if (!file_exists($file_path))

if (!file_exists($file_path)) {
    echo $file_path;
    die("File not found.");
}


// Authorization check (example):
// if (!is_authorized_to_download($file_path)) {
//     die("Unauthorized access.");
// }

// 4. Set download headers:
header("Content-Type: " . mime_content_type($file_path)); // Set correct MIME type
header("Content-Disposition: attachment; filename=" . basename($file_path)); // Force download
header("Content-Length: " . filesize($file_path)); // Provide file size

// 5. Read and output file contents:
readfile($file_path); // Efficiently send file contents

// 6. Exit:
exit(); // Prevent further script execution
?>
