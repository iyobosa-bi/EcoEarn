<?php


require_once "../classes/Admin.php";


$ad=new Admin();

$userid=$_GET['userid'];
$res=$ad->getdetailsuserbyid($userid);

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

// echo "success";
$ad->updateuserstatus($status,$userid);

header("location:../usersview.php");

}

else{
    $status='active';
    $ad->updateuserstatus($status,$userid);
    header("location:../usersview.php");
}







?>









