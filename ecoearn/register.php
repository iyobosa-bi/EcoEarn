<?php


session_start();
    require_once "classes/User.php";
    $st = new User;
    $states = $st->fetchAllStates();

    // echo "<pre>";
    // print_r($states);
    // echo "</pre>";

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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Fraunces:ital,opsz,wght@0,9..144,100..900;1,9..144,100..900&family=Inter+Tight:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Oswald:wght@200..700&display=swap" rel="stylesheet">
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
<body class="body">
    
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
              </li>
              <li class="nav-item">
                <a class="nav-link  px-md-4" href="#">Contact us</a>
              </li> -->
            </ul>
         
            <div class="d-flex ms-md-auto mt-2 mt-md-0 gap-2">
              <a href="register.php"><button id="nav-btn" class="btn nav-btn text-dark me-2 px-4 py-2">Get Started</button></a>
              <a href="login2.php"><button class="btn nav-btn2 text-dark px-4 py-2">Login</button></a>
            </div>
          </div>
        </div>
      </nav>


      <div class="registerform" style="min-height:500px;">
        <div class="container p-5">
            <div class="register-input-container">
            <div class="row ">

            <div class="col-md-12 shiftradio">
                <div class="d-flex gap-2 ">
                    <div class="form-check">
                        <input type="radio" name="user" class="form-check-input user" checked><label for="user">User</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="user" class="form-check-input collector"><label for="collector">Collector</label>
                    </div>
                </div>
            </div>
                <div class="col-md-12 mt-3">
                    <p class="bg-dark text-white p-3 ">Sign Up as a User or a Collector</p>
                </div>

                <div class="col-md-12 userform" style="border: 0px solid black;">

                <?php
                      if(isset($_SESSION['regerrormsg'])){
                        echo "<div class= 'alert alert-danger'>".$_SESSION['regerrormsg']."</div>";
                        unset($_SESSION['regerrormsg']);
                      }

                      if(isset($_SESSION['regfeedback'])){
                        echo "<div class= 'alert alert-success'>".$_SESSION['regfeedback']."</div>";
                        unset($_SESSION['regfeedback']);
                      }
                    ?>
                    <form action="process/registeraction.php" method="post" id="userform">

                        <div class="col-md-12 gap-1 d-flex" >
                            <div class=" col-md-6 mb-2">
                                <label for="firstname">First Name</label>
                                <input type="text" placeholder="Enter First Name" class="form-control noroundregister"  name ="firstname">
                            </div>
                            <div class=" col-md-6 mb-2">
                                <label for="">Last Name</label>
                                <input type="text" placeholder="Enter Last Name" class="form-control noroundregister" name="lastname">
                            </div>
                        </div>

                        <div class="col-md-12 gap-1 d-flex" >
                            <div class=" col-md-6 mb-2">
                                <label >Phone Number</label>
                                <input type="text" placeholder="Enter Phone Number" class="form-control noroundregister" name="phone">
                            </div>

                            <div class=" col-md-6 mb-2" style="position: relative;">
                                <label for="">E-mail<span id="loader2" style="font-size:14px;"></span></label>
                                <input type="email" id="email" placeholder="Enter Email Address" class="form-control noroundregister" name="email">
                                <span id="loader" style="font-size:14px;position: absolute; top: 85%; left: 0%; "></span>
                                
                            </div>
                        </div>
                        <div class="col-md-12 gap-1 d-flex">
                            <div class=" col-md-6 mb-2">
                                <label >Password</label>
                                <input type="password" placeholder="Enter Password" class="form-control noroundregister" name="userpass">
                            </div>

                            <div class=" col-md-6 mb-2">
                                <label for="">Confirm Password</label>
                                <input type="password" placeholder="Confirm Password" class="form-control noroundregister" name="confiruserpass">
                            </div>
                        </div>

                        <div class="col-md-12 gap-1 d-flex" >
                            <div class=" col-md-4 mb-2">
                                <label >State</label>
                                <select name="state" id="state" class="form-select noroundregister">
                                    <option value="">Choose State</option>
                                    <?php foreach($states as $t){?>
                                    <option value="<?php echo $t['state_id']?>"><?php echo $t['state_name'];?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class=" col-md-4 mb-2">
                                <label for="">LGA</label>
                                <select name="lga" id="userlga" class="form-select noroundregister">
                                    <option value="">Choose LGA</Select></option>
                                </select>
                            </div>

                            <div class=" col-md-4 mb-2">
                                <label for="">Nearest City</label>
                                <input type="text" placeholder="Enter City Location" class="form-control noroundregister" name="ncity">
                            </div>
                        </div>

                        <button id="registerbtn" class="btn registerbtn noround col-5 offset-0" name="register-btn">Register</button>

                    </form>

                </div>

                <div class="col-md-12 collectorform" style="border: 0px solid black;">
                 
                    <form action="process/collectorregisteraction.php" method="post">

                        <div class="col-md-12 gap-1 d-flex" >
                            <div class=" col-md-6 mb-2">
                                <label for="firstname">First Name</label>
                                <input type="text" placeholder="Enter First Name" class="form-control noroundregister" name="firstname">
                            </div>

                            <div class=" col-md-6 mb-2">
                                <label for="">Last Name</label>
                                <input type="text" placeholder="Enter Last Name" class="form-control noroundregister" name="lastname">
                            </div>
                        </div>

                        <div class="col-md-12 gap-1 d-flex" >
                            <div class=" col-md-6 mb-2">
                                <label >Phone Number</label>
                                <input type="text" placeholder="Enter Phone Number" class="form-control noroundregister" name="phone">
                            </div>

                            <!-- <div class=" col-md-6 mb-2" style="position: relative;">
                                <label for="">E-mail<span id="loader2" style="font-size:14px;"></span></label>
                                <input type="email" id="email" placeholder="Enter Email Address" class="form-control noroundregister" name="email">
                                <span id="loader" style="font-size:14px;position: absolute; top: 85%; left: 0%; "></span>
                                
                            </div> -->
                            <div class=" col-md-6 mb-2" style="position:relative;">
                                <label for="">E-mail<span id="loadercoll2" style="font-size:14px;"></span></label>
                                <input type="email" placeholder="Enter Email Address" class="form-control noroundregister" name="email" id="emailcoll">
                                <span id="loadercoll" style="font-size:14px;position: absolute; top: 85%; left: 0%; "></span>
                            </div>
                        </div>

                        <div class="col-md-12 gap-1 d-flex" >
                            <div class=" col-md-6 mb-2">
                                <label >Password</label>
                                <input type="password" placeholder="Enter Password" class="form-control noroundregister" name="pass">
                            </div>

                            <div class=" col-md-6 mb-2">
                                <label for="">Confirm Password</label>
                                <input type="password" placeholder="Confirm Password" class="form-control noroundregister" name="confpass">
                            </div>
                        </div>

                        <button class="btn registerbtn noround col-5 offset-0" name="colregister-btn" id="registerbtncoll">Register</button>

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
             <b><p class="mt-4 mb-0 text-center">&copy; 2024 Eco Earn. All Rights Reserved.</p></b>
            </div>
  
          </div>
  
        
        </div>
  

      </div>
  

      <script src="jquery-3.7.1.min.js"></script>
      <script>
         $(document).ready(function(){

              
                // $("#hero-header ,.hero-text").addClass("animate__animated animate__slideInRight");

                // $('.body').load(function(){
                //     $('.user').prop('checked','checked')
                // })
                
                
                $('.user').click(function(){

                        $('.userform').show(2000)
                        $('.collectorform').hide()

                })

                $('.collector').click(function(){
                $('.userform').hide()
                $('.collectorform').show(2000)

                })


                $('#state').change(function(){
                        var state_id = $(this).val();
                        $('#userlga').load("process/state_action.php?id="+state_id);

                })


                $('#email').change(function(){

                  var email = $('#email').val();
              
                      $.ajax({
                          type: "get",
                          url:"emailverifyajax.php",
                          data:{email:email},
                          dataType:"text",
                          success:function(response){
                            if(response=="<span class='badge bg-danger ms-2'>....Already Registered</span>"){
                              

                              setTimeout(function() {
                                $('#loader').hide()
                            $('#loader2').html(response)
                            
                            $('#registerbtn').prop("disabled",true)
                              }, 5000);
                              
                          }
                            else{
                              setTimeout(function() {
                                $('#loader').hide()
                                $('#loader2').html(response)
                               
                                
                              }, 5000);
                              
                              
                              $('#registerbtn').prop("disabled",false)
                            }
                          },
                          error:function(error){
                              alert(error);
                          },
                          beforeSend: function(){

                              if((email.includes('@'))){
                                $('#loader').show();
                                $('#loader').html('<div class="spinner-grow" style="width:8px;height:8px;" role="status"><span class="visually-hidden">Loading...</span></div><div class="spinner-grow ms-1" style="width:8px;height:8px;" role="status"><span class="visually-hidden">Loading...</span></div><div class="spinner-grow ms-1" style="width:8px;height:8px;" role="status"><span class="visually-hidden">Loading...</span></div>')

                              }
                              else{
                                $('#loader2').html("<span class='badge bg-warning ms-2' style='font-size:12px;'>Enter a valid email input</span>")
                                $('#registerbtn').prop("disabled",true)
                                return false
                              }
                              
                              //  $('#loader').html("<div class='spinner-border' role='status'><span class='sr-only'></span></div>")
                          },
                          complete:function(){
                              // $('#loader').html("");
            
                          }
                      });

                })


                $('#emailcoll').change(function(){

                  var email = $('#emailcoll').val();

                  $.ajax({
                      type: "get",
                      url:"emailverifyajaxcoll.php",
                      data:{email:email},
                      dataType:"text",
                      success:function(response){
                        if(response=="<span class='badge bg-danger ms-2'>....Already Registered</span>"){
                          
                          setTimeout(function() {
                            $('#loadercoll').hide()
                        $('#loadercoll2').html(response)
                        $('#registerbtncoll').prop("disabled",true)
                          }, 5000);
                          
                      }
                        else{
                          setTimeout(function() {
                            $('#loadercoll').hide()
                            $('#loadercoll2').html(response)
                            
                          }, 5000);
                          
                          $('#registerbtncoll').prop("disabled",false)
                        }
                      },
                      error:function(error){
                          alert(error);
                      },
                      beforeSend: function(){

                          if((email.includes('@'))){
                            $('#loadercoll').show();
                            $('#loadercoll').html('<div class="spinner-grow" style="width:8px;height:8px;" role="status"><span class="visually-hidden">Loading...</span></div><div class="spinner-grow ms-1" style="width:8px;height:8px;" role="status"><span class="visually-hidden">Loading...</span></div><div class="spinner-grow ms-1" style="width:8px;height:8px;" role="status"><span class="visually-hidden">Loading...</span></div>')

                          }
                          else{
                            $('#loadercoll2').html("<span class='badge bg-warning ms-2' style='font-size:12px;'>Enter a valid email input</span>")
                            $('#registerbtncoll').prop("disabled",true)
                            return false
                          }
                          
                          //  $('#loader').html("<div class='spinner-border' role='status'><span class='sr-only'></span></div>")
                      },
                      complete:function(){
                          // $('#loader').html("");

                      }
                  });

                  })

         });
      </script>
      <script src="bootstrap/js/bootstrap.bundle.min.js" type="text/javascript"></script>
</body>
</html>