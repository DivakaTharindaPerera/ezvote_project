<!--<!DOCTYPE html>-->
<!--<html lang="en">-->
<!--<head>-->
<!--    <meta charset="UTF-8">-->
<!--    <meta http-equiv="X-UA-Compatible" content="IE=edge">-->
<!--    <meta name="viewport" content="width=device-width, initial-scale=1.0">-->
<!--    <link rel="stylesheet" href="/ezvote/public/css-new/framework/components/sidebar-new/sidebar.css">-->
<!--    <title>Discussion</title>-->
<!--    <script src="https://kit.fontawesome.com/ac7ec7fa10.js" crossorigin="anonymous"></script>-->
<!--    <script src="https://kit.fontawesome.com/ac7ec7fa10.js" crossorigin="anonymous"></script>-->
<!--</head>-->
<!--<body>-->


    <div class="wrapper">
       
        <!--Top menu -->
        <div class="sidebar">
           
           <!--profile image & text-->
            <!--menu item-->
                <!-- <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a> -->

            <div class="profile mr-1">
                <img src="<?php echo urlroot; ?>/img/welcome/boy.jpg" style="object-fit: cover" alt="profile_picture"><br>
                <h3 class="text-center text-md text-white mr-1"><?= $_SESSION['fname']." ".$_SESSION['lname']?></h3>
<!--                <p>Blogger</p>-->
            </div>


            <ul>
<!--                <li>-->
<!--                    <a href="--><?php //echo urlroot; ?><!--/Pages/goHome" class="active">-->
<!--                        <span class="icon"><i class="fas fa-home"></i></span>-->
<!--                        <span class="item">Home</span>-->
<!--                    </a>-->
<!--                </li>-->
                <li>
                    <a href="<?php echo urlroot; ?>/Pages/dashboard">
                        <span class="icon"><i class="fas fa-desktop"></i></span>
                        <span class="item">My Dashboard</span>
                    </a>
                </li> 

                <!-- create election -->
                <li>
                    <a href="<?php echo urlroot; ?>/View/Createelection">
                        <span class="icon"><i class="fas fa-vote-yea"></i></span>
                        <span class="item">Create Election</span>
                    </a>
                </li>
<!--                <li>-->
<!--                    <a href="--><?php //echo urlroot; ?><!--/Pages/viewAllObjections">-->
<!--                        <span class="icon"><i class="fa-solid fa-bullseye"></i></span>-->
<!--                        <span class="item">Objections</span>-->
<!--                    </a>-->
<!--                </li>-->
                <!-- view elections -->

                <li>
                    <a href="<?php echo urlroot; ?>/View/ViewMyElections">
                        <span class="icon"><i class="fas fa-clipboard"></i></span>
                        <span class="item">View My Elections</span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo urlroot; ?>/Candidates/discussionForum">
                        <span class="icon"><i class="fa-brands fa-wpforms"></i></span>
                        <span class="item">Discussion Forum</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo urlroot; ?>/Pages/viewAllConferences">
                        <span class="icon"><i class="fa-solid fa-users"></i></span>
                        <span class="item">Conferences</span>
                    </a>
                </li>

                <!-- subscription plans -->
                <li>
                    <a href="<?php echo urlroot; ?>/View/subscriptionPlans">
                        <span class="icon"><i class="fas fa-dollar-sign"></i></span>
                        <span class="item">Subscription Plans</span>
                    </a>
                <li>
                    <a href="<?php echo urlroot; ?>/Candidates/candidateProfile">
                        <span class="icon"><i class="fas fa-cog"></i></span>
                        <span class="item">Edit profile</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo urlroot; ?>/Candidates/applyNomination">
                        <span class="icon"><i class="fas fa-cog"></i></span>
                        <span class="item">Apply Nomination</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo urlroot; ?>/Candidates/candidateProfile">
                        <span class="icon"><i class="fas fa-cog"></i></span>
                        <span class="item">Candidate</span>
                    </a>
                </li>
            </ul>
        </div>


<!--        <div class="section">-->
<!--            <div class="top_navbar">-->
<!--                <div class="hamburger">-->
<!--                    <a href="#">-->
<!--                        <i class="fas fa-bars"></i>-->
<!--                    </a>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--        </div>-->
        </div>

    </div>


    <!-- Profile -->

    
    <script src="sidebar.js"></script>

<!--</body>-->
<!--</html>-->