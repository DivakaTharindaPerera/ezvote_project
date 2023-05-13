<!--<!DOCTYPE html>-->
<!--<html lang="en">-->
<!--<head>-->
<!--    <meta charset="UTF-8">-->
<!--    <meta http-equiv="X-UA-Compatible" content="IE=edge">-->
<!--    <meta name="viewport" content="width=device-width, initial-scale=1.0">-->
<!--    <link rel="stylesheet" href="/ezvote/public/css-new/framework/components/sidebar-new/sidebar.css">-->
<!--    <title>Discussion</title>-->
<!--    <script src="https://kit.fontawesome.com/ac7ec7fa10.js" crossorigin="anonymous"></script>-->
<!--   <script src="https://kit.fontawesome.com/ac7ec7fa10.js" crossorigin="anonymous"></script>-->
<!--</head>-->
<!--<body>-->


<div class="wrapper">
       
       <!--Top menu -->
       <div class="sidebar">
          
          <!--profile image & text-->
           <!--menu item-->
               <!-- <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a> -->

           <div class="profile d-flex flex-column">
               <img src="<?php echo urlroot; ?>/public/img/sys_manager.png" alt="profile_picture">
               <!-- <img <?php //echo $_SESSION["profile_image"];?>/> -->
               <div class="mt-1 white-title text-center text-uppercase">
               <p><?php echo $_SESSION["name"];?></p>
               </div>
               <!-- <p>Blogger</p> -->
           </div>



           <ul>
               <li>
                   <a id="dashboard" href="<?php echo urlroot; ?>/System_manager/dashboard" class="active">
                       <span class="icon"><i class="fas fa-desktop"></i></span>
                       <span class="item">My Dashboard</span>
                   </a>
               </li> 
               <li>
                   <a id="plan" href="<?php echo urlroot; ?>/subscription_plan/index">
                       <span class="icon"><i class="fas fa-dollar-sign"></i></span>
                       <span class="item">Subscription Plans</span>
                   </a>
               </li>
               <li>
                   <a id="sale" href="<?php echo urlroot; ?>/subscription_plan/view_sales_subscription">
                       <span class="icon"><i class="fas fa-file-invoice-dollar"></i></span>
                       <span class="item">Subscription Sales</span>
                   </a>
               </li>
               <li>
                   <a  id="announcement" href="<?php echo urlroot; ?>/System_manager/announcements">
                       <span class="icon"><i class="fas fa-bullhorn"></i></span>
                       <span class="item">Announcements</span>
                   </a>
               </li>
               <li>
                   <a  id="changelog" href="<?php echo urlroot; ?>/Subscription_plan/changeLog">
                       <span class="icon"><i class="fas fa-list"></i></span>
                       <span class="item">Change Logs</span>
                   </a>
               </li>
               <li>
                   <a  id="pricing" href="<?php echo urlroot; ?>/Subscription_plan/pricing">
                       <span class="icon"><i class="fab fa-cc-amazon-pay"></i></span>
                       <span class="item">Plan Prices</span>
                   </a>
               </li>
               <li>
                    <a href="#">
                        <span class="icon"><i class="fas fa-cog"></i></span>
                        <span class="item">Edit profile</span>
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