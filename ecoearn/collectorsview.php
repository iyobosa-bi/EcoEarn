<?php



session_start();

if(!isset($_SESSION['admin_id'])){
    header("location:adminlogin.php");
    exit();
}



require_once "classes/Admin.php";

$ad=new Admin;
$reports=$ad->reports_made_by_users();
$countuser=$ad->userscount();
$countcoll=$ad->collcount();
$userdeets=$ad->getdetailscoll();
// $rc=$ad->getreportscountperuser($id); //report count

//  echo"<pre>";
//  print_r($userdeets);
//  echo"</pre>";

// exit();
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

.userstable {
    font-size: 15px;
}

    /* .reportstable{
        display:none;
    } */
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
                        
                             <?php include_once "partials/adminmenu.php";?> 
            
                    </div>
            
   
                </div>

            <div class="col-md-9" style="background-color:#fff;">

                    <!-- <p  class="m-5"  style="font-family:'Abril Fatface',sanserif">Plaform Users</p> -->
                    <div class="col-12 mt-5 mx-4" style="font-family:'Abril Fatface',sanserif">Signed Up Collectors</div>
                    <p></p>

                    <button type="button" class="btn btn-dark m-4" style="font-size:12px">Total Collectors <span class="badge bg-primary rounded-pill" style="font-size:14px; margin-left:5px;">
                        <?php echo count($userdeets);?>
                    </span>
                </button>

                    <div class="userstable mx-4 mt-4">

                    <?php 
                        if(count($userdeets)>0) {?>
                            <table class="table table-hover table-striped table-sm table-bordered ">
                                <thead class="table-dark" style="border-radius:5px 5px">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col" >Phone Number</th>
                                        <th scope="col">Reg Date</th>
                                        <!-- <th scope="col">Location</th> -->
                                        <!-- <th scope="col">R.Count</th> -->
                                        <th scope="col">Status</th>
                                        <!-- <th scope="col">Complaints Count</th> -->
                                        <!-- <th scope="col">Total Payment</th> -->
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php
                                        $sn=1;
                                foreach($userdeets as $val){?>
                                    <tr>
                                        <td scope="col"><?php echo $val['first_name']?></td>
                                        <td scope="col"><?php echo $val['email_address']?></td>
                                        <td scope="col" class="text-center"><?php echo $val['phone']?></td>
                                        <td scope="col" class="text-center"><?php echo date("M/d/Y",strtotime($val['created_date']))?></td>
                                        <!-- <td scope="col"><?php echo $ad->get_state($val['state_id'])['state_name']?></td> -->
                                        <!-- <td scope="col" class="text-center"><?php echo $ad->getreportscountperuser($val['user_id'])['count'];?></td> -->
                                        <td scope="col"><?php $astatus=$val['active_status']; if($astatus=='active'){echo "<span class='badge bg-success p-1'>".$astatus."</span>";}else{echo "<span class='badge bg-danger p-1'>".$astatus."</span>";}  ?></td>
                                        <td> 
                                            <a href="process/collactivestatusreport.php?agentid=<?php echo $val['agent_id']?>&astatus=restricted"><button class="btn btn-sm btn-secondary rounded-pill px-2" id="btnapprove" value="Approve"><i class="fa-solid fa-user-lock text-info"></i></i></button></a>
                                            <!-- <a href="" class="btn btn-sm btn-danger rounded-pill px-2"><i class="fa-solid fa-trash"></i></a> -->
                                        </td>
                                    </tr>

                                    <?php }?>
                                </tbody>
                            </table><?php }

                            else{?>
                                    <div class='alert alert-warning alert-dismissible fade show mt-3' role='alert'>
                                        <strong>No Registered Users</strong> 
                                        <p>There are no users on the platform</p>
                                    </div>
                           <?php }?>









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
                    <p id="resp"></p>
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

                $('#add').click(function(){
                    $('#resp').html('')
                })

                $('#wastecatform').submit(function(event){
                    event.preventDefault();
                    
                   
                    var formData = new FormData(this);

             $.ajax({
                    type:"post",
                    url: "process/wastecataction.php",
                    dataType:'text',
                     data:formData,
                     processData: false,
                    contentType: false,
                    success:function(response){
                        $('#resp').html(response)
                        // if(response == "success"){
                        //     $('#wastecatform').prepend("<div class='alert alert-success text-center'>Category Added Successfully</div>");
                        //  }
                        //   else{
                        //       $('#wastecatform').prepend("<div class='alert alert-danger text-center'>Error </div>");
                        //       $('#wastecat').val("");
                        //       $('#wastepoint').val("");
                        //      $('#wasteprice').val("");
                        // }
                    },
                    error:function(){
                       $('#wastecatform').prepend("<div class='alert alert-danger text-center'>Error in Operation</div>");
                 }
            })

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


                // $('#btnapprove').click(function(){
                //     $('#btnapprove').html('Approved');

                // })


//                 $(document).ready(function() {
//     $("#btnapprove").click(function(e) {
//         e.preventDefault();

//         var button = $(this);
//         var href = button.parent().attr("href"); 
       
//         $("#btnapprove").html('Approved')
//         // $("#btnapprove").val('Approved')

//         $.ajax({
//             url: href,
//             type: "get",
//             success: function(response) {
//                 if (response.trim() === "success") {
//                     // alert(response);
//                     // window.location.href = "../pages/admindashboard2.php";
                    
//                         //   .removeClass("btn-success")
//                         //   .addClass("btn-secondary")
//                         //   .prop("disabled", true);
//                 } else {
//                     alert("Approval failed. Please try again.");
//                 }
//             },
//             error: function() {
//                 alert("An error occurred. Please try again.");
//             }
//         });
//     });
// });

                
         });
      </script>

<script src="bootstrap/js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <script src="script.js"></script>
</body>

</html>