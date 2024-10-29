<?php
session_start();
if(!isset($_SESSION['admin_loggedin']) || isset($_SESSION['admin_loggedin'])!=true){
    header("location: admin_login.php");
    exit;
}
?>
<?php
// admin_test.php

function alert($message) {
  echo "<script type='text/javascript'>alert('$message');</script>";
}

// Database connection
include "../connection.php";
// Add a question
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_question"])) {
    $question_text = $_POST["question_text"];
    $option_a = $_POST["option_a"];
    $option_b = $_POST["option_b"];
    $option_c = $_POST["option_c"];
    $option_d = $_POST["option_d"];
    $correct_option = $_POST["correct_option"];

    $sql = "INSERT INTO quiz_questions (question_text, option_a, option_b, option_c, option_d, correct_option) 
            VALUES ('$question_text', '$option_a', '$option_b', '$option_c', '$option_d', '$correct_option')";

    if ($conn->query($sql) === TRUE) {

      alert("Question Added Sucessfully");


      header("locat ion: admin_test.php");
      exit();

        
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Delete a question
// if (isset($_GET["delete_id"])) {
//     $delete_id = $_GET["delete_id"];
//     $sql = "DELETE FROM quiz_questions WHERE id = $delete_id";


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_id"])) {

    $delete_id = $_POST["delete_id"];
    $sql = "DELETE FROM quiz_questions WHERE id = $delete_id";
    if ($conn->query($sql) === TRUE) {
       alert("Question Deleted Sucessfully");
               echo "<script>window.location.href = '".$_SERVER['PHP_SELF']."';</script>"; // Redirect using JavaScript
        exit();

       
    } else {
        alert( "Error: " . $sql . "<br>" . $conn->error);
    }

}

// Fetch all questions
$sql = "SELECT * FROM quiz_questions";
$result = $conn->query($sql);



$conn->close();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Test| Jsw Safety</title>


<style>



/* Base styles for responsiveness */
body {
  font-family: sans-serif;
  margin: 0;
  padding: 0;
  margin-left: 0;
  


}


.body_container {
  width: 80%;
  margin-left: 0;
  max-width: 800px; /* Adjust for desired maximum width */
  margin: 0 auto; /* Center the container horizontally */
  padding: 20px;
}

/* Form styles for better visual appeal */
.add_questions {
  background-color: #f5f5f5; /* Light gray background for contrast */
  border-radius: 10px; /* Soft rounded corners */
  padding: 30px;
  
}

.add_questions h2 {
  text-align: center;
  margin-bottom: 20px;
}

label {
  display: block; /* Each label on a separate line */
  margin-bottom: 5px;
  font-weight: bold;
}

input[type="text"],
input[type="submit"] {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  margin-bottom: 10px;
}

button[type="submit"] {
  background-color:  #2744a0; /* Green background for the button */
  color: white;
  cursor: pointer;
  border: 1px;
  padding: 7px;
}

/* Table styles for better organization and readability */
.document_table {
  margin-top: 20px;
  width: 100%;
  border-collapse: collapse;
}

.document_table th,
.document_table td {
  padding: 10px;
  text-align: left;
  border: 1px solid #ddd;
}

.document_table th {
  background-color: #f2f2f2; /* Light gray background for table headers */
}

/* Media queries for responsiveness across different screen sizes */
@media (max-width: 600px) {
  .add_questions {
    padding: 20px; /* Reduce padding on smaller screens */
  }

  .document_table {
    font-size: 0.9em; /* Slightly reduce font size for better fit */
  }
} 


    

    
</style>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
   
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
<?php
include "admin_navbar.php";
?>
<!-- 

<div class="px-3 py-2 text-bg-dark border-bottom">
      <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
          <a href="/" class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none">
            <img src="../assets/img/JSWSTEEL.NS-5d2dda26.png" style="width: 80px; margin:0;" alt="">
          </a>

          <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
           
            <li>
              <a href="dashboard.php" class="nav-link text-white">
              <i class='bx bx-grid-alt' ></i> 
              Dashboard
              </a>
            </li>
            <li>
              <a href="admin_test.php" class="nav-link text-white">
              <i class='bx bxs-edit' ></i>
              Test
              </a>
            </li>
            <li>
              <a href="admin_videos.php" class="nav-link text-white">
              <i class='bx bx-video-plus' ></i>
               Video
              </a>
            </li>
            <li>
              <a href="admin_documents.php" class="nav-link text-white">
              <i class='bx bxs-file-doc' ></i>  
              Documents
              </a>
            </li>
            <li>
              <a href="admin_about.php" class="nav-link text-white">
              <i class='bx bxs-info-circle' ></i>
              About Us
              </a>
            </li>
            <li>
              <a href="admin_contact.php" class="nav-link text-white">
              <i class='bx bxs-contact' ></i>  
              Contact Us
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div> -->

<div style="margin-left: 0;" class="body_container" >


<div style="margin-top: 100px; margin-left:0;" class="add_questions ">
    <h2>Add/Delete Questions</h2>
    <form method="post" action="">
        <label>Question Text:</label>
        <input type="text" name="question_text" required><br>
        
        <label>Option A:</label>
        <input type="text" name="option_a" required><br>
        
        <label>Option B:</label>
        <input type="text" name="option_b" required><br>
        
        <label>Option C:</label>
        <input type="text" name="option_c" required><br>

        <label>Option D:</label>
        <input type="text" name="option_d" required><br>
        
        <label>Correct Option (A/B/C/D): (INPUT IN CAPITAL LETTER)</label>
        <input type="text" name="correct_option" required><br>
        
        <button type="submit" name="add_question">Add Question</button>
    </form>

</div>

<!-- <div class="quiz_questions">

    <h3>Quiz Questions</h3>
    <ul>
        <?php
        // while ($row = $result->fetch_assoc()) {
        //     echo "<li>{$row['question_text']} - 
        //           <a href='?delete_id={$row['id']}'>Delete</a></li>";
        // }
        ?>
    </ul>
    </div> -->
<div class="document_table">
    <table>
        <thead>
            <tr>
                <th>Sr No.</th>
                <th>Question</th>
                <th>Answer</th>
                <th>Delete Qns</th>
            </tr>
        </thead>
        <tbody>
            <?php

           $i=0;
            while ($row = mysqli_fetch_assoc($result)) { 
                $i=$i+1;
            ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['question_text']; ?></td>
                    <td>Option_[<?php echo $row['correct_option']; ?>] </td>
                    <!-- <td><a href='?delete_id=<?php echo $row['id']; ?>'>Delete</a></td>
                     -->
                    <td>
                     <form method="post" action="admin_test.php">
                      
                          <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                          <input type="submit" name="Delete" value="Delete" >
                     </form>
                    </td>
                </tr>

                <?php
            }
            ?>
        </tbody>
    </table>

    </div>

</div>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
