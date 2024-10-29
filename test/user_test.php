<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect to the login page
    header("Location: ../login.php");
    exit();
}

   
?>
<?php
// user_test.php

// Database connection
include "../connection.php";
// Fetch all questions
$sql = "SELECT * FROM quiz_questions";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Safety Test</title>

    <style>
        /* Container styles */
.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

/* Heading styles */
h2 {
    text-align: center;
    color: #333;
}

/* Question styles */
.test_questions p {
    font-size: 18px;
    margin-bottom: 10px;
    color: #555;
}

/* Radio button styles */
.test_questions label {
    display: block;
    margin-bottom: 10px;
    font-size: 16px;
    color: #666;
}

/* Submit button styles */
button {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 18px;
}

/* Responsive styles for smaller screens */
@media only screen and (max-width: 600px) {
    .container {
        padding: 10px;
    }

    .test_questions p {
        font-size: 16px;
    }

    .test_questions label {
        font-size: 14px;
    }

    button {
        font-size: 16px;
    }
}



    </style>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="container">
    <h2><img style="width: 50px;" src="../assets/img/JSWSTEEL.NS-5d2dda26.png" alt=""> Safety Test </h2>
    <div class="test_questions">
    <form method="post" action="submit.php">
        <?php
        $i=0;
        while ($row = $result->fetch_assoc()) { $i= $i+1;

            echo "<p> $i.{$row['question_text']}</p>
                  <label><input type='radio' name='q{$row['id']}' value='A' required> {$row['option_a']}</label><br>
                  <label><input type='radio' name='q{$row['id']}' value='B' required> {$row['option_b']}</label><br>
                  <label><input type='radio' name='q{$row['id']}' value='C' required> {$row['option_c']}</label><br>
                  <label><input type='radio' name='q{$row['id']}' value='D' required> {$row['option_d']}</label><br>
                  ";
        }
        ?>
        <button type="submit">Submit Test</button>
    </form>
    </div>
    </div>
</body>
</html>
