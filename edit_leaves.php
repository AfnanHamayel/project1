<?php
include __DIR__ . '/includes/db.php';
include __DIR__ . '/includes/constants.php';
// الهدف من هدا الاي دي اني اجيب البيانات اللي من هدا الريكورد واعرض البيانات في الفورم الموجود تحت
$leave_type_id = (int) $_GET['leave_type_id'] ?? 0;
if (!$leave_type_id) {
    header('Location: index_leaves.php'); 
    exit;
}

$clean_id = $mysqli->real_escape_string($leave_type_id);
$query = "SELECT * FROM leaves WHERE leave_type_id = '$clean_id'"; // safe
$result = $mysqli->query($query);
$data = $result->fetch_assoc();
// اذا ما كان في اي دي موجود في الداتا بيس حولو الى صفحة الاندكيس
if (!$data) {
    header('Location: index_leaves.php'); 
    exit;
}         

if ($_POST) {
    $leave_name = $_POST['leave_name'] ?? 0;  
    $leave_description	= $_POST['leave_description'] ?? 0;
    

    if ($leave_name && $leave_description) {   
        
        $query = 'UPDATE leaves SET 
       
        leave_name = ? , 
        leave_description = ?  
        WHERE leave_type_id = ?    
    ';

        $stmt = $mysqli->prepare($query); // mysqli_stmt

        $stmt->bind_param('ssi', $leave_name ,$leave_description,$leave_type_id);  

        $stmt->execute();

        // Redirect
        header('Location: index_leaves.php?success=1');
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
        <h2 class="mb-4">Edit leaves Information</h2>  
        
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) . "?leave_type_id={$leave_type_id}" ?>" method="post">
            <div class="row mb-3">
                <label for="leave_name" class="col-sm-2 col-form-label">LeaveName</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="leave_name" name="leave_name" value="<?= htmlspecialchars($data['leave_name']) ?>">
                </div>
            </div>
            
            <div class="row mb-3">
                <label for="leave_description" class="col-sm-2 col-form-label">Describtion</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="leave_description" name="leave_description"><?= htmlspecialchars($data['leave_description']) ?></textarea>
                </div>
            </div>        
            <button type="submit" class="btn btn-primary">Update Leaves Info</button>
        </form>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>