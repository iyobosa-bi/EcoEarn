<?php

session_start();

require_once "../classes/Admin.php";
require_once "../classes/User.php";
require_once "../classes/Collector.php";

if(isset($_POST['btnupdate'])){

    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";

    $fullname =$_POST['fullname'];
    $collemail = $_POST['collemail'];
    $collphone = $_POST['collphone'];
    $collpass = $_POST['collpass'];

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

    if(empty($fullname)|| empty($collemail)||empty($collphone)||empty($collpass)){
        $_SESSION['nfeedback'] = "All fields required for Update";
        header("location:../collprofileupdate.php");
        exit();  

    }
    else{

    $c = new Collector;
    $rsp = $c->update_collprofile($fullname,$collemail,$collphone,$collpass,$_SESSION['agent_id']);

    if($rsp){
    $_SESSION['feedback'] = "Profile Updated Successfully";
    header("location:../collprofileupdate.php");
    exit();}

    else{
        $_SESSION['nfeedback'] = "Update Failed";
        header("location:../collprofileupdate.php");
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