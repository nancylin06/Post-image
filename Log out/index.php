<?php
session_start();

$_SESSION['user_name'] = null;
$_SESSION['user_id'] = null;
header('location:../Log in/index.php');
?>