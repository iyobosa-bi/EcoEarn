<?php


require_once "../classes/Admin.php";


$ad=new Admin();

$agentid=$_GET['agentid'];
$res=$ad->getdetailscollbyid($agentid);

// echo"<pre>";
// print_r($res);
// echo"</pre>";

// exit();

$status=$_GET['astatus'];
$time=date("F j ,Y,g:i a");
// echo $status;
// exit();

// exit();


if($res['active_status'] =='active'){

$ad->updatecollstatus($status,$agentid);

header("location:../collectorsview.php");

}

else{
    $status='active';
    $ad->updatecollstatus($status,$agentid);
    header("location:../collectorsview.php");
}







?>









