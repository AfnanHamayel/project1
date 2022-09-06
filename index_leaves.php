<?php
// show the data that inserted in the database  

include __DIR__ . '/includes/db.php';
include __DIR__ . '/includes/constants.php';
include('includes/header.php');
include('includes/navbar.php'); 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Leaves Management System</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
       
        <div class="d-flex justify-content-between mb-4">
           
        <div>
            <a href="insert_leaves.php" class="btn btn-sm btn-outline-primary">Add Leaves</a>
        </div>

        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>LeaveName</th>
                    <th>LaaveDescribtion</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                $query = 'SELECT * FROM leaves'; 
                $result = $mysqli->query($query); // return mysqli_result

                while ($row = $result->fetch_assoc()) : // featch rows from db 
                ?>
                    <tr>
                      
                        <td><?= $row['leave_name'] ?></td>
                        <td><?= $row['leave_description'] ?></td>
                        <td><a href="edit_leaves.php?leave_type_id=<?= $row['leave_type_id'] ?>" class="btn btn-success">Edit Leave</a></td>
                        <td><a href="delete_leaves.php?leave_type_id=<?= $row['leave_type_id'] ?>" class="btn  btn-danger">Delete Info</a></td>

            
                    </tr>
                <?php
                endwhile
                ?>
            </tbody>
        </table>

    </div>


    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>   