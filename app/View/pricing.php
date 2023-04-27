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
<div class="overflow-y" style="overflow-x:hidden;">

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

<div class="bg_pricing">
     <div class="p-1 m-2">
     <h1 class="text-center text-white " style="padding-top:10rem; font-size:120px;">Simple, Flexible <br>Pricing </h1>
  
     </div>
     </div>
     <div class="w-50 bg-white m-auto py-1">

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
            </div>

            </div>

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
     


<?php require approot.'/View/inc/footer.php';?>