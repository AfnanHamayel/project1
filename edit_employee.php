<?php
include __DIR__ . '/includes/db.php';
include __DIR__ . '/includes/constants.php';


$employee_id = (int) $_GET['employee_id'] ?? 0;
if (!$employee_id) {
    header('Location: index_employee.php');
    exit;
}

$clean_id = $mysqli->real_escape_string($employee_id);
$query = "SELECT * FROM employee WHERE employee_id = '$clean_id'"; // safe
$result = $mysqli->query($query);
$data = $result->fetch_assoc();
if (!$data) {
    header('Location: index_employee.php');
    exit;
}

if ($_POST) {
    $first_name = $_POST['first_name'] ?? 0;
    $last_name = $_POST['last_name'] ?? 0;
    $gender = $_POST['gender'] ?? null;
    $department_name = $_POST['department_name'] ?? null;
    $email_address = $_POST['email_address'] ?? 0;
    $contact_number = $_POST['contact_number'] ?? 0;

    if ($first_name && $last_name && $email_address && $contact_number) {

        $query = 'UPDATE employee SET 
            first_name = ?,
            last_name = ?,
            gender = ?,
            department_name = ?, 
            email_address = ? , 
            contact_number = ? 
            WHERE employee_id = ?   
        ';

        $stmt = $mysqli->prepare($query); // mysqli_stmt

        $stmt->bind_param('ssisssi', $first_name, $last_name, $gender, $department_name, $email_address, $contact_number, $employee_id);

        $stmt->execute();

        // Redirect
        header('Location: index_employee.php?success=1');
        exit;
    }
}

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
        <h1>Employee Leaves Management System</h1>
        <hr>
        <h2 class="mb-4">Edit Employee Info</h2>

        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) . "?employee_id={$employee_id}" ?>" method="post">
            <div class="row mb-3">
                <label for="first_name" class="col-sm-2 col-form-label">FirstName</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="first_name" name="first_name" value="<?= htmlspecialchars($data['first_name']) ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="last_name" class="col-sm-2 col-form-label">LastName</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="last_name" name="last_name" value="<?= htmlspecialchars($data['last_name']) ?>">

                </div>
            </div>
            <div class="row mb-3">
                <label for="gender" class="col-sm-2 col-form-label">Gender</label>
                <div class="col-sm-10">
                    <select class="form-select" id="gender" name="gender">
                        <option></option>
                        <?php foreach ($genders as $key => $value) : ?>
                            <option value="<?= $key ?>" <?= $key == $data['gender'] ? 'selected' : '' ?>><?= $value ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="department_name" class="col-sm-2 col-form-label">DepartmentName</label>
                <div class="col-sm-10">
                   <?php
                    $query = "SELECT department_name from department ";      
                    $resultset = $mysqli->query($query); // return mysqli_result
                    ?>
                    <select class="form-select" id="department_name" name="department_name"> 
                    <option></option>
                        <?php 
                        while ($rows = $resultset->fetch_assoc()) {
                            $department_name = $rows['department_name']; 
                            echo "<option value = '$department_name'>$department_name</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>


            

            <div class="row mb-3">
                <label for="email_address" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email_address" name="email_address" value="<?= htmlspecialchars($data['email_address']) ?>">

                </div>
            </div>

            <div class="row mb-3">
                <label for="contact_number" class="col-sm-2 col-form-label">ContactNumber</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="contact_number" name="contact_number" value="<?= htmlspecialchars($data['contact_number']) ?>">

                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update Employee Info</button>
        </form>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>