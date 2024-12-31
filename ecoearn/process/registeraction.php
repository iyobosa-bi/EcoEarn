<?php

session_start();
require_once "../classes/User.php";


if(isset($_POST['register-btn'])){

echo"<pre>";
print_r($_POST);
echo"</pre>";

    //    = $_POST[''];
      $firstname = $_POST['firstname'] ;
       $lastname= $_POST['lastname'];
       $phone= $_POST['phone']; 
       $email= $_POST['email'] ;
       $userpass= $_POST['userpass']; 
       $confirmpass= $_POST['confiruserpass'];
       $state= $_POST['state'];
       $lga= $_POST['lga']; 
       $ncity= $_POST['ncity']; 

       if(trim($firstname)==""|| trim($lastname)==""|| trim($phone)==""|| trim($email)==""||trim($userpass)==""||trim($confirmpass)==""||trim($state)==""||trim($lga)==""){

        $_SESSION['regerrormsg'] = "Please complete all the fields";
        header("location:../register.php");
        exit();
    }
    elseif($userpass != $confirmpass){

        $_SESSION['regerrormsg'] = "The passwords do not match";
        header("location:../register.php");
        exit();
    }
    else{
        $ad= new User;
        $id = $ad-> userregister($firstname,$lastname,$email,$userpass,$phone,$state,$lga);

        if($id){
            $_SESSION['regfeedback'] = "Account Created";
            header("location:../login2.php");
            exit();
        }
        else{
            $_SESSION['regerrormsg'] = "Error creating account.Please try again";
            header("location:../register.php");exit();
        }
    }
  
}

else{

    $_SESSION['errormsg'] = "Please complete the form";
    header("location:../register.php");
    exit();
}



?>