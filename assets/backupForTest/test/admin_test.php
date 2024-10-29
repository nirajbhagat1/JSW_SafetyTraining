<?php
// admin_test.php

// Database connection
include "../connection.php";
// Add a question
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_question"])) {
    $question_text = $_POST["question_text"];
    $option_a = $_POST["option_a"];
    $option_b = $_POST["option_b"];
    $option_c = $_POST["option_c"];
    $correct_option = $_POST["correct_option"];

    $sql = "INSERT INTO quiz_questions (question_text, option_a, option_b, option_c, correct_option) 
            VALUES ('$question_text', '$option_a', '$option_b', '$option_c', '$correct_option')";

    if ($conn->query($sql) === TRUE) {
        echo "Question added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Delete a question
if (isset($_GET["delete_id"])) {
    $delete_id = $_GET["delete_id"];
    $sql = "DELETE FROM quiz_questions WHERE id = $delete_id";

    if ($conn->query($sql) === TRUE) {
        echo "Question deleted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
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
    <title>Admin Panel</title>


    <style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f2f2f2;
}

.navbar {
    background-color: #333;
    color: white;
    padding: 10px;
    text-align: center;
}

.dashboard {
    width: 200px;
    background-color: #333;
    color: white;
    padding: 10px;
    position: fixed;
    left: 0;
    top: 60px; /* Adjust top position based on your navbar height */
    height: 100%;
    overflow: auto;
}

.add_questions {
    width: 60%;
    margin: 50px auto;
    background-color: white;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.add_questions h2 {
    text-align: center;
    color: #333;
}

form {
    display: flex;
    flex-direction: column;
    align-items: center;
}

label {
    margin-top: 10px;
}

input {
    padding: 10px;
    margin: 5px 0;
    width: 100%;
    box-sizing: border-box;
}

button {
    background-color: #333;
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
}

.quiz_questions {
    margin-top: 50px;
    text-align: center;
}

ul {
    list-style: none;
    padding: 0;
}

li {
    background-color: white;
    margin: 5px 0;
    padding: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

a {
    color: #333;
    text-decoration: none;
}

        
    </style>
</head>
<body>

<div class="add_questions">

    <h2>Admin Panel</h2>
    <form method="post" action="">
        <label>Question Text:</label>
        <input type="text" name="question_text" required><br>
        
        <label>Option A:</label>
        <input type="text" name="option_a" required><br>
        
        <label>Option B:</label>
        <input type="text" name="option_b" required><br>
        
        <label>Option C:</label>
        <input type="text" name="option_c" required><br>
        
        <label>Correct Option (A/B/C):</label>
        <input type="text" name="correct_option" required><br>
        
        <button type="submit" name="add_question">Add Question</button>
    </form>

</div>

<div class="quiz_questions">

    <h3>Quiz Questions</h3>
    <ul>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<li>{$row['question_text']} - 
                  <a href='?delete_id={$row['id']}'>Delete</a></li>";
        }
        ?>
    </ul>
    </div>
</body>
</html>
