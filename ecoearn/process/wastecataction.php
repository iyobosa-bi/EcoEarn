<?php

session_start();
require_once "../classes/Admin.php";
$ad = new Admin;
$catarray=$ad->get_waste_name();
$mainarray=[];

foreach($catarray as $val){

        array_push($mainarray,strtolower($val['cat_name']));
}

// echo "<pre>";
// print_r($mainarray);
// echo "</pre>";
// exit();


//      echo "<pre>";
//      print_r($catarray);
//     echo "</pre>";



// exit();


    $catname = $_POST['wastecat'];
    $point  = $_POST['wastepoint'];
    $price = $_POST['wasteprice'];


    if(empty($catname)||empty($point)||empty($price)){
        echo "<div class='alert alert-warning'>All fields are required</div>";
        exit();
    }

    elseif(in_array(strtolower($catname),$mainarray)){
        echo "<div class='alert alert-danger'>Category already exists</div>";
        exit();
    }
    else{


    $res = $ad->insert_waste_category($catname,$point,$price);

    if($res){
        echo "<div class='alert alert-success'>Category added successfully</div>";
       
    }
    else{
        $_SESSION['nresponse'] = "Error";
        echo "error";
        exit();
    }
    }



// else{
//     header("location:../admindashboard2.php");
//     exit();
// }




?>