<?php

session_start();

if(!isset($_SESSION['agent_id'])){
    header("location:login2.php");
    exit();
}

require_once "classes/Admin.php";
require_once "classes/User.php";
require_once "classes/Collector.php";


$u=new User;
$cat=new Admin;
$recs=$cat->get_category_admin();

$st = new Collector;

$coll= $st->collectorall($_SESSION['agent_id']);

$wct=$st->get_user_reports_count($_SESSION['agent_id']); //count of waste reports.

$wc=$st->get_user_reports($_SESSION['agent_id']);

$wastecats=$cat->get_waste_name();

$states = $u->fetchAllStates();

$collhist=$st->getcollhist($_SESSION['agent_id']);



//   echo "<pre>";
// print_r($collhist);
//  echo "</pre>";
// //  exit();
 

//to get the details of the form hidden report.

if(isset($_POST['confirmcoll'])){
    $_SESSION['collreportid'] =  $_POST['reportid'];
    $_SESSION['collreportref'] =  $_POST['reportref'];
}

// else{
//     header("location:collectorhistory.php");
// }


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Fraunces:ital,opsz,wght@0,9..144,100..900;1,9..144,100..900&family=Inter+Tight:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link href="fontawesome/css/all.css" rel="stylesheet" />
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"  type="text/css">
    <link rel="stylesheet" href="adminstyle.css" type="text/css" >


    <style>


.collhisttable{
    font-size:4px;
}
    </style>
</head>
<body>
 
<div class="container-fluid ms-0 ps-0 mt-0">

        <div class="row">
                <div class="col-md-3"  id="sidebar">
                    <div class="d-flex flex-column  p-3" style="min-height: 100vh;" >
                        
                            <!-- <div class="d-flex">
                                <button class="toggle-btn" type="button">
                                    <i class="lni lni-grid-alt"></i>
                                </button>
                            
                            </div> -->

                            <div class="px-3 mt-2">
                                
                                <div class="sidebar-logo">
                                    <a href="#">Eco Earn</a>
                                </div>
                            </div>
                    
                           <?php include_once "partials/collmenu.php";?>

                    </div>
        
                </div>
                <div class="col-md-9" style="background-color:#eee;">
                <nav class="navbar navbar-expand px-4 py-3">
                        
                        <div class=" icons mt-3 d-flex align-items-center gap-4 ms-auto me-2 " style="border:0px solid black;">
                                    <div><p style = "font-size:14px;"><?php echo $coll['first_name']?></p></div>
                                    <div><p style = "font-size:14px;"><i class="fa-solid fa-user"></i></p></div>
                                    <div><p style = "font-size:14px;"><a href="logout.php"><i class="fa-solid fa-power-off" href="logout.php"></i></a></p></div>
                                    <!-- <div style="border:1px solid black;" class="mt-0"><a href="logout.php" style = "font-size:13px;"><i class="fa-solid fa-power-off mb-0"></i></a></div> -->
                        </div>
                </nav>
                <div class="row px-3 mt-3">
                    <div class="col-md-12 welcome d-flex justify-content-between align-items-center">
                      
                        <div>
                            <!-- <p class= "mt-0" style="font-size:14px;">Hello <strong><?php echo $coll['first_name']?></strong></p> -->
                            <p class= "m-3" style="font-size:18px;font-family:'Abril Fatface';">Confirm Collection  for <?php echo $_SESSION['collreportref'] ?></p>
                            <p class= "m-3" style="font-size:15px;">Confirm collection date by filling completing the form below </p>

                        </div>

                        
                    </div>

                   
                    <div class="col-12 ">

                                <?php
                                if(isset($_SESSION['colldatefeedback'])){
                                    echo "<p class='alert alert-warning alert-dismissible fade show' role='alert'>".$_SESSION['colldatefeedback']."<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </p>";
                                }
                                unset($_SESSION['colldatefeedback']);
                                ?>
                    </div>
                

            


                    <div class="col-md-6 mx-3 mt-2">
                        
                        <!-- //collectionform -->
                        <form action="process/confirmcoll.php" method="post">
                            <input type="datetime-local" class="form-control shadow-sm border-dark" name="colldate">
                            <input type="hidden" class="form-control shadow-sm border-dark" value="<?php echo $_SESSION['collreportid']?>" name="reportid">
                            <input type="hidden" class="form-control shadow-sm border-dark" value="yes" name="status">


                            <div class="mt-2">
                                <button class="btn btn-sm btn-primary" name="collsubmit">Confirm Collection</button>
                                <a href="collectorhistory.php" class="btn btn-sm btn-dark">Back</a>
                            </div>
                        </form>

                    </div>
                        
                        
                  



                </div>

              


               
           
            
        </div>



</div>


    <script src="jquery-3.7.1.min.js"></script>
      <script>
         $(document).ready(function(){

            $('#searchwastetype').change(function(){
                var wastecategory = $('#searchwastetype').val(); 
                var state=$('#searchstate').val();
                var weight=$('#searchwastevol').val();

                        $.ajax({
                                type:"GET",
                                url:"searchcategoryajax.php",
                                data:{wastecat:wastecategory,stateid:state,kg:weight},
                        success:function(response){

                            setTimeout(function() {

                            $('.loader').hide();
                            $('.searchresponse').html(response)
                             }, 5000);
                           
                        },
                        error:function(err){
                            alert(err)
                        },
                        beforeSend:function(){
                            $('.loader').show()
                           $('.loader').html('<div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div>')
                            
                        },
                        complete:function(){
                           
                        }

                        })
            })


            //for state
            $('#searchstate').change(function(){

        var wastecategory = $('#searchwastetype').val(); 
        var state=$('#searchstate').val();
        var weight=$('#searchwastevol').val();

        $.ajax({
                type:"GET",
                url:"searchstateajax.php",
                data:{wastecat:wastecategory,stateid:state,kg:weight},
        success:function(response){

            setTimeout(function() {

            $('.loader').hide();
            $('.searchresponse').html(response)
             }, 5000);
           
        },
        error:function(err){
            alert(err)
        },
        beforeSend:function(){
            $('.loader').show()
           $('.loader').html('<div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div>')
            
        },
        complete:function(){
           
        }

        })
})
                $('#searchwastevol').change(function(){
                var wastecategory = $('#searchwastetype').val(); 
                var state=$('#searchstate').val();
                var weight=$('#searchwastevol').val();

                $.ajax({
                        type:"GET",
                        url:"searchkgajax.php",
                        data:{wastecat:wastecategory,stateid:state,kg:weight},
                success:function(response){
                        if(response == "Enter Valid Input in kg"){
                            $('.loader').hide();
                        $('#foremptyfield').html("Enter Valid Input in kg") }
                        else{
                            $('#foremptyfield').html("")
                    setTimeout(function() {
                         
                    $('.loader').hide();
                    $('.searchresponse').html(response)
                    }, 5000);
                }
                
                },
                error:function(err){
                    alert(err)
                },
                beforeSend:function(){
                    $('.loader').show()
                $('.loader').html('<div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div>')
                    
                },
                complete:function(){
                
                }

                })
                })
  
         });
      </script>

<script src="bootstrap/js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <script src="script.js"></script>
</body>

</html>