<?php
session_start();
require_once "../classes/User.php";
$u= new User;

if(isset($_POST['btn-uclogin'])){

    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";

    $email = $_POST['email'] ;
    $password= $_POST['userpass']; //not hashed yet
    $who = $_POST['userorcollector']; 

    $user = $u->login($email,$password); 
    $agent=  $u->collectorlogin($email,$password);

    // print_r($user);
    // exit();
    

    if($user == true && trim($who) == 'user'){
        $_SESSION['user_id'] = $user[0];
        $_SESSION['useractive'] = $user[1];
        
        if($user[1]=="restricted"){
            $_SESSION['restrictmessage'] = "<p class='text-center'>Your Account has been Locked!</p>";
            header("location:../login2.php");
        }
        else{
        header("location:../userdashboard.php");
        exit();}
    }

    elseif($agent == true && trim($who) == 'collector'){
        $_SESSION['agent_id'] = $agent[0];
        $_SESSION['collactive'] = $agent[1];

        
        if($agent[1]=="restricted"){
        // $_SESSION['agent_id'] = $agent;
        $_SESSION['restrictmessage'] = "<p class='text-center'>Your Account has been Locked!</p>";
        header("location:../login2.php");
        }else{
            header("location:../colldashboard.php");
            exit();
        }
       
    }
    else{
        $_SESSION['logerrmsg'] = "Email or Password is Incorrect";
        header("location:../login2.php");
        exit();
    }
}

else{
    header("location:../login2.php");
    exit();
}

?>