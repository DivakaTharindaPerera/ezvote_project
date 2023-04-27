
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

    <div class="nav-bar" style="height:2.5vh;">
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

<div class="overflow-y" style="overflow-x:hidden;">
<div class="bg_home">
     <div class="p-1 m-2">
        <h1 class="text-center text-white " style="padding-top:10rem; font-size:150px;">A B O U T U S</h1>
  

         <!-- <img src="<?php echo urlroot; ?>/img/welcome/bg.jpg" alt="reply" class="w-50" />  -->
         </div>
     </div>
     
             <div class="d-flex" style="margin:auto 100px auto 100px;">
                 <div class="relative min-h-10 px-1" style="width:33.33%; " >
                    <div class="text-center text-md my-1 bg-white hover-effect" style="padding: 80px 30px; box-shadow: 0 0 9px rgba(0,0,0.6);">
                    <img src="<?php echo urlroot; ?>/img/welcome/book.png"  />
                     <h3>MISSION</h3>
                     <hr>
                     <p>Our goal is to support the implementation of modern election processes and technologies with the view of facilitating 
                        elections and increasing security and transparency. Voting technologies have the potential to improve elections and to 
                        increase voter turnout since remote voters and voters with disabilities are enabled to vote.</p>
                     </div>
                 </div>
                 <div class="relative min-h-10 px-1" style="width:33.33%">
                 <div class="text-center text-md my-1 bg-white hover-effect" style="padding: 80px 30px; box-shadow: 0 0 9px rgba(0,0,0.6);">
                    <img src="<?php echo urlroot; ?>/img/welcome/globe.png"/>
                     <h3>VISSION</h3>
                     <hr>
                     <p>Online voting allows people in today’s mobile and digitally advanced society to participate in the democratic process over the internet. 
                        Our EZVOTE online voting platform provides voters with a comfortable, simple, interesting and secure voting experience and allow election 
                        organizers to save resources in planning their next election.</p>
                     </div>
                 </div>
                 <div class="relative min-h-10 px-1" style="width:33.33%">
                 <div class="text-center text-md my-1 bg-white hover-effect" style="padding: 80px 30px; box-shadow: 0 0 9px rgba(0,0,0.6);">
                    <img src="<?php echo urlroot; ?>/img/welcome/pencil.png"/>
                     <h3>OUR APPROACH</h3>
                     <hr>
                     <p>We believe that every vote should be conducted with expert precision, even the simplest ones. 
                        The EZVOTE online voting system offers the highest levels of transparency, control, security and efficiency of election processes.
                        Our team's role is to comprehend the voting needs of our clients and suggest the best options to meet those goals.</p>
                     </div>
                  </div>
              </div>
         

<!-- 
<div class="footer">
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
</html>
         


<?php 
require approot.'/View/inc/footer.php';
?>