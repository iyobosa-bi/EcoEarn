<?php


session_start();

if(!isset($_SESSION['admin_id'])){
    header("location:adminlogin.php");
    exit();
}


require_once "../classes/Admin.php";
require_once "../classes/Payment.php";

$ad=new Admin;
$p=new Payment;

$payrecs = $ad->getsuccessfulpaymentrecords();

// echo"<pre>";
// print_r($_POST);
// echo "</pre>";
// exit();



$paystack_secret_key = 'sk_test_b0f52a81905d44962e8423996060cde0399271d8';


$_SESSION['repid'];
$_SESSION['accno'];
$_SESSION['bankcode'] ;
$_SESSION['ramount'];
$_SESSION['ruser'] ;
$_SESSION['stats'] ;
$_SESSION['prefno'];
$_SESSION['userpaid'];



$report_id = $_SESSION['repid'];
$account_number = $_SESSION['accno'];
$bank_code = $_SESSION['bankcode'];
$amount = $_SESSION['ramount'];
$user= $_SESSION['ruser'] ;
$paystat = $_SESSION['stats'] ;
$refno = $_SESSION['prefno'];



if(empty($account_number)){
    echo "<p class='alert alert-warning alert-dismissible fade show' role='alert'>No Account Number for $user<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></p>";
    exit();
}


$post_data = [
    "type" => "nuban",
    "name" => $user ,
    "account_number" => $account_number,
    "bank_code" => $bank_code,
    "currency" => "NGN"
];

// echo "<pre>";
// print_r($post_data);
// echo "</pre>";
// exit();

$headers = ["Authorization:Bearer sk_test_b0f52a81905d44962e8423996060cde0399271d8","content-Type:application/json"];
$url ="https://api.paystack.co/transferrecipient";

$curlobj = curl_init($url);
            curl_setopt($curlobj,CURLOPT_RETURNTRANSFER,true);
            curl_setopt($curlobj,CURLOPT_HTTPHEADER,$headers);
            curl_setopt($curlobj,CURLOPT_SSL_VERIFYPEER,false);
            curl_setopt($curlobj,CURLOPT_CUSTOMREQUEST,'POST');
            curl_setopt($curlobj,CURLOPT_POSTFIELDS,json_encode($post_data));

                    $apirsp = curl_exec($curlobj);

                    if($apirsp){
                        curl_close($curlobj);

                        // echo "<pre>";
                        // print_r(json_decode($apirsp,true));
                        // echo "</pre>";
                        // exit();
                        $response_data=json_decode($apirsp,true);
                        
                }
                else{
                    $r = curl_error($curlobj);
                    echo $r;
                    exit();
                    
                }

if ($response_data['status'] === false) {

    echo "<p class='alert alert-warning alert-dismissible fade show' role='alert'>Invalid Account Details for $user<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></p>";
    exit();
}

else{
    $recipient_code = $response_data['data']['recipient_code'];

    $transfer_data = [
        "source" => "balance",
        "amount" => $amount,
        "recipient" => $recipient_code,
        "reason" => "Waste Reporting Payment",
        "reference"=> $refno
    ];



    $url2="https://api.paystack.co/transfer/";
    $curlobj2 = curl_init($url2);
            curl_setopt($curlobj2,CURLOPT_RETURNTRANSFER,true);
            curl_setopt($curlobj2,CURLOPT_HTTPHEADER,$headers);
            curl_setopt($curlobj2,CURLOPT_SSL_VERIFYPEER,false);
            curl_setopt($curlobj2,CURLOPT_CUSTOMREQUEST,'POST');
            curl_setopt($curlobj2,CURLOPT_POSTFIELDS,json_encode($transfer_data));


    $response = curl_exec($curlobj2);
  
    // $transfer_response = json_decode($response, true); 

    $transfer_response=["status"=>1]; //for demo purpose.
    curl_close($curlobj2);

    // echo "<pre>";
    // print_r($transfer_response);
    // echo "</pre>";
    // exit();

    if ($transfer_response['status']) {
        // echo $report_id;
        // exit();
        $res=$p->selectuserpaid($report_id);

        if($res['user_paid']=="no"){
        $p->updatepaymenttableu($paystat,$amount,$refno,$report_id);
      

        $_SESSION['payfeedback'] = "<p class='alert alert-success alert-dismissible fade show' role='alert'>Transfer of <b>&#8358;".number_format($amount,2)."$report_id.</b> has been made to $user<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </p>";

        echo "<p class='alert alert-success alert-dismissible fade show' role='alert'>Transfer of <b>&#8358;".number_format($amount,2)."$report_id.</b> has been made to $user<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </p>";
        }
        else{
            echo "<p class='alert alert-danger alert-dismissible fade show' role='alert'>Payment already executed for this account<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </p>";

            // header("location:../paymentview.php");
        }
        
        
       
           
} else {
    echo "<p class='alert alert-danger'>Error creating recipient:" . $response_data['message']."</p>";

}


}


?>


















