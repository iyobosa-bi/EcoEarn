<?php

session_start();
require_once "../classes/User.php";
require_once "../classes/Admin.php";

$r = new User;
$cat=new Admin;

    //  echo "<pre>";
    //  print_r($_POST);
    //  echo "</pre>";
    // exit();


    $wastecat=$_POST['selectwaste'];
    $amt=$_POST['wasteamount'];
    $stateid=$_POST['state'];
    $lgaid=$_POST['lga'];
    $n_add=$_POST['address'];

$response=['feedback'=>'',
            'success'=>false,
            'wastename'=>'',
            'wasteamount'=>'',
            'reportdate'=>'',
            'status'=>'pending',
            'reportref'=>''
            ];

if(empty($wastecat)||empty($stateid) || empty($lgaid) ||empty($n_add)||empty($amt)){
        // $_SESSION['statelgaerr'] = "";
        $response['feedback']= "<div class='alert alert-danger'>All fields are required</div>";
        echo json_encode($response);
        exit();
    }

else{
    if(!empty($wastecat)){
        $cat=$cat->get_category_admin_id($wastecat);
        $wastename=$cat['cat_name'];

        $pointsearned=$cat['points_per_kg'];
       
    }

    if(empty($wastecat)){
        // $_SESSION['statelgaerr'] = "";
        $response['feedback']= "<div class='alert alert-danger'>Waste Type not selected</div>";
        echo json_encode($response);
        exit();
    }


    // echo "<pre>";
    // print_r($_FILES);
    // echo "</pre>";


    // echo "<pre>";
    //  print_r($cat);
    //  echo "</pre>";

    if(!is_numeric($amt)){
        

        $response['feedback']= "<div class='alert alert-warning'>Input appropriate Waste amount(without kg)</div>";
        echo json_encode($response);

        // echo"<div class='alert alert-warning'>Input appropriate Waste amount</div>";
        exit();
    }
    
    if(empty($amt)){
        
        $response['feedback']= "<div class='alert alert-warning'>Waste amount cannot be empty</div>";
        echo json_encode($response);

        // echo"<div class='alert alert-warning'>Waste amount cannot be empty</div>";
        exit();
    }

    if(!isset($_FILES)){

        $response['feedback']= "<div class='alert alert-warning'>Upload waste image</div>";
        echo json_encode($response);

        // echo"<div class='alert alert-warning'>Upload waste image</div>";
        exit();
    }

    if(isset($_FILES) && $_FILES['wasteimg']['error']==0){
        // echo "<pre>";
        // print_r($_FILES);
        // echo "</pre>";

        $ext = pathinfo($_FILES['wasteimg']['name'],PATHINFO_EXTENSION);
        $allowed = ['jpg','png','jpeg','svg'];

        if(!in_array(strtolower($ext),$allowed)){

        $response['feedback']= "<div class='alert alert-warning'>Upload Waste Images with jpg and png formats</div>";
        echo json_encode($response);
        exit();
        // $_SESSION['errwasteimg'] = "Upload Waste Images with jpg and png formats";
        // echo"<div class='alert alert-warning'>Upload Waste Images with jpg and png formats</div>";
    }

        $imgname= $wastecat."_".uniqid().".$ext";
        $temp = $_FILES['wasteimg']['tmp_name'];
        move_uploaded_file($temp,"../uploads/$imgname");
        
     }else{
        $response['feedback']= "<div class='alert alert-warning'>No image uploaded</div>";
        echo json_encode($response);

        // echo"<div class='alert alert-warning'>No image uploaded</div>";
        exit();
     }


     if(empty($stateid) || empty($lgaid) ||empty($n_add)){
        // $_SESSION['statelgaerr'] = "";
        $response['feedback']= "<div class='alert alert-warning'>Select and Input appropriate Location</div>";
        echo json_encode($response);

        // echo"<div class='alert alert-warning'>Select and Input appropriate Location</div>";
        exit();
    }

     else{

        // $response['feedback']= "<div class='alert alert-success'>You have reported a waste.</div>";
        // echo json_encode($response);
        // exit();

        $_SESSION['reportref']= $wastename.time().rand();

      
       
        $pointsperkg=$amt*$pointsearned;

        
         $res=$r->report_waste($_SESSION['user_id'],$n_add,$wastename,$imgname,$amt,$stateid,$lgaid,$wastecat,$_SESSION['reportref'],$pointsearned,$pointsperkg);

         if($res){
        

        // $res1= "<div class='alert alert-success'>You have reported a waste.</div>";
         $response['feedback']= "<div class='alert alert-success'>You have reported a waste.</div>";
         $response['success']=true;
         $response['wastename']=$wastename;
         $response['wasteamount']=$amt;
         $response['reportdate']= date('M-d-Y');
         $response['reportref']=$_SESSION['reportref'];

         echo json_encode($response);
         exit();


         }
         else{

        $response['feedback']= "<div class='alert alert-danger'>Error in Reporting Waste</div>";
        echo json_encode($response);

        // echo "<div class='alert alert-danger'>Error in Reporting Waste</div>";
        exit();
         }
    }

     
}



?>