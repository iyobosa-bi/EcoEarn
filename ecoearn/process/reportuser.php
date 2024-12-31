<?php


session_start();
require_once "../classes/User.php";
require_once "../classes/Admin.php";
require_once "../classes/Collector.php";


$r = new User;
$cat=new Admin;
$c=new Collector;

$reportrecs=$c->reportswastebyreportid($_SESSION['reportid']);
$userid=$reportrecs[0]['user_id'];


//response to server
    //  echo "<pre>";
    //  print_r($_POST);
    //  echo "</pre>";

    $message=isset($_POST['message'])?$_POST['message']:" ";
    $reason=isset($_POST['reason'])?$_POST['reason']:" ";


    if(!empty($message)&&!empty($reason)){

         $res=$c->complaintsbycollector($_SESSION['reportid'],$reason,$message,$_SESSION['agent_id'],$userid);

         if($res){
            echo "<div class='alert alert-success'>Message sucessfully recorded.</div>";
         }
         else{
            echo "<div class='alert alert-danger'>Please try again</div>";
         }
    }
    else{
        echo "<div class='alert alert-warning'>Both Fields are required</div>";
    }



?>