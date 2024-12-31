<?php


require_once "classes/Admin.php";
$ad = new Admin();


if(isset($_GET['catid'])){
$catid = $_GET['catid'];

$res=$ad->removewastecat($catid);

if($res){

    $_SESSION['deletemsg']="Category Deleted";
    header("location:adminwastecategory.php");
}
else{
    $_SESSION['deletemsg']="Error in Deleting Category";
    header("location:adminwastecategory.php");
}

}
else{
    header("location:adminwastecategory.php");
}














?>