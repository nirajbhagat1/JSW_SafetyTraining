<?php
session_start();
if(!isset($_SESSION['loggedin']) || isset($_SESSION['loggedin'])!=true){
    header("location:login.php");
    exit;
}
?>

<?php
// Connect to database
include "./connection.php";

// Fetch documents from database
$query = "SELECT * FROM documents";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>Document</title>

    <style>
            body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .document_table {
            width: 80%; /* Adjust the width as needed */
            margin: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        button {
            padding: 5px 10px;
            cursor: pointer;
        }

    </style>
</head>
<body>
<?php
include "navbar.php";
?>


    




<?php


// Display documents with download links
if (mysqli_num_rows($result) > 0) {
?>
    <div class="document_table">
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Uploaded On</th>
                <th>Download</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo date("d-m-Y", strtotime($row['upload_date'])); ?></td>                             
                    <!--<td><a href="download.php?id=<?php echo $row['id'];?>">Download</a></td>-->
                  <td> <button style="background-color: #2744a0;;"> <a style="text-decoration: none; " download="<?php echo $row['title']; ?>" href="./admin/<?php echo $row['file_path']; ?>">Download</a>  </button> </td> 
                   
                    
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>

    

    </div>


    
    <?php
} else {
    echo "No documents found.";
}

mysqli_close($conn);
?>


</body>
</html>