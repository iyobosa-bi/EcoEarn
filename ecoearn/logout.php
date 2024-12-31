<?php


session_start();

require_once "classes/User.php";

$b=new User;
$b->logout();

header("location:login2.php");


?>