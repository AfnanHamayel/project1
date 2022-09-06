<?php
include __DIR__ . '/includes/constants.php'; 
include __DIR__ . '/includes/db.php';    
include('includes/header.php');
include('includes/navbar.php'); 

if ($_POST) {
    //the fileds that i want to chick ,,amount and discribtion 
    $leave_name = $_POST['leave_name'] ?? 0; //i want to take the value of amount through post 
    //?? 0 chick if i have key amount if not return  
    $leave_description = $_POST['leave_description'] ?? 0;
     

    if ($leave_name &&  $leave_description ) { // if i have a value in the amount and discription 
        // insert to data base //to insert to database i need the db connection 
    
        //query to insert data to db 
        $query = 'INSERT INTO leaves (leave_name,leave_description)
        
      VALUES (?, ?)';     
      
        // بدي اعوض بدال من علامات الاستفهام القيم الفعلية  
        $stmt = $mysqli->prepare($query);
        //amount->decimal:'d',description->txt:'s'
        //tag_id->integer:'i' ,,,,   
        $stmt->bind_param('ss',$leave_name,$leave_description); 
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
  
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>
    <div class="container">

        <hr>
        <div class="d-flex justify-content-between mb-4">
        <h4> Add New Leave</h4>  
        <div>
            <a href="index_leaves.php" class="btn btn-sm btn-outline-primary">Show Leaves</a> 
        </div>
        </div>
    
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
            <div class="row mb-3">
                <label for="leave_name" class="col-sm-2 col-form-label">LeaveName</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="leave_name" name="leave_name">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="discription" class="col-sm-2 col-form-label">LeaveDescribtion</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="leave_description" name="leave_description"></textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Add Leave</button>  
        </form>


    </div>        

    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html> 
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>   