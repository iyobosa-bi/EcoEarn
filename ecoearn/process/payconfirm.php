<?php


session_start();

if(!(isset($_SESSION['agent_id']))){
    $_SESSION['errormsg'] = "Login to Access the Page";
    header("location:../login2.php");
  }

require_once "../classes/Payment.php";

if(isset($_POST['btnconfirm'])&&isset($_SESSION['refno'])){
        // echo $_SESSION['refno'];
        // exit();
        $p = new Payment;
        $deets=$p->get_payment_by_ref($_SESSION['refno']);
        // print_r($deets);
        // exit();
        $amt = $_SESSION['payamount'];
        $email  = $deets['email_address'];
        $coll = $deets['first_name'];
        $reference = $_SESSION['refno'];
        $payrsp = $p->paystack_initialize_step_one($amt,$email,$reference);

        // echo "<pre>";
        // print_r($payrsp);
        // echo "</pre>";
        // exit();


        if($payrsp && $payrsp->status == true){

            $auth_url=$payrsp->data->authorization_url;
            header("location:$auth_url");
        }
        else{
            $_SESSION['errmsg']="Payment could not be initiated".$payrsp->message;
            header("location:../collpayment.php");
            exit();

        }
        
        // echo "<pre>";
        // print_r($payrsp);
        // echo "</pre>";
        

}
else{
    header("location../confirm.php");
    exit();
}



?>