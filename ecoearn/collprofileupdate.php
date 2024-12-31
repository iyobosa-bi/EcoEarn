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

$deets=$st->collectorall($_SESSION['agent_id']);

//   echo "<pre>";
// print_r($wastecats);
//  echo "</pre>";
//  exit();
 
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

        .updateform label{
            font-weight:600;
        }

        .updateform input{
            background:transparent;
        }

        .updateform input:focus{
            background:transparent;
            box-shadow:none;
        }


        .btnupdate{
            background-color:#ffa321;
            font-weight:600;
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
                <div class="row px-3 mt-2">
                    <div class="col-md-12 welcome d-flex justify-content-between align-items-center">
                      
                        <div>
                            <h2 class= "mt-1" style="font-size:18px;font-family:'Abril Fatface';">Update Profile</h2>
                            <hr style="width:20%">
                        </div>

                    </div>
                    <?php

                        if(isset($_SESSION['feedback'])){
                            echo "<div class='alert alert-success'>".$_SESSION['feedback']."</div>";
                            unset($_SESSION['feedback']);
                        }

                        if(isset($_SESSION['nfeedback'])){
                            echo "<div class='alert alert-danger'>".$_SESSION['nfeedback']."</div>";
                            unset($_SESSION['nfeedback']);
                        }
                            ?>
                        
                        <form action="process/collprocessupdate.php" method = "post" enctype = "multipart/form-data" class="mt-3 updateform">

                            <div class="mb-3 updateform">
                                    <label for="">Name /Business Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control border-dark" name="fullname" id="bizname" value="<?php echo $deets['first_name'];?>">
                            </div>

                            <div class="mb-3">
                                    <label for="">Email<span class="text-danger">*</span></label>
                                    <input type="email" class="form-control border-dark " name="collemail" id="bizname" value="<?php echo $deets['email_address'];?>">
                            </div>

                            <div class="mb-3">
                                    <label for="">Phone Contact<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control border-dark" name="collphone" id="bizname" value="<?php echo $deets['phone'];?>">
                            </div>

                            <div class="mb-3">
                                    <label for="">Update Password<span class="text-danger">*</span></label>
                                    <input type="password" class="form-control border-dark " name="collpass" id="bizname" value="<?php echo $deets['password'];?>">
                            </div>


                            <button name = "btnupdate" class = "btn col-12 btnupdate">Update Profile</button>


                            </form>

                    

                   
                    <div>


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
  
         });
      </script>

<script src="bootstrap/js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <script src="script.js"></script>
</body>

</html>