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
   
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        
        <div class="d-flex justify-content-between mb-4">
          
        <div>
            <a href="insert_department.php" class="btn btn-sm btn-outline-primary">Add department</a>
        </div>

        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>DepartmentName</th>
        
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = 'SELECT * FROM department'; 
                $result = $mysqli->query($query); // return mysqli_result

                while ($row = $result->fetch_assoc()) : // featch rows from db 
                ?>
                    <tr>
                      
                        <td><?= $row['department_name'] ?></td>
                        <td><a href="edit_department.php?department_id=<?= $row['department_id'] ?>" class="btn  btn-success">Edit department</a></td>
                        <td><a href="delete_department.php?department_id=<?= $row['department_id'] ?>" class="btn  btn-danger">Delete department</a></td>

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
