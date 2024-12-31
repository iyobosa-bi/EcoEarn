<?php


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"  type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="adminstyle.css">
</head>
<body>
    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="lni lni-grid-alt"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="#"></a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="admindashboard.php" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        <span>Home</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="adminwastecat.php" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        <span>Update Waste Category</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-agenda"></i>
                        <span>View All Waste Reports</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-agenda"></i>
                        <span>Verify Payments</span>
                    </a>
                </li>
                
               
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-popup"></i>
                        <span>Leader-Board</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-cog"></i>
                        <span>Setting</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                <a href="#" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>
        <div class="main" style="background-color: #ededed;" >
            <nav class="navbar navbar-expand px-4 py-3">
                <form action="#" class="d-none d-sm-inline-block">
                </form>
                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                                <img src="account.png" class="avatar img-fluid" alt="">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end rounded">

                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="content px-3 py-4" style="background-color: #ededed;">
                <div class="container-fluid">
                    <div class=" row mb-3">
                    
                        <div class="col-md-8">
                        <h3 class="fw-bold fs-4 mb-3">Admin Dashboard</h3>
                        <span>Login Time and Date</span>
                        </div>

                        <div class="col-md-4 me-auto">
                        <button class="btn btn-dark noround">View Reports</button>
                            <button type="button" class="btn btn-primary noround" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                                Add Waste Category
                            </button>
                        </div>
                    </div>
                        <div class="row mt-3">
                            <div class="col-md-3">
                                    <div class="recycle-box">
                                      <p class="text-center">Total Users</p>
                                      <p  style="font-weight:600;font-size:40px;">10</p>
                                    </div>
                            </div>
                            <div class="col-md-3">
                                <div class="recycle-box">
                                        <p class="text-center">Total Collectors</p>
                                        <p  style="font-weight:600;font-size:40px;">20</p>
                            </div>
                               
                            </div>

                            <div class="col-md-3">
                                <div class="recycle-box">
                                    <p class="text-center">Total Waste Reports</p>
                                    <p  style="font-weight:600;font-size:40px;">20</p>
                                  
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="recycle-box">
                                    <p class="text-center">Total Approved Pay</p>
                                    <p  style="font-weight:600;font-size:40px;">20</p>
                                  
                                </div>
                            </div>
                
                        </div>

                        <div class="row">
                            <div class="col-12">

                                
                            </div>
                        </div>

                        
                        <!-- <div class="row">
                            <div class="col-12 col-md-4 ">
                                <div class="card border-0">
                                    <div class="card-body py-4">
                                        <h5 class="mb-2 fw-bold">
                                            Memebers Progress
                                        </h5>
                                        <p class="mb-2 fw-bold">
                                            $72,540
                                        </p>
                                        <div class="mb-0">
                                            <span class="badge text-success me-2">
                                                +9.0%
                                            </span>
                                            <span class=" fw-bold">
                                                Since Last Month
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 ">
                                <div class="card  border-0">
                                    <div class="card-body py-4">
                                        <h5 class="mb-2 fw-bold">
                                            Memebers Progress
                                        </h5>
                                        <p class="mb-2 fw-bold">
                                            $72,540
                                        </p>
                                        <div class="mb-0">
                                            <span class="badge text-success me-2">
                                                +9.0%
                                            </span>
                                            <span class="fw-bold">
                                                Since Last Month
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 ">
                                <div class="card border-0">
                                    <div class="card-body py-4">
                                        <h5 class="mb-2 fw-bold">
                                            Memebers Progress
                                        </h5>
                                        <p class="mb-2 fw-bold">
                                            $72,540
                                        </p>
                                        <div class="mb-0">
                                            <span class="badge text-success me-2">
                                                +9.0%
                                            </span>
                                            <span class="fw-bold">
                                                Since Last Month
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                       
                       
                    </div>
                </div>
            </main>
            
        </div>
    </div>

    <!-- Modal -->
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
     <!-- Only include the  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="jquery-3.7.1.min.js"></script>
    <script>

        // $(document).ready(function(){

        //     $('#wastecatform').submit(function(e){
        //             e.preventDefault();
        //             var data = $(this).serialize();

        //     $.ajax({
        //             type:'post',
        //             url: "process/wastecataction.php",
        //             data:data,
        //             success:function(response){
        //                 alert(response);
        //                 // if(response === "success"){

        //                 //     $('#wastecatform').prepend("<div class='alert alert-success text-center'>Category Added Successfully</div>");
        //                 // }
        //                 // else{
        //                 //     $('#wastecatform').prepend("<div class='alert alert-danger text-center'>Error </div>");
        //                 //     $('#wastecat').val("");
        //                 //      $('#wastepoint').val("");
        //                 //      $('#wasteprice').val("");
        //                 // }
        //             },
        //             error:function(){
        //                 $('#wastecatform').prepend("<div class='alert alert-danger text-center'>Error in Operation</div>");
        //             }
        //     })

        //     })



        // })


    </script>
    
    <script src="script.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js" type="text/javascript"></script>
</body>

</html>