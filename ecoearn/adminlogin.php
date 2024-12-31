<?php

session_start();
require_once "classes/Admin.php";


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"  type="text/css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Fraunces:ital,opsz,wght@0,9..144,100..900;1,9..144,100..900&family=Inter+Tight:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="animate.min.css">


    <title>Project</title>
    <style>

      .show{
          display: none;
      }
 
  </style>
</head>
<body>
    
    <nav class="navbar navbar-expand-lg nav-body pt-2 ">
        <div class="container px-4 px-md-0 mt-2">
          <a class="navbar-brand text-dark" href="#">
            <img src="images/logo2.png" alt="img" class="img-fluid" width="45">
            <span class="logoname" style="font-size:24px;">Eco Earn</span>
          </a>
         
          <button
            class="navbar-toggler navb"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
      
          <div class="collapse navbar-collapse navlinks" id="navbarNavDropdown">
            <ul class="navbar-nav ms-lg-5  ms-0">
              <li class="nav-item">
                <a class="nav-link px-md-4 " aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link  px-md-4" href="#">About Us</a>
              </li>
              <li class="nav-item">
                <a class="nav-link  px-md-4" href="#">Contact us</a>
              </li>
            </ul>
         
            <div class="d-flex ms-md-auto mt-2 mt-md-0 gap-2">
              <button id="nav-btn" class="btn nav-btn text-dark me-2 px-4 py-2">Get Started</button>
              <button class="btn nav-btn2 text-dark px-4 py-2">Login</button>
            </div>
          </div>
        </div>
      </nav>



      <div class="loginform" style="min-height:400px;">
        <div class="container">
            <div class="row p-5">
                <div class="col-12 mt-5">

                    <h5 class="text-center" style="text-transform:uppercase;">Admin Login</h5>
                    <p class="text-center"></p>
                    <div class="input-container">
                    <?php 
                    if(isset($_SESSION['nresponse'])){
                        echo "<div class ='alert alert-danger  text-center'>".$_SESSION['nresponse']."</div>";
                        unset($_SESSION['nresponse']);
                        }
                        if(isset($_SESSION['presponse'])){
                            echo "<div class= 'alert alert-success text-center'>".$_SESSION['presponse']."</div>";
                            unset($_SESSION['presponse']);
                          }
                        ?>
                        <form action="process/adminprocess.php"  method="post">
                            <input type="email" name="email" id="" placeholder="E-mail" class="form-control noround">
                            <input type="password" name="pass" id="" placeholder="Password" class="form-control noround">

                            <button type="submit" name="btn-adminlogin" class="btn btn-dark noround col-12">LOGIN</button>
                        </form>
                     </div>

                </div>
            </div>
        </div>
      </div>


      <div class="footer footerlogin">
        <div class="container-fluid">
          <div class="row p-5">
  
            <div class="col-md-5 footer2">
              <h4 class="mb-5">Connect,Recycle and Earn Rewards Today.</h4>
              <p class="mb-5">Join us in making recycling rewarding and eco-friendly products accessible for everyone.</p>
              <div class="mb-5">
                <button class=" btn footernav-btn px-4 py-2">Learn More</button>
                <button class="btn footernav-btn2 px-4 py-2">Sign Up</button>
              </div>
              <a class="navbar-brand text-dark align-items-center" href="#">
                <img src="images/logo2.png" alt="img" class="img-fluid" width="35">
                <span class="logoname" style="font-size:19px;"> Eco Earn</span>
              </a><br>
  
              <div class="icons d-flex gap-3 mt-4">
              <i class="fa-brands fa-facebook"></i>
              <i class="fa-brands fa-twitter"></i>
              <i class="fa-brands fa-reddit"></i>
              </div>
  
            </div>
            <div class="col-md-5 text-center offset-0">
             <a href="#" class="text-dark">About Us</a><br>
             <a href="#" class="text-dark">Register</a><br>
             <a href="#"class="text-dark">FAQs</a><br>
             <a href="#" class="text-dark">Learn More</a><br>
             <a href="#" class="text-dark">Privacy Policy</a><br>
             <a href="#" class="text-dark">Terms of Use</a><br>
            </div>
  
            <div class="col-md-2 text-center offset-0">
              <a href="#" class="text-dark">About Us</a><br>
              <a href="#" class="text-dark">Register</a><br>
              <a href="#"class="text-dark">FAQs</a><br>
              <a href="#" class="text-dark">Learn More</a><br>
              <a href="#" class="text-dark">Privacy Policy</a><br>
              <a href="#" class="text-dark">Terms of Use</a><br>
             </div>
  
            <div class="col-12 p-0 last ">
              <hr>
             <b> <p class="mt-4 mb-0 text-center">&copy; 2024 Eco Earn. All Rights Reserved.</p></b>
            </div>
  
          </div>
  
        
        </div>
      </div>
  

      <script src="jquery-3.7.1.min.js"></script>
      <script>
         $(document).ready(function(){

              
                $("#hero-header ,.hero-text").addClass("animate__animated animate__slideInRight");
              

         });
      </script>
      <script src="bootstrap/js/bootstrap.bundle.min.js" type="text/javascript"></script>
</body>
</html>