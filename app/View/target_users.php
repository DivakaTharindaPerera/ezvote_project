<?php require approot . '/View/inc/VoterHeader.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="<?php echo urlroot; ?>/css/home.css">

    <title>ezVote</title>
</head>
<body>
    <div class="nav-bar" style="height:7vh;">
        <div class="logo"><img id="logo" src="<?php echo urlroot; ?>/img/welcome/ezvotelogo.png" alt="logo"></div>
        <div class="links">
            <a href="/ezvote/Pages/home">Home</a>
            <a href="/ezvote/Pages/services">Services</a>
            <a href="/ezvote/Pages/pricing">Pricing</a>
            <a href="/ezvote/Pages/targetUsers">Target users</a>
            <a href="/ezvote/Pages/aboutUs">About Us</a>
            <a href="/ezvote/Pages/contactUs">Contact</a>
        </div>
        <div class="nav-end">
            <!-- <a href="<?php echo urlroot; ?>/View/Login"><button type="button">Login</button></a>
            <a href="<?php echo urlroot; ?>/View/Register"><button id="trial">Register</button></a> -->

            <div class="dropdown">
                <button class="dropbtn">Login</button>
                <div class="dropdown-content">
                    <a href="#">Administrator</a>
                    <a href="<?php echo urlroot; ?>/View/Login">Other Users</a>
                </div>
            </div>
            <a href="<?php echo urlroot; ?>/View/Register"><button class="dropbtn" style="margin-top: -6px;">Register</button></a>

        </div>
    </div>

    <div class="d-flex flex-column overflow-y" style="overflow-x:hidden;">
        <div class="bg_target_users">
        <div class="p-1 m-2">
            <h1 class="text-center text-white " style="padding-top:10rem; font-size:120px;">TARGET USERS</h1>
        </div>
    </div>
     <!-- <div class="w-50 bg-white m-auto py-1">

            <div class="w-75 m-auto bg-dark py-1">
            <h1 class="text-center font-bold text-white">Our Pricing</h1>
            <div class="w-75 m-auto bg-primary">
                <h3 class="text-center">ezVote Pricing <br>Starting at</h3>
                <p class="text-4xl text-center font-bold py-1 text-white">RS.2500/Month</p>
                <p class="text-1xl text-center font-bold text-white">6 or 12-month Subscription</p>
                <br>


            <P class="text-center font-bold">
                <ul class="text-center">
                    <li class="text-white text-2xl">Unlimited, self-administered ballots</li>
                    <li class="text-white text-2xl">Simple voter list management</li>
                    <li class="text-white text-2xl">Voter notifications</li>
                    <li class="text-white text-2xl">Real-time results</li>
                    <li class="text-white text-2xl">Anonymous & weighted voting options</li>
                    <li class="text-white text-2xl">Product knowledge base</li>
                    <li class="text-white text-2xl">Email support</li>
                </ul></P>
            </div> -->

            
            
            <h1 class="text-center text-dark p-2  ">Organizations we serve</h1>
            <div class="d-flex " style="margin:auto 100px auto 100px;">
                 <div class="relative min-h-10 px-1" style="width:33.33%; " >
                    <div class="text-center text-md my-1 bg_imgs hover-effect " style="padding: 80px 30px; box-shadow: 0 0 9px rgba(0,0,0.6);">
                    <!-- <img src="<?php echo urlroot; ?>/img/welcome/book.png"  /> -->
                     <h3>ASSOCIATIONS</h3>
                     <hr>
                     <p>
                     Leadership Elections<br>
                     Organizational Voting<br>
                     Positional Voting                     
                     </p>
                     </div>
                 </div>
                 <div class="relative min-h-10 px-1" style="width:33.33%">
                 <div class="text-center text-md my-1 bg-white bg_imgs hover-effect" style="padding: 80px 30px; box-shadow: 0 0 9px rgba(0,0,0.6);">
                    <!-- <img src="<?php echo urlroot; ?>/img/welcome/globe.png"/> -->
                     <h3>SOCIETIES</h3>
                     <hr>
                     <p>
                     Leadership Elections<br>
                     Organizational Voting<br>
                     Positional Voting
                     
                    </p>
                     </div>
                 </div>
                 <div class="relative min-h-10 px-1" style="width:33.33%">
                 <div class="text-center text-md my-1 bg-white bg_imgs hover-effect" style="padding: 80px 30px; box-shadow: 0 0 9px rgba(0,0,0.6);">
                    <!-- <img src="<?php echo urlroot; ?>/img/welcome/pencil.png"/> -->
                     <h3>UNIONS</h3>
                     <hr>
                     <p>
                     Leadership Elections<br>
                     Organizational Voting<br>
                     Positional Voting
                   
                     </p>
                     </div>
                  </div>
                  </div>


                <!-- **************************************-->
            <div class="d-flex" style="margin:auto 100px auto 100px;">

                <div class="relative min-h-10 px-1" style="width:33.33%; " >
                    <div class="text-center text-md my-1 bg-white bg_imgs hover-effect" style="padding: 80px 30px; box-shadow: 0 0 9px rgba(0,0,0.6); ">
                    <!-- <img src="<?php echo urlroot; ?>/img/welcome/book.png"  /> -->
                     <h3>CLUBS</h3>
                     <hr>
                     <p>
                     Leadership Elections<br>
                     Organizational Voting<br>
                     Positional Voting
                     
                     </p>
                     </div>
                 </div>
                 <div class="relative min-h-10 px-1" style="width:33.33%">
                 <div class="text-center text-md my-1 bg-white bg_imgs hover-effect" style="padding: 80px 30px; box-shadow: 0 0 9px rgba(0,0,0.6);">
                    <!-- <img src="<?php echo urlroot; ?>/img/welcome/globe.png"/> -->
                     <h3>SCHOOLS</h3>
                     <hr>
                     <p>
                     Leadership Elections<br>
                     Club Elections<br>
                     Organizational Voting<br>
                    
                    </p>
                     </div>
                 </div>

                 <div class="relative min-h-10 px-1" style="width:33.33%">
                 <div class="text-center text-md my-1 bg-white bg_imgs hover-effect" style="padding: 80px 30px; box-shadow: 0 0 9px rgba(0,0,0.6);">
                    <!-- <img src="<?php echo urlroot; ?>/img/welcome/pencil.png"/> -->
                     <h3>UNIVERSITIES</h3>
                     <hr>
                     <p>
                     Leadership Elections<br>
                     Club Elections<br>
                     Organizational Voting<br>
                     
                     </p>
                     </div>
                  </div>
                <!-- **************************************-->


              </div>




<!-- <div class="footer">
    <div class="container">
        <div class="row">
            <div class="footer-col">
                <h4>About</h4>
                <ul>
                    <li><a href="#">about us</a></li>
                    <li><a href="#">our services</a></li>
                    <li><a href="#">privacy policy</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>My Account</h4>
                <ul>
                    <li><a href="#">Login</a></li>
                    <li><a href="#">Support</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Products & Features</h4>
                <ul>
                    <li><a href="#">Meetings</a></li>
                    <li><a href="#">Support</a></li>
                </ul>
            </div>
                
            <div class="footer-col">
                <h4>follow us</h4>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            </div>
    </div>

</div> -->

</div>
</body>


<?php require approot.'/View/inc/footer.php';?>