<?php

session_start();


if(!isset($_SESSION['user_id'])){
    header("location:login2.php");
    exit();
}

if(isset($_SESSION['user_id']) && $_SESSION['useractive']=="restricted"){
    header("location:login2.php");
    exit();
}

require_once "classes/Admin.php";
require_once "classes/User.php";

$cat=new Admin;
$recs=$cat->get_category_admin();

$st = new User;
$states = $st->fetchAllStates();

$user= $st->userall($_SESSION['user_id']);


$wct=$st->get_user_reports_count($_SESSION['user_id']); //count of waste reports.
$wc=$st->get_user_reports($_SESSION['user_id']);
$uar = $st->approvedreports($_SESSION['user_id']);
$uap=$st->useramountpayment($_SESSION['user_id']);
$uapc=$st->getpointsearnedaftercollectorspayment($_SESSION['user_id']);


//  echo "<pre>";
// print_r($wc);
//  echo "</pre>";

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporter-Dashboard</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Fraunces:ital,opsz,wght@0,9..144,100..900;1,9..144,100..900&family=Inter+Tight:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link href="fontawesome/css/all.css" rel="stylesheet" />
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"  type="text/css">
    <link rel="stylesheet" href="adminstyle.css" type="text/css" >
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
                    
                           <?php include_once "partials/usermenu.php";?>

                    </div>
        
                </div>

                <div class="col-md-9" style="background-color:#eee;">

               
                <nav class="navbar navbar-expand px-4 py-3">
                        
                        <div class=" icons mt-3 d-flex gap-3 ms-auto me-2 " style="border:0px solid black;">
                                    <p style = "font-size:16px;"><?php echo $user['user_name']?></p>
                                    <div ><p style = "font-size:18px;"><i class="fa-solid fa-user"></i></p></div>
                                    <div><a href="logout.php" style = "font-size:18px;"><i class="fa-solid fa-power-off"></i></a></div>

                        </div>
                </nav>

                <div class="row px-3 mt-3">
                    <div class="col-md welcome d-flex justify-content-between align-items-center">
                      
                        <div>Hello <strong><?php echo $user['user_name']?></strong>,Welcome to your Eco-Earn Dashboard.</div>
                        <div ><button type="button" id='example' class="btn btn-dark btnreport px-3 py-2 " data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                                Report Waste
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row px-3 mt-3">
                    <div class="col-md-3 ">
                            <div class=" card cardstats shadow-md p-3">
                                <div class="card-header-custom">
                                    <i class="fas fa-trash-alt icon"></i>
                                </div>
                                <div class="card-body-custom mt-2">
                                    <div class="card-stat"><strong><?php echo $wct['wastecount']?></strong></div>
                                    <p class="mt-2 mb-0">Your Waste Reports</p>
                                </div>
                    
                            </div>
                    </div>

                    <div class="col-md-3 ">
                            <div class=" card cardstats shadow-md p-3">
                                <div class="card-header-custom">
                                    <i class="fas fa-trash-alt icon"></i>
                                </div>
                                <div class="card-body-custom mt-2">
                                    <div class="card-stat"><strong><?php echo $uar['count']?></strong></strong></div>
                                    <p class="mt-2 mb-0">Your Approved Reports</p>
                                </div>
                    
                            </div>
                    </div>

                    <div class="col-md-3 ">
                            <div class=" card cardstats shadow-md p-3">
                                <div class="card-header-custom">
                                 <i class="fa-solid fa-download text-success"></i>
                                </div>
                                <div class="card-body-custom mt-2">
                                <div class="card-stat"><strong><?php if($uapc['sum']==false){echo 0;} else{echo number_format($uapc['sum'],0);}?></strong></div>

                                    <p class="mt-2 mb-0">Total points earned</p>
                                </div>
                    
                            </div>
                    </div>

                    <div class="col-md-3 ">
                            <div class=" card cardstats shadow-md p-3">
                                <div class="card-header-custom">
                                    <i class="fas fa-wallet icon"></i>
                                </div>
                                <div class="card-body-custom mt-2">
                                    <div class="card-stat"><strong>&#8358;<?php echo number_format($uap['sum'],2)?></strong></div>
                                    <p class="mt-2 mb-0">Total Payment received</p>
                                </div>
                    
                            </div>
                    </div>

                    <!-- <div class="col-md-3 ">
                            <div class=" card cardstats shadow-md p-3">
                                <div class="card-header-custom">
                                    <i class="fas fa-trash-alt icon"></i>
                                </div>
                                <div class="card-body-custom mt-2">
                                    <div class="card-stat"><strong>12</strong></div>
                                    <p class="mt-2 mb-0">Your Waste Reports</p>
                                </div>
                    
                            </div>
                    </div> -->
                </div>


                <div class="row px-3 mt-3">
                    <div class="col-md-12">
                        <p class="reportsection">My Report History</p>
                    </div>


                    <!-- <div class="row">
                        <div class="col-md-12 mb-2" id="history">
                            
                        </div>
                    </div> -->


                    <?php 

                        if($wc){?>

                        <?php
                    foreach($wc as $val){ ?>
                    <div class="col-md-4 mb-2">
                        <div class="card shadow-sm">
                                <div class="reportcard-header">
                                    <p><?php echo $val['report_ref'] ?></p>
                                </div>

                                <div class="reportcard-body mb-0">
                                <span><strong>Waste Type:</strong><?php echo $val['waste_type'] ?></span>
                                <br>
                                <span><strong>Waste Amount:</strong><?php echo $val['waste_amount']."kg" ?></span>
                                <br>
                                <span><strong>Report Date:</strong> <?php echo date("M-d-Y",strtotime($val['report_date'])) ?></span>
                                <p><strong>Status:</strong> <?php if($val['reports_status']=='pending'){?>

                                    <span class="badge bg-warning text-dark"><?php echo $val['reports_status'] ?></span>
                               <?php } 

                                    else{?>
                                        <span class="badge bg-success text-white"><?php echo $val['reports_status'] ?></span>
                                  <?php }
                               
                               ?> 
                                </p>
                                </div>


                        </div>

                    
                    </div>
                    <?php }?> <?php }

                    else{?>
                          <div class='alert alert-info alert-dismissible fade show mt-3' role='alert'>
                                        <strong>No recent Activity</strong> 
                                        <p>You have no reports</p>
                            </div>
                    <?php
                    }

                    ?>
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

                $('#state').change(function(){
                        var state_id = $(this).val();
                        $('#lga').load("process/state_action.php?id="+state_id);
                })


                $('#example').click(function(){
                    $('#message').html('')
                })
                

                $('#reportwasteform').submit(function(event){

                    event.preventDefault();
                    
                    // var selectwaste = $('#selectwaste').val();
                    // var amt = $('#wasteamt').val();
                    // var state = $('#state').val();
                    // var lga = $('#lga').val();
                    // var address = $('#address').val();
                    // var wasteimg = $('#wasteimg').val();
                    // var xyz = {selectwaste:selectwaste,amt:amt,state:state,lga:lga,address:address,wasteimg:wasteimg}

                   var formData = new FormData(this);

                    $.ajax({
                        type:"post",
                        url:"process/reportaction.php",
                        dataType:'text',
                        data:formData,
                        processData: false,
                        contentType: false,
                        success:function(response){
                                // alert(response);
                            var res= JSON.parse(response);
                            // // //  alert(res);
                            $('#message').html(res.feedback);
                            $('#selectwaste').val('');
                            $('#wasteamt').val('');
                            $('#state').val('')
                            $('#lga').val('')
                            $('#address').val('')

                            // if(res.success==true){
                            //     $('#history').append(
                            //         <div class="card shadow-sm">
                            //         <div class="reportcard-header">
                            //             <p>res.report_ref</p>
                            //         </div>

                            //         <div class="reportcard-body mb-0">
                            //             <span><strong>Waste Type:</strong>${res.wastename}</span>
                            //             <br>
                            //             <span><strong>Waste Amount:</strong>${res.wasteamount}kg</span>
                            //             <br>
                            //             <span><strong>Report Date:</strong> ${res.reportdate}</span>
                            //             <p><strong>Status:</strong> <span class="badge bg-warning text-dark">${res.status}</span></p>
                            //         </div>
                            // </div>
                            //     );}
                            
                        },
                        error:function(err){
                            alert(err)
                        },
                        beforeSend:function(){
                            //show loading sign.
                            
                        },
                        complete:function(){
                            
                        }
                    })

                })
                
                $('.btn-close').click(function(){
                    $('#exampleModalCenter').hide();
                    location.reload();

                })


         });
      </script>

<script src="bootstrap/js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <script src="script.js"></script>
</body>

</html>