<?php

require_once "classes/User.php";


$email =  $_GET['email'];
// echo $email;
// exit();

$u =new User;
$email_exist = $u->check_email($email);



if($email_exist == true){
    echo "<span class='badge bg-danger ms-2'>....Already Registered</span>";
    return true;
}
else{
    echo "<span class='badge bg-success ms-2'>....Email is available</span>";
    return false;
}

?>