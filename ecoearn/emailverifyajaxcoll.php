<?php

require_once "classes/User.php";
require_once "classes/Collector.php";


$email =  $_GET['email'];
// echo $email;
// exit();

$c=new Collector;
$email_exist = $c->check_email($email);


if($email_exist == true){
    echo "<span class='badge bg-danger ms-2'>....Already Registered</span>";
    return true;
}
else{
    echo "<span class='badge bg-success ms-2'>....Email is available</span>";
    return false;
}

?>