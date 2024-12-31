<?php

session_start();

$reportid=$_GET['report_id'];
// echo $reportid;
// exit();
$_SESSION['reportid']=$reportid;

// echo $_SESSION['reportid'];
// exit();

if(isset($_SESSION['reportid'])){
header("location:../colldashboardverify.php");
}

else{
header("location:../colldashboard.php");
}
















?>