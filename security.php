<?php
include __DIR__ . '/includes/db.php';    


if(!$_SESSION['username'])
{
    header('Location: login.php');
}
?>


