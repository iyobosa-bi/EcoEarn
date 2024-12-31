<?php


session_start();

require_once "classes/Admin.php";

$b=new Admin;
$b->logout();

header("location:adminlogin.php");


?>