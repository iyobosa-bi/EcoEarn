<?php


session_start();

require_once "../classes/Admin.php";
require_once "../classes/User.php";
require_once "../classes/Collector.php";

if(isset($_POST['btnupdate'])){

    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    // exit();
    $fullname =$_POST['fullname'];
    $useremail = $_POST['useremail'];
    $userphone = $_POST['userphone'];
    $userpass = $_POST['userpass'];
    $bankname = $_POST['bankname'];
    $accountno = $_POST['accountno'];
    $nearest = $_POST['nearest'];
    $bankcode=$_POST['bank_code'];

    // $file= $_FILES['bizcover'];

    // if(isset($_FILES) && $_FILES['bizcover']['error'] ==0){
    //     $ext = pathinfo($_FILES['bizcover']['name'],PATHINFO_EXTENSION);
    //     $allowed = ['jpg','png','jpeg'];

    //     if(!in_array(strtolower($ext),$allowed)){

    //     $file = $_FILE['bizcover'];
    //     $_SESSION['errormsg'] = "This type of file is not allowed";
    //     header("location:../profile.php");
    //     exit();}
        
    //  }else{
    //     $file =  array();
    //  }

    if(empty($fullname)|| empty($useremail)||empty($userphone)||empty($userpass)||empty($bankname)||empty($accountno)||empty($nearest)||empty($bankcode)){
        $_SESSION['nfeedback'] = "All fields required for Update";
        header("location:../userprofileupdate.php");
        exit();  

    }
    elseif (strlen($accountno)>10  || !is_numeric($accountno)) {
        $_SESSION['nfeedback'] = "Account Number must be valid 10 digits";
        header("location:../userprofileupdate.php");
        exit();  
    }
    
    else{
    
    $u = new User;
    $rsp = $u->update_userprofile($fullname,$useremail,$userphone,$userpass,$bankname,$accountno,$nearest,$bankcode,$_SESSION['user_id']);

    if($rsp){
    $_SESSION['feedback'] = "Profile Updated Successfully";
    header("location:../userprofileupdate.php");
    exit();}

    else{
        $_SESSION['nfeedback'] = "Update Failed";
        header("location:../userprofileupdate.php");
        exit();}
    }

}

else{
    $_SESSION['errormsg'] = "Please complete the form";
    header("location:../collprofileupdate.php");
    exit();
}









?>

































































?>