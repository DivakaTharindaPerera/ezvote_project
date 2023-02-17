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

           <div class="profile">
               <img src="<?php echo urlroot; ?>/img/sys_manager.png" alt="profile_picture">
<!--               <h3>--><?php //echo $_SESSION["name"];?><!--</h3>-->
<!--               <p>Blogger</p>-->
           </div>



           <ul>
               <li>
                   <a href="#" class="active">
                       <span class="icon"><i class="fas fa-home"></i></span>
                       <span class="item">Home</span>
                   </a>
               </li>
               <li>
                   <a href="./../System_manager/dashboard">
                       <span class="icon"><i class="fas fa-desktop"></i></span>
                       <span class="item">My Dashboard</span>
                   </a>
               </li> 
               <li>
                   <a href="./../subscription_plan/index">
                       <span class="icon"><i class="fas fa-dollar-sign"></i></span>
                       <span class="item">Subscription Plans</span>
                   </a>
               </li>
               <li>
                   <a href="./../subscription_plan/sales_subscription">
                       <span class="icon"><i class="fas fa-file-invoice-dollar"></i></span>
                       <span class="item">Subscription Sales</span>
                   </a>
               </li>
               <li>
                   <a href="./../System_manager/announcements">
                       <span class="icon"><i class="fas fa-bullhorn"></i></i></span>
                       <span class="item">Announcements</span>
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