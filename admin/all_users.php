<?php
session_start();
if(!isset($_SESSION['admin_loggedin']) || isset($_SESSION['admin_loggedin'])!=true){
  header("location: admin_login.php");
  exit;
}
include "../connection.php";


function alert($message) {
  echo "<script type='text/javascript'>alert('$message');</script>";
}


// Delete a question
if (isset($_GET["delete_id"])) {
  $delete_id = $_GET["delete_id"];
  $sql = "DELETE FROM user WHERE id = $delete_id";

  if ($conn->query($sql) === TRUE) {
     alert("User Deleted Sucessfully");
     echo "<script>window.location.href = '".$_SERVER['PHP_SELF']."';</script>"; // Redirect using JavaScript
     exit();
  } else {
      alert( "Error: " . $sql . "<br>" . $conn->error);
  }
}


?>




<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Users | Jsw Safety</title>
	<style>
		/* Base styles for all devices */
body {
  font-family: sans-serif;
  margin: 0;
  padding: 0;
  background-color:#f5f5f5;
}

.container {
  max-width: 960px; /* Set a maximum width for larger screens */
  margin: 0 auto; /* Center the container horizontally */
  padding: 20px;

  margin-top: 0px;
  margin-left: 50px 
}

.search_form {
  margin-bottom: 20px;
  margin-top: 100px;
}

form input[type="text"],
form input[type="submit"] {
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  margin-right: 10px;
}

form input[type="submit"] {
  background-color:  #2744a0;
  color: white;
  cursor: pointer;
}

table {
  width: 100%;
  border-collapse: collapse;
}

th,
td {
  text-align: left;
  padding: 8px;
  border: 1px solid #ddd;
}

/* Responsive styles for smaller screens */
@media (max-width: 768px) {
  .container {
    padding: 10px;
	margin-top: 0px;
	margin-left: 50px ;
  }

  .search_form input[type="text"] {
    width: 100%;
	margin-top: 5%;
  }

  table {
    font-size: 0.9em;
  }

  th,
  td {
    padding: 5px;
  }
}


		
	</style>
</head>
<body>

<?php
include "admin_navbar.php";
?>


<div class="container">

<div class="search_form">

<form action="" method="post">
    <input type="text" name="search" placeholder="Search by Employee ID or Contractor Name">
    <input type="submit" value="Search">
</form>

</div>


<?php



// Get search query from form (if submitted)
$searchQuery = "";
if (isset($_POST['search'])) {
    $searchQuery = $conn->real_escape_string($_POST['search']); 
}

// Build SQL query based on search criteria
$sql = "SELECT * FROM user";

if (!empty($searchQuery)) {
    $sql .= " WHERE employee_id = '$searchQuery' OR contractor LIKE '%$searchQuery%'";
}

// Execute query
$result = $conn->query($sql);

// Display table header

echo "<table border='1'>";
echo "<tr>
       <th>Full Name</th>
       <th>Username</th>
       <th>Email</th>
       <th>Phone Number</th>
       <th>Employee ID</th>
       <th>Contractor</th>
	     <th>password</th>
       <th>Safety Test Result</th>
       <th>Delete User</th>

       </tr>";

// Display user data if results exist
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['full_name'] . "</td>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['phone_number'] . "</td>";
        echo "<td>" . $row['employee_id'] . "</td>";
        echo "<td>" . $row['contractor'] . "</td>";
		    echo "<td>" . $row['password'] . "</td>";
        echo "<td>" . $row['Safety_test_Result'] . "</td>";
        echo "<td><a href='?delete_id=" . $row['id'] . "'>Delete</a></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7'>No users found.</td></tr>";
}

echo "</table>";


// Close connection
$conn->close();
?>

</div>
</body>
</html>
