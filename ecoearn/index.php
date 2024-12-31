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


    <title>Eco-Earn</title>
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
                <a class="nav-link px-md-4 " aria-current="page" href="index.php">Home</a>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link  px-md-4" href="#">About Us</a>
              </li> -->
              <li class="nav-item">
                <a class="nav-link  px-md-4" href="#contactus">Contact us</a>
              </li>
            </ul>
         
            <div class="d-flex ms-md-auto mt-2 mt-md-0 gap-2">
              <a href="register.php"><button id="nav-btn" class="btn btn-warning text-dark me-2 px-4 py-2">Get Started</button></a>
              <a href="login2.php"><button class="btn btn-outline-warning text-dark px-4 py-2">Login</button></a>
            </div>
          </div>
        </div>
      </nav>
      

      <div class=" insert nav-body-store" >
          <div class="nav-body-store">
                <div class="container p-4">
                    <div class="row text-dark gap-2   offset-0 ">
                        <div class="col-md-7 mt-5">

                            <h1  id="hero-header" class="mb-4 hero-header" style="color:white;">Join the Recycling Revolution Today!</h1>
                            <hr>
                            <p class="mb-4 hero-text" style="color:#FFF;">Welcome to EcoEarn, where your waste becomes a resource for positive change. By connecting with local waste collectors, you can recycle household materials and earn points for every item you dispose of. These points can later be converted into cash rewards once the materials are collected. Each recyclable item you contribute helps reduce waste, conserve resources, and make a meaningful environmental impact. Together, let’s reduce waste, promote sustainability, and build a cleaner, greener future for all.
                            </p>

                            <a href="login2.php"><button class="btn btn-warning px-4 py-2  mb-3 ">Sign In</button></a>
                            <a href="register.php"><button class="btn  btn-outline-warning  px-4 py-2  mb-3 ">Register</button></a>
                            <!-- <button class="btn nav-btn3 px-5 py-2 d-inline mb-3">Shop Eco-Friendly</button> -->
                        </div>
                        <div class="col-md-4 mt-5 offset-0">
                            <img src=" images\waste-removebg-preview.png" alt="waste" class="img-fluid" >
                        </div>
                    </div>
                   
                </div>
          </div>
      </div>

      <div class="works p-0">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 workhead ">
                    <p class="section-title my-2">How It Works</p>
                </div>
            </div>
            <div class="row p-5 gap-0" >
                <div class="col-12 mt-0 text-start">
                    <p class="main-title">Transform waste into rewards with ease.</p>
                </div>
            </div>
            
            <div class="row d-md-flex justify-content-center gap-2 p-5  ms-md-5 ">
                <div class=" col-md-4 col-12 mb-3 mb-md-0  step">
                    <img src="images/work1.png" alt="work1" width="150" class="mb-3" >
                    <h5 class="mb-3">Sign-Up,Gather and Report</h5>
                    <p>Simply sign up, start gathering your recyclable materials, and report them through the EcoEarn platform.For every recyclable item you report, you’ll earn points that can later be converted into cash rewards, helping both you and the environment.</p>
                </div>
                <div class=" col-md-4  col-12  mb-3 mb-md-0 step">
                  <img src="images/work2.png" alt="work1" width="150" class="mb-3">
                    <h5 class="mb-3">Report Waste Details </h5>
                    <p>Easily log your waste for collection.Earn points by recycling, joining environmental programs, or engaging in eco-friendly activities.</p>
                </div>
                <div class=" col-md-4  col-12  mb-3 mb-md-0 step">
                  <img src="images/work3.png" alt="work1" width="150" class="mb-3">
                    <h5 class="mb-3">Earn Points and Equivalent monetary reward </h5>
                    <p>Our collectors ensure your waste is handled properly after which you can redeem points for rewards based on your the waste type reported.</p>
                </div>
            </div>
        </div>
    </div>


  <div class="subsection">
      <div class="subsection-overlay">
        <div class="container-fluid">
      <div class="row p-5">
        <div class="col-md-9 text-white">
        
          <h2 class="subscribe">Stay Updated with Our News Letter</h2>
          <p style="font-family:'Open Sans',san-serif";>Subscribe for the latest updates and exclusive promotions on eco-friendly products and recycling tips.</p>
           <div class="d-flex align-items-center gap-1">
          <input type="email" placeholder="Enter Your Email...." class="form-control noround floating-left" >
          <button  style="min-width:15%;" class="btn btn-dark noround btn-md ">Sign-Up</button>
           </div>
           <p class="mt-3 mini" >By Clicking sign-up,you agree to our Terms and conditions</p>
        </div>
      </div>
    </div>

    </div>
    </div>

    <div class="partners image">
      <div class="container-fluid">
        <div class="row p-5">
          <div class="col-12">
              <p class="partners text-center">Our  Partners</p>
          </div>
        </div>
          
        <div class="row align-items-center p-5">
           
              <div class="col-md-3"><img src="images/badge.jpg" alt="logo" class="img-fluid"></div>
              <div class="col-md-3"><img src="images/cocreation.png" alt="cocreation" class="img-fluid"></div>
              <div class="col-md-3"><img src="images/biofics.png" alt="biofics" class="img-fluid"></div>
              <div class="col-md-3"><img src="images/lawma.jpg" alt="lawma" class="img-fluid"></div>
          
        </div>
        <hr class=" text-dark" height="">
      </div>
    </div>


    <div class="container-fluid">
      <div class="row mt-0 pb-5 px-5">
        <p class="partners text-center mt-4" id='contactus'>Contact us</p>
        <div class="col-md-5 mt-4">
          <img src="images/contact.png" alt="" class="img-fluid">

        </div>
        <div class="col-md-7 contactus mt-4">

              <form action="" method="post">

                <div class="row-12 d-flex gap-1">
                    <div class="col-3">
                      <input type="text" placeholder=" Name"  name="cname" class="form-control noround" >
                    </div >
                    <div class="col-9">
                      <input type="email" placeholder=" Email"  name="cmail" class="form-control noround" >
                  </div>
                </div>  
                <div class="row-12 d-flex gap-1">
                  <div class="col-3">
                    <input type="phone" placeholder=" Phone"  name="cphone" class="form-control noround" >
                  </div >
                  <div class="col-9">
                    <input type="text" placeholder=" Subject"  name="csubject" class="form-control noround" >
                </div>
              </div>  

              <div class="row ">
                <div class="col-12">
                  <textarea rows="10" name="message" id="" placeholder="Write Your Message" class="form-control noround"></textarea>
                </div >
                
            </div>  

            <button class="btn btn-success offset-4 noround ">Send Message</button>
              </form>
        </div>
      </div>

    </div>

    <div class="footer">
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

          <div class="col-12 p-0 ">
            <hr>
           <b> <p class="mt-4 mb-0 text-center" style="font-family:'Abril FatFace',sans-serif;font-size:14px;">&copy; 2024 Eco Earn. All Rights Reserved.</p></b>
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