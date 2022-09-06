<?php
include __DIR__ . '/includes/constants.php'; 
include __DIR__ . '/includes/db.php';   
include('includes/header.php');
include('includes/navbar.php'); 



if ($_POST) {
    $department_name = $_POST['department_name'] ?? 0; 


    if ($department_name) { 
        $query = 'INSERT INTO department (department_name)
        
      VALUES (?)';       
      
       
        $stmt = $mysqli->prepare($query); 
        $stmt->bind_param('s', $department_name);
        $stmt->execute(); 
        
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
     
    
        <div class="d-flex justify-content-between mb-4">
        <h4>Add New Department</h4>  
        <div>
            <a href="index_department.php" class="btn btn-sm btn-outline-primary">Show Departments</a> 
        </div>
        </div>
       
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
            <div class="row mb-3">
                <label for="department_name" class="col-sm-2 col-form-label">DepartmentName</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="department_name" name="department_name">
                </div>
            </div>  

            <button type="submit" class="btn btn-primary">Add Department</button>
        </form>


    </div>




    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>   
