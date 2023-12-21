<?php
session_start();
 
$_SESSION['login'] = false;
unset($_SESSION['user']);
 
header("location: ../index.php");
exit();
?>