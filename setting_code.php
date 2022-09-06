


<?php 
include __DIR__ . '/includes/db.php';


?>

<?php 

if(isset($_POST['updatebtn']))
{
    $id = $_POST['edit_id'];
    $email = $_POST['edit_email'];
    $password = $_POST['edit_password'];

    $query = "UPDATE main_admin SET  email='$email', password='$password' WHERE id='$id' ";
    $query_run = mysqli_query($mysqli, $query); 

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Updated";
        $_SESSION['status_code'] = "success";   
        header('Location: setting.php');  
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT Updated";
        $_SESSION['status_code'] = "error";
        header('Location: setting.php');  
    }
}



?> 