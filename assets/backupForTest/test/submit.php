<?php
// submit_test.php

// Database connection
include"../connection.php";

// Assuming the form data is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $total_marks = 0;

    // Iterate through each question
    foreach ($_POST as $key => $value) {
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

    echo "Total Marks: $total_marks";
}

$conn->close();
?>
