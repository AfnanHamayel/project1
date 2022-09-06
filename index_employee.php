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
                <a href="insert_employee.php" class="btn btn-primary">Add Employees</a>
            </div>

        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>FirstName</th>
                    <th>LastName</th>
                    <th>Gender</th>
                    <th>DepartmentName</th>
                    <th>Email</th>
                    <th>ContactNumber</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = 'SELECT * FROM employee ';
                $result = $mysqli->query($query); // return mysqli_result

                while ($row = $result->fetch_assoc()) : // featch rows from db 
                ?>
                    <tr>

                        <td><?= $row['first_name'] ?></td>
                        <td><?= $row['last_name'] ?></td>
                        <td><?= $genders[$row['gender']] ?? '-' ?></td>
                        <td><?= $row['department_name'] ?? '-' ?></td>
                        <td><?= $row['email_address'] ?></td>
                        <td><?= $row['contact_number'] ?></td>
                        <td><a href="edit_employee.php?employee_id=<?= $row['employee_id'] ?>" class="btn  btn-success">Edit Info</a></td>
                        <td><a href="delete_employee.php?employee_id=<?= $row['employee_id'] ?>" class="btn  btn-danger">Delete Info</a></td>

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