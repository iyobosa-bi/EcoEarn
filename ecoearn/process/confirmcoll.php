<?php

session_start();

if(!isset($_SESSION['agent_id'])){
    header("location:../login2.php");
    exit();
}


require_once "../classes/Admin.php";
require_once "../classes/Collector.php";




$ad=new Admin();
$c=new Collector;


if(isset($_POST['collsubmit'])){

    $repid=$_POST['reportid'];
    $collstatus=$_POST['status'];
    
    $colldate=isset($_POST['colldate'])?$_POST['colldate']:"";
    // echo "colldate  is $colldate";
    // exit();

     if($colldate == false ||empty($colldate)){

        $_SESSION['colldatefeedback'] ="Select the appropriate collection date";
        header("location:../confirmcollectiondate.php");
        exit();
      
    }
    else{

    $time=date('Y-m-d H:i:s',strtotime($colldate));

    }
 

// print_r($_POST);
// echo $time;
// exit();

  




// echo $repid;
// echo "<br>";
// echo $collstatus;
// exit();

$res = $c->getpresentcolstatus($repid);


if($res['status'] =='no'){

$c->updatecollectionstatus($collstatus,$time,$repid);

$_SESSION['collhistfeedback'] = "This report has been paid for and collected";
header("location:../collectorhistory.php");

}

else{
    $status='yes';
    $c->updatecollectionstatus($collstatus,$time,$repid);
    header("location:../collectorhistory.php");
}
}

else{

    header("location:../collectorhistory.php");

}

?>