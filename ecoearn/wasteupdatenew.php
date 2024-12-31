<?php


session_start();

require_once "classes/Admin.php";
$ad = new Admin;

$catid = $_GET['catid'];
$_SESSION['catid']=$catid;


$res = $ad -> get_category_admin_id($catid);




$ad=new Admin;
$reports=$ad->reports_made_by_users();
$recs = $ad-> get_category_admin();


// echo"<pre>";
// print_r($reports);
// echo"</pre>";


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
</head>

<style>

    body{
        margin:0px;
        padding:0px;
    }

    .reportstable{
        display:none;
    }
</style>
<body>
 
<div class="container-fluid ms-0 ps-0 mt-0">



        <div class="row">
                <div class="col-md-3 bg-dark"  >

                    <div class="d-flex flex-column  p-3" style="min-height: 100vh;" >
                        
                            

                            <div class="p-3 mt-5">
                                
                                <div class="sidebar-logo">
                                    <a href="#">Welcome Admin</a>
                                </div>
                            </div>
                        
                           <?php include_once "partials/adminmenu.php"?>
            
                        
                    </div>
            
   
                </div>

            <div class="col-md-9" style="background-color:#fff;">


                <div class="row px-3 mt-5 d-flex justify-content-between align-items-center">
                        <div class="col" style="font-family:'Abril Fatface',sans-serif">Eco-Earn Statistics</div>

                        <div class="col text-end">
                        <!-- <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                                    Add category
                                </button>
                            <!-- <button class="btn btn-primary view">View</button> -->
                        </div> 
                </div>

                    <div class="row px-3 mt-3">
                            <div class="col-md-3 ">
                                    <div class=" card acardstats shadow-sm p-3 bg-dark">
                                        <div class="card-header-custom">
                                        <i class="fa-solid fa-user text-white"></i>
                                        </div>
                                        <div class="card-body-custom mt-2">
                                            <div class="card-stat text-white"><strong>300</strong></div>
                                            <p class="mt-2 mb-0 text-white">Total Platform Users</p>
                                        </div>
                            
                                    </div>
                            </div>

                            <div class="col-md-3 ">
                                    <div class=" card acardstats shadow-sm p-3 bg-dark">
                                        <div class="card-header-custom">
                                        <i class="fa-solid fa-user text-white"></i>
                                        </div>
                                        <div class="card-body-custom mt-2">
                                            <div class="card-stat text-white"><strong>300</strong></div>
                                            <p class="mt-2 mb-0 text-white">Total Registered Collectors</p>
                                        </div>
                            
                                    </div>
                            </div>

                            <div class="col-md-3 ">
                                    <div class=" card acardstats shadow-sm p-3 bg-dark">
                                        <div class="card-header-custom">
                                        <i class="fa-solid fa-user text-white"></i>
                                        </div>
                                        <div class="card-body-custom mt-2">
                                            <div class="card-stat text-white"><strong>300</strong></div>
                                            <p class="mt-2 mb-0 text-white">Total Registered Collectors</p>
                                        </div>
                            
                                    </div>
                            </div>

                            <div class="col-md-3 ">
                                    <div class=" card acardstats shadow-sm p-3 bg-dark">
                                        <div class="card-header-custom">
                                        <i class="fa-solid fa-user text-white"></i>
                                        </div>
                                        <div class="card-body-custom mt-2">
                                            <div class="card-stat text-white"><strong>300</strong></div>
                                            <p class="mt-2 mb-0 text-white">Total Registered Collectors</p>
                                        </div>
                            
                                    </div>
                            </div>

                    
                    </div>

               
                    <div class="row px-3 mt-2">
                        <div class="col-12">
                                <p class="mt-3"><b>Update Waste Category</b></p>
                                <hr>

                        <div class="row mt-2">
                            <div class="col-10">
                                <?php
                                    if(isset($_SESSION['feedbackl'])){

                                        // echo "<script>alert".($_SESSION['feedbackl'])."</script>";
                                        echo "<div class ='alert alert-success  text-start'>".$_SESSION['feedbackl']."</div>";
                                        unset($_SESSION['feedbackl']);
                                        }
                                    // if(!isset($catid)){
                                    //     header("location:adminwastecategory.php");
                                    // }
                                        if(isset($_SESSION['errmsg'])){
                                            echo "<div class ='alert alert-danger  text-start'>".$_SESSION['errmsg']."</div>";
                                            unset($_SESSION['errmsg']);
                                            }
                    
                                ?>
                            <form action="process/updatewastecataction.php?catid=<?php echo $catid?>" method="post" id="wastecatform">
                                <input type="text" name="wastecat" id="wastecat" class="form-control noround border-dark" placeholder="Enter Waste category" value =  "<?php if(count($res)>0){echo $res['cat_name'];}else{ $res['cat_name']=""; echo $res['cat_name'];}?>" >
                                <input type="text" name="wastepoint" id="wastepoint" class="form-control noround border-dark" placeholder="Enter Points Per Kg" value ="<?php if(isset($_GET['catid'])){echo $res['points_per_kg'];}?>" >
                                <input type="text" name="wasteprice" id="wasteprice" class="form-control noround border-dark" placeholder="Enter Price Per Point" value ="<?php if(isset($_GET['catid'])){echo $res['price_per_point'];}?>">
                                <button type="submit"  class="btn btn-dark mt-2" name = "updatewastecat">Update Category</button>
                            </form>

                                
                            </div>
                        </div>   
                               




                        </div>

                    </div>
            </div>


            

















        

</div>
    


<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Waste Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php
                    if(isset($_SESSION['feedback'])){
                        echo "<div class ='alert alert-success  text-center'>".$_SESSION['feedback']."</div>";
                        unset($_SESSION['feedback']);
                        }
                        if(isset($_SESSION['nresponse'])){
                            echo "<div class ='alert alert-danger  text-center'>".$_SESSION['nresponse']."</div>";
                            unset($_SESSION['nresponse']);
                            }
                        ?>
                    <form action="process/wastecataction.php" method="post" id="wastecatform">

                        <input type="text" name="wastecat" id="wastecat" class="form-control noround border-dark" placeholder="Enter Waste category">
                        <input type="text" name="wastepoint" id="wastepoint" class="form-control noround border-dark" placeholder="Enter Points Per Kg">
                        <input type="text" name="wasteprice" id="wasteprice" class="form-control noround border-dark" placeholder="Enter Price Per Point">

                    <button type="submit"  class="btn btn-dark mt-2" name = "addwastecat">Submit Category</button>
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


                $('.view').click(function(){

                    $('.reportstable').toggle();

                    
                   

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
                            $('#message').html(response)
                            $('#selectwaste').val('');
                            // alert(response)
                            
                            // console.log(response)
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
                
         });
      </script>

<script src="bootstrap/js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <script src="script.js"></script>
</body>

</html>