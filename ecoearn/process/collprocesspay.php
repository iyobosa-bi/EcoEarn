<?php

session_start();


if(!isset($_SESSION['agent_id'])){
    header("location:../login2.php");
    exit();
}

require_once "../classes/Payment.php";

if(isset($_POST['btn-pay'])){
	
    $p =  new Payment;
    $amt=$_SESSION['payamount'];
    $userid= $_SESSION['payuserid'];
    $agentid = $_SESSION['agent_id'];
    $reportid=$_SESSION['pay_report_id'];
    $ref = time().rand();
    $_SESSION['refno'] = $ref; 



    $rsp = $p->record_payment($ref,$userid,$amt,$reportid,$agentid);
    header("location:../collconfirmpay.php");
    exit();
    
}


else{
    $_SESSION['errormsg'] = "You need to click the button";
    header("location:../collpayment.php");
    exit();
}


?>