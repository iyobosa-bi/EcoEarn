<?php



session_start();

if(!isset($_SESSION['admin_id'])){
    header("location:adminlogin.php");
    exit();
}



require_once "classes/Admin.php";
// require_once "fetchbank.php";

$ad=new Admin;
$reports=$ad->reports_made_by_users();
$countuser=$ad->userscount();
$countcoll=$ad->collcount();
$userdeets=$ad->getdetailsuser();
$payrecs = $ad->getsuccessfulpaymentrecords();

// $rc=$ad->getreportscountperuser($id); //report count

//  echo"<pre>";
//  print_r($payrecs);
//  echo"</pre>";



if(isset($_POST['btnrpay'])){
    $_SESSION['repid'] = $_POST['report_id'];
    $_SESSION['accno'] = $_POST['account_number'];
    $_SESSION['bankcode'] = $_POST['bank_code'];
    $_SESSION['ramount'] = 0.94*$_POST['amount'];
    $_SESSION['ruser'] = $_POST['user'];
    $_SESSION['stats'] = $_POST['stats'];
    $_SESSION['userpaid'] = $_POST['userpaid'];

}

else{
    header("location:paymentview.php");
}
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

.paytable {
    font-size: 13px;
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
                    <div class="col-12 mt-5 mx-4" style="font-family:'Abril Fatface',sanserif">Payments</div>
                    <p></p>

                    <button type="button" class="btn btn-dark m-4" style="font-size:12px">Total Successful Payments <span class="badge bg-primary rounded-pill" style="font-size:14px; margin-left:5px;">
                        <?php echo count($payrecs); ?>
                    </span>
                     </button>

                     <?php 
                    //  echo "<pre>"; 
                    //  print_r($_POST);
                    //  echo "</pre>"; 


                   
                    
                     ?>

                    <p class="loader  m-4"></p>
                    <p id="payresp" class="m-4"></p>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card m-4 shadow-sm " style="width:110%;">
                                            <div class="card-body" >

                                            <p style="font-size:20px;"><b>Payment Details</b></p>
                                            <p>Name:<?php echo $_POST['user']?></p>
                                            <p>Account_Number:<?php echo $_POST['account_number']?></p>
                                            <p>Bank_Name:<?php echo $_POST['bankname']?></p>
                                            <p>Received Amount:<b><?php echo number_format($_POST['amount'],2)?></b></p>
                                            <p>Pay Amount:<b><?php echo  number_format(0.94*$_POST['amount'],2) ?></b> <span style="font-size:14px;">(6% as admin fee)</span></p>
                                            <p>Tran Ref Number:<?php $_SESSION['prefno']=time().rand(); echo $_SESSION['prefno']?></p>

                                            <form action="process/payreporter.php" method="post" id="payhidden">

                                                <?php
                                                if($_SESSION['userpaid'] == 'yes'){?>
                                                <button class="btn btn-primary btn-sm" disabled>Confirm Payment</button>
                                                <?php }
                                                else{?>
                                                <button class="btn btn-primary btn-sm">Confirm Payment</button>
                                                <?php
                                                }?>
                                                <a href="paymentview.php"><button class="btn btn-dark btn-sm" type="button">Back</button></a>
                                    
                                            </form>
                                            </div>
                                </div>
                        </div>
                  
                    </div>
                   
                               




                

            </div>
        </div>

</div>
    


<!-- <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
</div> -->

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

                // $('#reportwasteform').submit(function(event){

                //     event.preventDefault();
                    
                //     // var selectwaste = $('#selectwaste').val();
                //     // var amt = $('#wasteamt').val();
                //     // var state = $('#state').val();
                //     // var lga = $('#lga').val();
                //     // var address = $('#address').val();
                //     // var wasteimg = $('#wasteimg').val();
                //     // var xyz = {selectwaste:selectwaste,amt:amt,state:state,lga:lga,address:address,wasteimg:wasteimg}

                //    var formData = new FormData(this);

                //     $.ajax({
                //         type:"post",
                //         url:"process/reportaction.php",
                //         dataType:'text',
                //         data:formData,
                //         processData: false,
                //         contentType: false,
                //         success:function(response){
                //             $('#message').html(response)
                //             $('#selectwaste').val('');
                //             // alert(response)
                            
                //             // console.log(response)
                //         },
                //         error:function(err){
                //             alert(err)
                //         },
                //         beforeSend:function(){
                //             //show loading sign.
                            
                //         },
                //         complete:function(){
                            
                //         }
                //     })

                // })

                $('#payhidden').submit(function(event){
                
                event.preventDefault();

                var formData = new FormData(this);
                console.log(formData); 

                $.ajax({
                    type: "POST",
                    url: "process/payreporter.php",
                    data: formData,
                    dataType: 'text',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        setTimeout(function() {
                            $('#payresp').html(response);
                            $('.loader').hide();
                        }, 5000);
                    },
                    error: function(err) {
                        $('#payresp').html(err);
                    },
                    beforeSend: function() {
                        $('.loader').show();
                        $('.loader').html('<div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div>');
                    },
                    complete: function() {}
                });
        });

            // $('body').on('submit', '.payhidden', function(event) {
                
            //         event.preventDefault();

            //         var formData = new FormData(this);
            //         console.log(formData); 

            //         $.ajax({
            //             type: "POST",
            //             url: "process/payreporter.php",
            //             data: formData,
            //             dataType: 'text',
            //             processData: false,
            //             contentType: false,
            //             success: function(response) {
            //                 setTimeout(function() {
            //                     $('#payresp').html(response);
            //                     $('.loader').hide();
            //                 }, 5000);
            //             },
            //             error: function(err) {
            //                 $('#payresp').html(err);
            //             },
            //             beforeSend: function() {
            //                 $('.loader').show();
            //                 $('.loader').html('<div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div>');
            //             },
            //             complete: function() {}
            //         });
            // });






            $(document).on('click', '.btn-close', function(){
                location.reload();
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