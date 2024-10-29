<?php
// --- Start of user_videos.php ---

// Check for user login (replace with your authentication logic)

session_start();
if(!isset($_SESSION['loggedin']) || isset($_SESSION['loggedin'])!=true){
    header("location:login.php");
    exit;
}


// Connect to the database (assuming connection details are in connection.php)
include "connection.php";

// Retrieve video information from the database
$sql = "SELECT * FROM videos WHERE type IN ('avi', 'mp4', 'mov')"; 
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videos</title>
    <link rel="stylesheet" href="styles.css">
    <style>
       /* .video-container{
            margin-top: 100px;
        }

        /* General styling */
body {
  font-family: sans-serif;
  margin: 0;
  padding: 0;
  background-color: #f4f4f4; /* Light gray background */
}

/* Video container */
.video-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-around;
  margin: 50px auto;
  margin-top: 100px;
  max-width: 1200px; /* Adjust as needed */
}

/* Individual video items */
.video-item {
  position: relative;
  width: 48%; /* Adjust for desired layout */
  margin-bottom: 30px;
  box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1); /* Subtle shadow */
  overflow: hidden;
}

.video-item:hover {
  background-color: #fff;
  cursor: pointer;
}

/* Video title */
.video-item h4 {
  color: #333;
  font-size: 18px;
  margin: 15px;
  text-align: center;
}

/* Video player */
.video-item video {
  width: 100%;
  height: 250px; /* Adjust as needed */
  object-fit: cover; /* Ensure videos fill the container */
}

/* Responsiveness */
@media (max-width: 768px) {
  .video-item {
    width: 100%; /* Stack videos on smaller screens */
  }
}

/* Additional styling for visual appeal */
/* ... Add your preferred styles for visual enhancements */

    </style>

</head>
<body>



<?php include "navbar.php"; ?> 
<div class="video-container">
    <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="video-item">
                <h4><?php echo $row['title']; ?></h4>
                <video width="400" controls>
                    <source src="./admin/<?php echo $row['file_path']; ?>" type="video/<?php echo $row['type']; ?>">
                    Your browser does not support the video tag.
                </video>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No videos available.</p>
    <?php endif; ?>
</div>

<?php
mysqli_close($conn);
?>

</body>
</html>


