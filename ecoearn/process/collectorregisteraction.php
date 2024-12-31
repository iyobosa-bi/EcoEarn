<?php

session_start();
require_once "../classes/User.php";


if(isset($_POST['colregister-btn'])){

echo"<pre>";
print_r($_POST);
echo"</pre>";

      $firstname = $_POST['firstname'] ;
       $lastname= $_POST['lastname'];
       $phone= $_POST['phone']; 
       $email= $_POST['email'] ;
       $userpass= $_POST['pass']; 
       $confirmpass= $_POST['confpass'];

       if(trim($firstname)==""|| trim($lastname)==""|| trim($phone)==""|| trim($email)==""||trim($userpass)==""||trim($confirmpass)==""){

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
        $id = $ad-> colregister($firstname,$lastname,$email,$userpass,$phone);
        
        if($id){
            $_SESSION['regfeedback'] = "Account Created";
            header("location:../login2.php");
            exit();
        }
        else{
            $_SESSION['regerrormsg'] = "Error creating account.Please try again";
            header("location:../register.php");
            exit();
        }
    }
  
}

else{

    $_SESSION['errormsg'] = "Please complete the form";
    header("location:../register.php");
    exit();
}



?>