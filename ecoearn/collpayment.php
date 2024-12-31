<?php

session_start();

if(!isset($_SESSION['agent_id'])){
    header("location:login2.php");
    exit();
}


require_once "classes/Admin.php";
require_once "classes/User.php";
require_once "classes/Collector.php";
require_once "classes/Payment.php";



$_SESSION['reportid'];
// $reportid=$_GET['report_id'];
// echo $reportid;
// exit();
$c=new Collector;
if(isset($_SESSION['reportid'])){
$reportrecs=$c->reportswastebyreportid($_SESSION['reportid']);
}
else{
    header("location:colldashboard.php");
}
// echo "<pre>";
// print_r($reportrecs);
// echo "</pre>";

// exit();


$cat=new Admin;
$recs=$cat->get_category_admin();

$st = new Collector;

$coll= $st->collectorall($_SESSION['agent_id']);


$wct=$st->get_user_reports_count($_SESSION['agent_id']); //count of waste reports.

$wc=$st->get_user_reports($_SESSION['agent_id']);

$wastecats=$cat->get_waste_name();

$p=new Payment;
$pricedet=$p->getpricingfromwastecategory($reportrecs[0]['cat_id']);

// echo "<pre>";
// print_r($reportrecs);
// echo "</pre>";

// exit();


$payamount = $reportrecs[0]['waste_amount']*$pricedet[0]['points_per_kg']*$pricedet[0]['price_per_point'];
$_SESSION['payamount'] = $payamount;
$_SESSION['payuserid']=$reportrecs[0]['user_id'];
$_SESSION['pay_report_id']=$reportrecs[0]['report_id'];
$akg= $pricedet[0]['points_per_kg']*$pricedet[0]['price_per_point'];
// echo $payamount;
// exit();
//   echo "<pre>";
// print_r($pricedet);
//  echo "</pre>";
//  exit();
 
?>

<!DOCTYPE html>
<html lang="en">
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

        .test{
           display:none
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
                
                <div class="row align-items-center">
                  
                    <div class="col-md-7 ">
                        <div class="card m-5 shadow-sm" style="width:110%;">
                                    <div class="card-body" >

                                        <h3><b>Payment for-</b><i style="font-size:20px;"><?php echo $reportrecs[0]['report_ref']?></i></h3>
                                        <span style="white-space: nowrap; font-size:14px;">
                                            Report by @<?php echo $reportrecs[0]["user_name"]; ?> on <?php echo date("M/d/Y",strtotime($reportrecs[0]["report_date"]));?>
                                        </span>
                                    
                                        <form action="process/collprocesspay.php" method='post'>

                                            <div class="mb-3"></div>
                                                <label for=""><b>Pay Amount</b></label>
                                                <p>&#8358;<?php echo number_format($payamount,2)?><p>
                                                <div class = 'mb-3'>
                                                <button class='btn btn-danger' type ='button' onclick="document.location.href='colldashboard.php'" >Cancel</button>
                                                <button class='btn btn-primary ' name="btn-pay" >Pay</button>
                                                <p class="mt-2">1kg of <?php echo $reportrecs[0]['waste_type']?> is approximately &#8358;<?php echo $akg ?></p>
                                            </div>

                                            </div>
                                        </form>
                                        

                                       
                                    </div>
                        </div>
                    </div>
                   
                </div> 

            <!-- <div class="row ">
                <div class="col-md-4 mb-2">
                        <div class="card shadow-sm">
                                <img src="uploads/<?php echo $reportrecs[0]['waste_image']; ?>" class="img-fluid" alt="Waste Image">
                                <div class="card-body">
                                    <span style="white-space: nowrap; font-size:11px;">
                                        Report by @<?php echo $reportrecs[0]["user_name"]; ?>
                                    </span>
                                    <h3 style="font-size:15px; font-weight:600;">
                                        <?php echo $reportrecs[0]["waste_type"] . ' (' . $reportrecs[0]["waste_amount"] . ' kg)'; ?>
                                    </h3>
                                    <span style="font-size:11px;">
                                        <?php echo "Date: " . date("M-d-Y", strtotime($reportrecs[0]["report_date"])); ?>
                                    </span>
                                    <br>
                                    <span style="white-space: nowrap; font-size:11px;">
                                        <?php echo "State: " . ($c->fetchAllStatesById($reportrecs[0]["state_id"])['state_name']); ?>
                                    </span>
                                </div>
                        </div>
                </div>
                <div class="col-mb-4 shadow-sm">
                    <div class="card shadow-sm">
                            <img src="uploads/<?php echo $reportrecs[0]['waste_image']; ?>" class="img-fluid" alt="Waste Image">
                            <div class="card-body">
                            <span style="white-space: nowrap; font-size:11px;">
                                Report by @<?php echo $reportrecs[0]["user_name"]; ?>
                            </span>
                            <h3 style="font-size:15px; font-weight:600;">
                                <?php echo $reportrecs[0]["waste_type"] . ' (' . $reportrecs[0]["waste_amount"] . ' kg)'; ?>
                            </h3>
                            <span style="font-size:11px;">
                                <?php echo "Date: " . date("M-d-Y", strtotime($reportrecs[0]["report_date"])); ?>
                            </span>
                            <br>
                            <span style="white-space: nowrap; font-size:11px;">
                                <?php echo "State: " . ($c->fetchAllStatesById($reportrecs[0]["state_id"])['state_name']); ?>
                            </span>
                           
                            </div>
                        </div>
                    </div>
            </div> -->

        </div>








              </div>


               
           
            
        </div>



</div>
    

<!-- report modal -->
<div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="reportModalLabel">Report User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="loader"></div>
        <p id="cresponse"></p>
        <form id="reportform">
          <div class="mb-3">
            <label for="reportType" class="form-label">Report Type</label>
            <select class="form-select" id="reason" name="reason" required>
              <option value="" selected>Select Reason</option>
              <option value="Fake Report">Fake Report</option>
              <option value="Incorrect Information">Incorrect Information</option>
              <option value="Wrong Weight">Wrong Weight</option>
              <option value="Others">Others</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="comments" class="form-label">Message</label>
            <textarea class="form-control" id="message" rows="4" required name="message" placeholder="Provide any additional details or comments about the report"></textarea>
          </div>

          <button type="submit" class="btn btn-primary col-12">Submit Report</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLongTitle">Report Waste</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="message"></p>
                    

                    <form action="" method="post" enctype = "multipart/form-data" id="reportwasteform">
                        <div class="mb-3">
                            <label for="" class="mb-1">Select Waste Category</label>
                            

                            <select name="selectwaste" id="selectwaste" class="form-select noround border-dark">
                                <option value="">Select Waste Type</option>
                                <?php
                                    foreach($recs as $val){?>
                                         <option value="<?php echo $val['cat_id']?>"><?php echo $val['cat_name']?></option>
                                    <?php }
                                ?>
                            </select>
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

                    $('#apply_btn').click(function(){

                                // $('#apply_btn').html('Applied');
                                // $('test').show();
                                $('.test').toggle();

                            
                    


                    })

                    // ncommscdetails
                    // if(($('.ncomms').prop('checked')==true && $('.cdetails').prop('checked')==true)){
                    //         // $('.pay').prop('disabled',false);
                    //         alert('Hello');
                    // }

                    // if($('.ncomms').prop('checked')==true){
                    //         alert('Hello');
                    // }
                    $('.ncomms').change(function(){
                       if(($('.ncomms').prop('checked')==true && $('.cdetails').prop('checked')==true)){
                            $('.pay').prop('disabled',false);
                            $('.report').prop('disabled',true);

                       }
                    else{
                        $('.pay').prop('disabled',true);
                        $('.report').prop('disabled',false);
                    }
                    })

                    $('.cdetails').change(function(){
                       if(($('.ncomms').prop('checked')==true && $('.cdetails').prop('checked')==true)){
                            $('.pay').prop('disabled',false);
                            $('.report').prop('disabled',true);
                       }
                    else{
                        $('.pay').prop('disabled',true);
                        $('.report').prop('disabled',false);
                    }
                    })
                    

            $('#searchwastetype').change(function(){

                var wastecategory = $('#searchwastetype').val(); 

                        $.ajax({
                                type:"GET",
                                url:"searchajax.php",
                                data:{wastecat : wastecategory},
                        success:function(response){

                            setTimeout(function() {

                            $('.loader').hide();
                            $('.searchresponse').html(response)
                             }, 3000);
                           
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

             
            $('#reportform').submit(function(event){

                event.preventDefault();


                var formData= new FormData(this)

                $('#rexample').click(function(){
                    $('#cresponse').html('')
                })

                $.ajax({
                        type:"post",
                        url:"process/reportuser.php",
                        dataType:'text',
                        data:formData,
                        processData: false,
                        contentType: false,
                        success:function(response){

                            setTimeout(function() {
                            
                            $('.loader').hide();
                             $('#cresponse').html(response)
                             $('#message').val('');
                             $('#reason').val('');
                             }, 3000);

                            
                            
                        
                            // console.log(response)
                        },
                        error:function(err){
                            alert(err)
                        },
                        beforeSend:function(){
                            $('.loader').show();
                            $('.loader').html('<div class="text-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>')
                            
                        },
                        complete:function(){
                            
                        }
                    })


            })
                
         });



         
      </script>
<script src="bootstrap/js/bootstrap.bundle.min.js" type="text/javascript"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl);
        });
    });
</script>
</body>

</html>