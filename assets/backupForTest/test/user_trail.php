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
    <title>User Test</title>
</head>
<body>
    <h2>User Test</h2>
    <form method="post" action="submit.php">
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<p>{$row['question_text']}</p>
                  <label><input type='radio' name='q{$row['id']}' value='A'> {$row['option_a']}</label><br>
                  <label><input type='radio' name='q{$row['id']}' value='B'> {$row['option_b']}</label><br>
                  <label><input type='radio' name='q{$row['id']}' value='C'> {$row['option_c']}</label><br>";
        }
        ?>
        <button type="submit">Submit Test</button>
    </form>
</body>
</html>
