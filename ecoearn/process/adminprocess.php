<?php

session_start();

require_once "../classes/Admin.php";

$ad = new Admin;
// $recs = $ad ->adminlogin("theadmin@ecoearn.com");
// echo "<pre>";
// print_r($recs);
// echo "</pre>";

if(isset($_POST['btn-adminlogin'])){

    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

     $admemail = $_POST['email'];
     $admpass = $_POST['pass'];
     $recs = $ad -> adminlogin($admemail);
    //  echo "<pre>";
    // print_r($recs);
    // echo "</pre>";
    $datapass = $recs['admin_password'];

    if(!empty($datapass)){
    $check = password_verify($admpass,$datapass);
    echo $check;
    }

    if(empty(trim($admemail)) || empty(trim($admpass))){
        $_SESSION['nresponse'] = "All Fields are required";
        header("location:../adminlogin.php");
        exit();
      }
     elseif($check == false){
        $_SESSION['nresponse'] = "Incorrect Password";
        header("location:../adminlogin.php");
        exit();
     }
     else{
        
        $_SESSION['presponse'] = "Login Successful";
        $_SESSION['admin_id']=$recs['admin_id'];
        header("location:../admindashboard2.php");
     }
     
}
else{

    $_SESSION['errmsg'] = "Login Failed. Used the Admin Page";
    header("location:../adminlogin.php");
}





?>