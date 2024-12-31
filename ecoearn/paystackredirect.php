<?php


session_start();

if(!(isset($_SESSION['agent_id']))){
    $_SESSION['errormsg'] = "You must be logged in to access this Page";
    header("location:login2.php");
  }

  require_once "classes/Payment.php";

  $ref=$_SESSION['refno'];
  $reportid=$_SESSION['pay_report_id'];
  if(isset($_SESSION['refno'])){
        $p=new Payment;
        $data = $p->paystack_verify_step_two($ref);

        $status=$data->status;
        $actual_amt=$data->data->amount;
        $response = $data->data->gateway_response;


        $p->update_payment($status,$ref,$reportid,$_SESSION['agent_id']);
        header("location:collectorhistory.php");
        exit();
  }
    else{
        $_SESSION['errormsg']="Please start the payment process";
        header("location:collpayment.php");
        exit();
    

  }
  
  

?>
