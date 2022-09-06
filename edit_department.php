<?php
include __DIR__ . '/includes/db.php';
include __DIR__ . '/includes/constants.php';

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

if ($_POST) {
    $department_name = $_POST['department_name'] ?? 0;  
   

    if ($department_name) {   
        
        $query = 'UPDATE department SET 
            department_name = ?  
            WHERE department_id = ?    
        '; 

        $stmt = $mysqli->prepare($query); // mysqli_stmt

        $stmt->bind_param('si',$department_name,$department_id);

        $stmt->execute();

        // Redirect
        header('Location: index_department.php?success=1'); 
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
        <h2 class="mb-4">Edit Department</h2>  
        
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) . "?department_id={$department_id}" ?>" method="post">
            <div class="row mb-3">
                <label for="department_name" class="col-sm-2 col-form-label">Department Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="department_name" name="department_name" value="<?= htmlspecialchars($data['department_name']) ?>">
                </div>
            </div>
           

            <button type="submit" class="btn btn-primary">Update Department Info</button>
        </form>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>