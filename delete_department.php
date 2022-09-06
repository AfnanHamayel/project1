<?php
include __DIR__ . '/includes/db.php';

$department_id = (int) $_GET['department_id'] ?? 0;
if (!$department_id) {
    header('Location: index_department.php');
    exit;
}

$clean_id = $mysqli->real_escape_string($department_id); 
$query = "SELECT * FROM department WHERE department_id = '$clean_id'"; // safe
$result = $mysqli->query($query);
$data = $result->fetch_assoc();

if (!$data) {                                  
    header('Location: index_department.php');
    exit;
}

if (isset($_POST['confirmed']) && $_POST['confirmed'] == 'yes') {
    $query = 'DELETE FROM department WHERE department_id = ?';

    $stmt = $mysqli->prepare($query); // mysqli_stmt

    $stmt->bind_param('i', $department_id);

    $stmt->execute();

    // Redirect
    header('Location: index_department.php?success=1');
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
      
 
 

        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) . "?department_id={$department_id}" ?>" method="post">
            <h3>Are you sure you want to delete this department(#<?= $department_id ?>)?</h3>
            <button type="submit" class="btn btn-danger" name="confirmed" value="yes">Yes! Delete</button>
            <a href="index_department.php" class="btn btn-dark">No</a> 
        </form>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>   