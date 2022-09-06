<?php
include __DIR__ . '/includes/db.php';

$leave_type_id = (int) $_GET['leave_type_id'] ?? 0;
if (!$leave_type_id) {
    header('Location: index_leaves.php');
    exit;
}

$clean_id = $mysqli->real_escape_string($leave_type_id); 
$query = "SELECT * FROM leaves WHERE leave_type_id = '$clean_id'"; // safe
$result = $mysqli->query($query);
$data = $result->fetch_assoc();

if (!$data) {      
    header('Location: index_leaves.php');
    exit;
}    

if (isset($_POST['confirmed']) && $_POST['confirmed'] == 'yes') {
    $query = 'DELETE FROM leaves WHERE leave_type_id = ?';

    $stmt = $mysqli->prepare($query); // mysqli_stmt

    $stmt->bind_param('i', $leave_type_id); 

    $stmt->execute();

    // Redirect
    header('Location: index_leaves.php?success=1');  
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
   
       

        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) . "?leave_type_id={$leave_type_id}" ?>" method="post">
            <h3>Are you sure you want to delete this employee(#<?= $leave_type_id ?>)?</h3>
            <button type="submit" class="btn btn-danger" name="confirmed" value="yes">Yes! Delete</button>
            <a href="index_leaves.php" class="btn btn-dark">No</a> 
        </form>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>