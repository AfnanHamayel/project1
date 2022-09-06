<?php
include __DIR__ . '/includes/constants.php';
include __DIR__ . '/includes/db.php';
include('includes/header.php');
include('includes/navbar.php'); 

if ($_POST) {
    //the fileds that i want to chick ,,amount and discribtion 
    $first_name = $_POST['first_name'] ?? 0; //i want to take the value of amount through post 
    //?? 0 chick if i have key amount if not return  
    $last_name = $_POST['last_name'] ?? 0;
    $gender = $_POST['gender'] ?? null;
    $department_name = $_POST['department_name'] ?? null;      
    $email_address = $_POST['email_address'] ?? 0;
    $contact_number = $_POST['contact_number'] ?? 0;

    if ($first_name &&  $last_name && $email_address && $contact_number) { // if i have a value in the amount and discription 
       
        $query = 'INSERT INTO employee (first_name,last_name,gender,department_name,email_address,contact_number
        )
      VALUES (?, ?, ?, ?, ?,?)';  

      
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('ssisss', $first_name, $last_name, $gender,$department_name,$email_address, $contact_number);
        $stmt->execute();
    }
}

// now i want to show the data in the another page 
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
            <h4> Add New Employee </h4> 
            <div>
                <a href="index_employee.php" class="btn btn-sm btn-outline-primary">Show Employees</a>
            </div>
        </div>
      
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
            <div class="row mb-3">
                <label for="first_name" class="col-sm-2 col-form-label">FirstName</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="first_name" name="first_name">
                </div>
            </div>

            <div class="row mb-3">
                <label for="last_name" class="col-sm-2 col-form-label">LastName</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="last_name" name="last_name">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="gender" class="col-sm-2 col-form-label">Gender</label>
                <div class="col-sm-10">
                    <select class="form-select" id="gender" name="gender">
                        <option></option>
                        <?php foreach ($genders as $key => $value) : ?>
                            <option value="<?= $key ?>"><?= $value ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div> 


            
            <div class="mb-3 row">
                <label for="department_name" class="col-sm-2 col-form-label">DepartmentName</label>
                <div class="col-sm-10">
                   <?php
                    $query = "SELECT department_name from department";   
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
                    <input type="email" class="form-control" id="email_address" name="email_address">
                </div>
            </div>

            <div class="row mb-3">
                <label for="contact_number" class="col-sm-2 col-form-label">Contact Number</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="contact_number" name="contact_number">
                </div>
            </div>


            <button type="submit" class="btn btn-primary">Add Employee</button>
        </form>


    </div>




    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html> 

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>