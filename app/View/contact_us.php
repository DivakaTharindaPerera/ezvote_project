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
    <div class="nav-bar" style="height:12vh;">
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
<div class="bg_contact_us">
     <div class="">

     </div>
     </div>

    <form action="#" class="form border-2 border-dark text-1xl bg-dark px-5 text-white my-3" method="POST" enctype="multipart/form-data" style="margin-left:450px; width:600px">
        
    <h2 class="text-center my-1">Let's Chat</h2><br>

    <div class="d-flex">
    <div class="flex-column px-1 ">
    <span>First Name<span class="text-danger">*</span></span><br>
    <div class="bg-light">
    <input type="text" name="firstname" id="firstname" class="text-dark">
    </div>
    <em class="text-danger"><?php if(isset($data['firstname_err'])){ echo $data['firstname_err']; } ?></em>
    </div>
    <div class="flex-column px-1">
    <span>Last Name<span class="text-danger">*</span></span><br>
    <div class="bg-light">
    <input type="text" name="lastname" id="lastname" class="text-dark">
    </div>
    <em class="text-danger"><?php if(isset($data['lastname_err'])){ echo $data['lastname_err']; } ?></em>
    </div>
    </div>
    <br>
    
    <div class="d-flex">
    <div class="flex-column px-1">
    <span>Email<span class="text-danger">*</span></span><br>
    <div class="bg-light">
    <input type="text" name="email" id="email" class="text-dark">
    </div>
    <em class="text-danger"><?php if(isset($data['email_err'])){ echo $data['email_err']; } ?></em>
    </div>
    <div class="flex-column px-1">
    <span>Phone number</span><br>
    <div class="bg-light">
    <input type="text" name="phoneno" id="phoneno" class="text-dark">
    </div>
    </div>
    </div>
    <br>
    
    <div class="px-1">
    <span>Organization, Club or Union<span class="text-danger">*</span></span><br>
    <div class="bg-light">
    <input type="text" name="organization" id="organization" class="text-dark">
    </div>
    <em class="text-danger"><?php if(isset($data['organization_err'])){ echo $data['organization_err']; } ?></em>
    </div>
    <br>
    
    <div class="d-flex">
    <div class="flex-column px-1">
    <span>Number of Eligible Voters<span class="text-danger">*</span></span><br>
    <div class="bg-light">
    <input type="text" name="noofvoters" id="noofvoters" class="text-dark">
    </div>
    <em class="text-danger"><?php if(isset($data['noofvoters_err'])){ echo $data['noofvoters_err']; } ?></em>
    </div>
    <div class="flex-column px-1">
    <span>Vote Start Date<span class="text-danger">*</span></span><br>
    <div class="bg-light" style="padding:1.5vh; width:25.5vh;">
    <input type="date" name="start_date" id="start_date" class="text-dark">
    </div>
    <em class="text-danger"><?php if(isset($data['votingstartdate_err'])){ echo $data['votingstartdate_err']; } ?></em>
    </div>
    </div>
    <br>
    
    <div class="px-1">
    <span>Provide additional details about your voting event</span><br>
    <div class="bg-light">
    <input type="text" name="additionaldetails" id="additionaldetails" class="text-dark">
    </div>
    </div>
    <br>
    
    <!-- save     -->
        <button type="submit" id="btn" name="submit" class="btn bg-red-6 text-white" style="margin-left:185px;">Submit</button>
        <br><br>
        
    </form>
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
         
