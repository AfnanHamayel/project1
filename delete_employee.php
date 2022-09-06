<?php
include __DIR__ . '/includes/db.php';


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

if (isset($_POST['confirmed']) && $_POST['confirmed'] == 'yes') {
    $query = 'DELETE FROM employee WHERE employee_id = ?';

    $stmt = $mysqli->prepare($query); // mysqli_stmt

    $stmt->bind_param('i', $employee_id);

    $stmt->execute();

    // Redirect
    header('Location: index_employee.php?success=1');
    exit;
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
    
      
        <h2 class="mb-4">Delete Employee Info</h2>

        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) . "?employee_id={$employee_id}" ?>" method="post">
            <h3>Are you sure you want to delete this employee(#<?= $employee_id ?>)?</h3>
            <button type="submit" class="btn btn-danger" name="confirmed" value="yes">Yes! Delete</button>
            <a href="index_employee.php" class="btn btn-dark">No</a> 
        </form>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php
