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

$collcount=$st->getcollectedwastecount($_SESSION['agent_id']);


//   echo "<pre>";
// print_r($collhist);
//  echo "</pre>";
// //  exit();
 
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
                            <p class= "m-3" style="font-size:16px;font-family:'Abril Fatface';">Payment and Collection History</p>

                            <p class="m-3">Track your recent payments and confirm collection of recyclable materials</p>
                        </div>

                        
                    </div>

                    <div class="col-md-12 d-md-flex align-items-center">

                        <button type="button" class="btn btn-dark m-3" style="font-size:12px">Total Successful Payments <span class="badge bg-primary rounded-pill" style="font-size:14px; margin-left:5px;">
                            <?php echo count($collhist); ?>
                        </span>
                        </button>
                        <button type="button" class="btn btn-dark m-3" style="font-size:12px">Total Collected Items <span class="badge bg-primary rounded-pill" style="font-size:14px; margin-left:5px;">
                            <?php echo $collcount['count']; ?>
                        </span>
                        </button>
                    </div>

                    
                

                    <!-- <div class="row">
                        <div class="col-md-3 offset-md-0">
                            <select class="form-select noround" id="searchwastetype">
                            <option value="0" > By Waste category</option>
                            <?php
                            foreach($wastecats as $val){?>
                                    <option value="<?php echo $val['cat_name'] ;?>"><?php echo $val['cat_name'] ;?></option>
                               <?php }
                            ?>
                        </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select noround " id="searchstate" >
                                <option value="0" > By State</option>
                                <?php
                            foreach($states as $val){?>
                                    <option value="<?php echo $val['state_id'] ;?>"><?php echo $val['state_name'] ;?></option>
                               <?php }
                            ?>
                            </select>
                        </div>
                        
                       
                        <div class="col-md-3">
                           
                            <input type="text" name="searchwastekg" id="searchwastevol" class="form-control noround" placeholder="Input waste amount (Kg)">
                            <span id="foremptyfield" style="color:red;font-size:14px;"></span>

                        </div>     
                    
                    </div>  -->

                    
                    <div class="row m-3">
                        <div class="col-12 ">

                                <?php
                                if(isset($_SESSION['collhistfeedback'])){
                                    echo "<p class='alert alert-success alert-dismissible fade show' role='alert'>".$_SESSION['collhistfeedback']."<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </p>";
                                }

                                unset($_SESSION['collhistfeedback']);
                                ?>
                        </div>
                    </div>
                        
                        
                    <div class="collhisttable table-responsive  m-3">

                            <?php 
                            if(count($collhist)>0) {?>
                                <table class="table table-hover table-striped table-sm table-bordered ">
                                    <thead class="table-dark" style="border-radius:5px 5px;font-size:12px;" >
                                        <tr>
                                            <th scope="col">ReportId</th>
                                            <th scope="col">Report_Weight</th>
                                            <th scope="col">Report_Owner</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone_Number</th>
                                            <th scope="col">Payment_status</th>
                                            <th scope="col">RefNo</th>
                                            <th scope="col">Payment_Date</th>
                                            <th scope="col">Amount_paid</th>
                                            <th scope="col">Collection_Status</th>

                                            <th scope="col">Collection_Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody style="border-radius:5px 5px;font-size:12px;">

                                    <?php
                                            $sn=1;
                                    foreach($collhist as $val){?>
                                        <tr>
                                            <td scope="col"><?php echo substr($val['report_ref'],0,17)?></td>
                                            <td scope="col"><?php echo $val['waste_amount'].'kg'?></td>

                                            <td scope="col" class="text-center"><?php echo $cat->username($val['user_id'])['user_name']?></td>
                                            <td scope="col" class="text-center"><?php echo $cat->username($val['user_id'])['email']?></td>
                                            <td scope="col" class="text-center"><?php echo $cat->username($val['user_id'])['phone_number']?></td>
                                            <td scope="col"><?php $astatus=$val['pay_status']; if($astatus=='success'){echo "<span class='badge bg-success p-1'>".$astatus."</span>";}else{echo "<span class='badge bg-warning p-1'>".$astatus."</span>";}  ?></td>
                                            <td scope="col"><?php echo substr($val['ref_no'],0,17)?></td>

                                            <td scope="col" class="text-center"><?php echo date("M/d/Y",strtotime($val['pay_date']))?></td>

                                            <td scope="col" class="text-center"><?php echo "₦".number_format($val['pay_amount'],2)?></td>

                                    
                                            <td scope="col"><?php $astatus=$st->getcollstatusdate($val['report_id'])['status']; if($astatus=='yes'){echo "<span class='badge bg-success p-1'>".$astatus."</span>";}else{echo "<span class='badge bg-secondary p-1'>".$astatus."</span>";}  ?></td>
                                            <td scope="col" class="text-center"><?php  
                                                $dt=date("M/d/Y",strtotime($st->getcollstatusdate($val['report_id'])['collection_date']));
                                                if( $dt != "Jan/01/1970"){
                                                
                                                echo date("M/d/Y",strtotime($st->getcollstatusdate($val['report_id'])['collection_date']));
                                            
                                                }
                                                
                                                else {
                                                    echo "pending";
                                                }?>
                                            </td>
                                           
                                            <td> 


                                                <form action="confirmcollectiondate.php" method="post">
                                                    
                                                    <input type="hidden" name="reportid" value="<?php echo $val['report_id']?>">
                                                    <input type="hidden" name="reportref" value="<?php echo $val['report_ref']?>">
                                                
                                                    <button style="font-size:12px;" type="submit" class="btn btn-success btn-sm" name="confirmcoll">Confirm</button>
                                                    
                                                </form>

                                            </td>
                                        </tr>

                                        <?php }?>
                                    </tbody>
                                </table><?php }

                                else{?>
                                        <div class='alert alert-warning alert-dismissible fade show mt-3' role='alert'>
                                            <strong>No Payments</strong> 
                                            <p>There are no paid or Collected Items</p>
                                        </div>
                                <?php }?>









                            </div>



                </div>

              


               
           
            
        </div>



</div>
    


    <!-- Modal -->
    <div class="modal fade" id="confirmcollection" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLongTitle"><b>Confirm Collection</b></h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="message"></p>
                    
                    <form action="" method="post" enctype = "multipart/form-data" id="reportwasteform">
                        <div class="mb-3">
                            <label for="" class="mb-1">Report Id test</label>

                                    <input type="text" value="<?php echo $val['report_id']?>">
                        </div>
                        <div class="mb-3">
                            <label for="" class="mb-1">Waste Amount(Kg)</label>
                            <input type="text" name="wasteamount" id="wasteamt" class="form-control border-dark noround" placeholder="Enter Waste Weight">
                        </div>

                        <div class="mb-3">
                            <label for="" class="mb-1">Upload Waste Image</label>
                            <input type="file"  class="form-control noround border-dark" name="wasteimg" id="wasteimg" placeholder="Upload Waste Image">
                        </div>

                        <div class="mb-3">
                            <label for="" class="mb-1">Pick Up Location</label>
                            <select name="state" id="state" class="form-select border-dark noround">
                                <option value="">Select State</option>
                                <?php foreach($states as $t){?>
                                    <option value="<?php echo $t['state_id']?>"><?php echo $t['state_name'];?></option>
                                    <?php } ?>
                            </select>
                            <select name="lga" id="lga" class="form-select border-dark noround">
                                <option value="">Select LGA</option>
                            </select>
                            <input type="text" name="address" id="address" class="form-control border-dark noround mt-2" placeholder="Enter Nearest Location">

                        </div>

                    <button class="btn btn-primary mt-3" name= 'btn-report' id='btnreport' type="">Submit Report</button>
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