<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo urlroot; ?>/css/side_bar.css">
    <title>Discussion</title>
    <script src="https://kit.fontawesome.com/ac7ec7fa10.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="wrapper">
       
        <!--Top menu -->
        <div class="sidebar">
           
           <!--profile image & text-->
            <!--menu item-->
                <!-- <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a> -->

            <div class="profile">
                <img src="<?php echo urlroot; ?>/img/welcome/boy.jpg" alt="profile_picture">
                <!-- <h3>John Doe</h3>
                <p>Blogger</p> -->
            </div>



            <ul>
                <li>
                    <a href="<?php echo urlroot; ?>/Candidates/candidateProfile" class="active">
                        <span class="icon"><i class="fas fa-home"></i></span>
                        <span class="item">Home</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo urlroot; ?>/Candidates/viewElections">
                        <span class="icon"><i class="fas fa-desktop"></i></span>
                        <span class="item">My Dashboard</span>
                    </a>
                </li> 
                <li>
                    <a href="<?php echo urlroot; ?>/Candidates/discussionForum">
                        <span class="icon"><i class="fas fa-user-friends"></i></span>
                        <span class="item">Discussion Forum</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo urlroot; ?>/Candidates/objections">
                        <span class="icon"><i class="fas fa-tachometer-alt"></i></span>
                        <span class="item">Objections</span>
                    </a>
                </li>
                <!-- <li>
                    <a href="#">
                        <span class="icon"><i class="fa-solid fa-republican"></i></span>
                        <span class="item">Elections</span>
                    </a>
                </li> -->

                <!-- <li>
                    <a href="#">
                        <span class="icon"><i class="fa-sharp fa-solid fa-check-to-slot"></i></span>
                        <span class="item">My Elections</span>
                    </a>
                </li> -->

                <li>
                    <a href="<?php echo urlroot; ?>/Candidates/conferences">
                        <span class="icon"><i class="fa-sharp fa-solid fa-people-group"></i></span>
                        <span class="item">Conferences</span>
                    </a>
                </li>

                <!-- <li>
                    <a href="#">
                        <span class="icon"><i class="fas fa-cog"></i></span>
                        <span class="item">Edit profile</span>
                    </a>
                </li> -->
            </ul>
        </div>


        <!-- <div class="section">
            <div class="top_navbar">
                <div class="hamburger">
                    <a href="#">
                        <i class="fas fa-bars"></i>
                    </a>
                </div>
            </div>

        </div> -->
        </div>

    </div>


    <!-- Profile -->

    
    <script src="<?php echo urlroot; ?>/js/side_bar.js"></script>

</body>
</html>