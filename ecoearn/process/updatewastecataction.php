<?php

session_start();

require_once "../classes/Admin.php";
$ad = new Admin;

$catid=$_GET['catid'];
// $_SESSION['catid']=$catid;
    
echo $catid;

$url= "wasteupdatenew.php?catid=".$catid;

if(isset($_POST['updatewastecat'])){

    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";

    // echo "<pre>";
    // print_r($_SESSION['catid']);
    // echo "</pre>";

    $wastecat =  $_POST['wastecat'];
    $wastepoint = $_POST['wastepoint'];
    $wasteprice =  $_POST['wasteprice'];

    if(empty($wastecat)||empty($wastepoint)||empty($wasteprice)){
        $_SESSION['errmsg'] = "All fields are required";
        header("location:../$url");
        exit();
    }
    else{

    $res = $ad->update_waste_cat($wastecat, $wastepoint,$wasteprice,$_SESSION['catid']);

    if($res){
        $_SESSION['feedbackl'] = "Update Successful";
       header("location:../adminwastecategory.php");
        exit();
    }
    else{
        $_SESSION['errmsg'] = "Error in Update";
        header("location:../$url");
        exit();
    }
   
    }

}


?>