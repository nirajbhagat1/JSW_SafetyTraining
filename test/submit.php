<?php
    session_start();
    if(!isset($_SESSION['loggedin']) || isset($_SESSION['loggedin'])!=true){
        header("location:login.php");
        exit;
    }
    
  ?>
<?php
// submit_test.php

// Database connection
include"../connection.php";

// Assuming the form data is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $total_marks = 0;

    $total_questions = 0;
    // Iterate through each question
    foreach ($_POST as $key => $value) {
      $total_questions=$total_questions+1;
        // Check if the key is a question (starts with 'q')
        if (substr($key, 0, 1) === 'q') {
            $question_id = substr($key, 1);
            // Fetch correct option from the database
            $sql = "SELECT correct_option FROM quiz_questions WHERE id = $question_id";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $correct_option = $row['correct_option'];

            // Check if the selected option is correct
            if ($value === $correct_option) {
                $total_marks++;
            }
        }
    }

    

    $percentage = ($total_marks/$total_questions)*100;
    
    

   
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
    .custom-modal {
    background-color: blue;
}

    </style>
</head>
<body >

<?php if($percentage>35) :       ?>

<?php $test_result = "Pass"; ?>

<div style=" height:100vh; "  class="modal modal-sheet position-static d-block p-4 py-md-5" tabindex="-1" role="dialog" id="modalSheet">
<div  class="modal-dialog" role="document">
  <div  class="modal-content rounded-4 shadow">
    <div  class="modal-header border-bottom-0">
      <h1 class="modal-title fs-4">Safety Test Result</h1>
      
      <a href="../index.php">  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></a>
    </div>
    <div class="modal-body py-0">
      <p> <h4 class="modal-title fs-5">congratulation🎉 <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest'; ?></h4> <br>You answered <?php echo "$total_marks/$total_questions"; ?> questions correctly, <br> Have Scored <?php echo "$percentage%";?> and Sucessfully Cleared the Safety Test 🎉 <br>You Can Download Your Certificate.</p>
     
    </div>
    <div class="modal-footer flex-column align-items-stretch w-100 gap-2 pb-3 border-top-0">
    <button type="button" class="btn btn-lg btn-primary" onclick="redirectToCertificate()">Download Certificate</button>
    <a href="../index.php" class="btn btn-lg btn-secondary"><button type="button" class="btn  btn-secondary" onclick="close()" data-bs-dismiss="modal">Close</button></a>
    </div>
  </div>
</div>
</div>

<?php  
$sql = "UPDATE user SET safety_test_result='$test_result' WHERE username='" . $_SESSION['username'] . "'";
mysqli_query($conn, $sql);

mysqli_query($conn, $sql);
?>

<?php else :        ?>
  
<?php $test_result = "Fail"; ?>

    <?php $test_result = "Failed"; ?>
<div class=" custom-modal modal modal-sheet position-static d-block bg-body-secondary p-4 py-md-5" tabindex="-1" role="dialog" id="modalSheet">
<div class="modal-dialog" role="document">
  <div class="modal-content rounded-4 shadow">
    <div class="modal-header border-bottom-0">
      <h1 class="modal-title fs-5">Safety Test Result</h1>
    <a href="../index.php">  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></a>
    </div>
    <div class="modal-body py-0">
            <p> Sorry <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest'; ?> you Failed the test <br> <br>You answered <?php echo "$total_marks/$total_questions"; ?> questions correctly, resulting in a <?php echo "$percentage%"; ?></p>
            <p> We encourage you to review the safety material thoroughly and consider retaking the test when you feel confident and ready to reinforce your commitment to safety practices.</p>
    </div>
    <div class="modal-footer flex-column align-items-stretch w-100 gap-2 pb-3 border-top-0">
    <a href="../index.php" class="btn btn-lg btn-secondary"><button type="button" class="btn  btn-secondary" onclick="close()" data-bs-dismiss="modal">Close</button></a>
    
    </div>
  </div>
</div>
</div>
<?php  
$sql = "UPDATE user SET safety_test_result='$test_result' WHERE username='" . $_SESSION['username'] . "'";
mysqli_query($conn, $sql);

mysqli_query($conn, $sql);
?>



<?php endif;  ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<script>
function redirectToCertificate() {
  window.location.href = "certificate-download.php";
}
function close(){
    window.location.href = "./index.php";


}
</script>
</body>
</html>
<?php

$conn->close();
?>