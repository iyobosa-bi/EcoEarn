<?php


require_once "../classes/Admin.php";


$ad=new Admin();



$reportid=$_GET['reportid'];
$res=$ad->reports_made_by_id($reportid);

// echo"<pre>";
// print_r($res);
// echo"</pre>";

// exit();

$status=$_GET['status'];
$time=date("F j ,Y,g:i a");
// echo $status;
// exit();

// exit();

if($res['reports_status'] =='pending'){

// echo "success";
$ad->updatereportstatus($status,$time,$reportid);

header("location:../admindashboard2.php");

}

else{
    $status='pending';
    $ad->updatereportstatus($status,$time,$reportid);
    header("location:../admindashboard2.php");
}







?>