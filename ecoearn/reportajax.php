<?php

session_start();
// echo json_encode($_POST);
//retrieve all the form values


$selectwaste = $_POST['selectwaste'];
$amt = $_POST['amt'];
$state = $_POST['state'];
$lga = $_POST['lga'];
$address=$_POST['address'];
$wasteimg=$_POST['address'];



if(empty($selectwaste)|| empty($amt)|| empty($state)||empty($lga)||empty($address)){
    
   echo "<div class = 'alert alert-danger'>All fields are required</div>";
    // $_SESSION['testfeedback']="All fiedds needed";
}

else{
    
    echo "<div class = 'alert alert-success'>All fields are done</div>";
     
     exit();
 }















?>