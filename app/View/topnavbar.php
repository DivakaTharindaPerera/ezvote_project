<?php
    session_start();
    
    echo "
    <style>
        .logo, .homelink, .authlink, .profile, .profilepic{
            display: inline-block;
            margin: 0 10px;
        }
        .topnavbar{
            font-size: 26px;
            position: relative;
            width: 100%;
            height: 100px;
        }
        .topnavbar .topnavbarfg{
            display: flex;
            z-index: 1;
            height: 100px;
            overflow: hidden;
            align-items: center;
        }
        .topnavbar .topnavbarbg{
            position: absolute;
            width: 100%;
            height: 100px;
            z-index: -1;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;   
            background-image: url(".urlroot."/img/topnavbarbg.jpg);
            background-size: cover;
            opacity: 0.3;
        }
        
        .logo{
            float: left;
            font-size: 20px;
            color: blue;
        }
        .logo img{
            width: 200px;
            height: 89px;
        }

        .profilepic{
            margin-left: 10px;
            padding: 10px;
            float: right;
            color: blue;
        }
        .profilepic img{
            width: 110px;
            height: 50px;
        }
        .profile{
            margin-left: 10px;
            float: right;
            font-weight: bold;
        }
        .authlink{
            float: right;
            margin-left: auto;
            font-weight: bold;
        }
        .authlink a{
            color: blue;
        }
        .homelink a{
            color: blue;
        }
        
    </style>

    <div class='topnavbar'>
    <div class='topnavbarbg'>
    </div>
    <div class='topnavbarfg'>
    <div class='logo'>
        <a href='Supervisor_login.php'><img src='".urlroot."/img/ezvotelogo.png' alt='logo'></a>
    </div>
    <div class='homelink'>
        <a href='".urlroot."'>Home</a>
    </div>
    <div class='authlink'>";

    if(!isset($_SESSION["UserId"])){
        echo "<a href='".urlroot."/View/Login'>Login</a> <a href='".urlroot."/View/Register'>Signup</a>";
    }else{
        echo "<a href='".urlroot."/View/Logout'>Logout</a>";
    }
    echo "
    </div>
    <div class='profile'>
        ".$_SESSION["fname"]." ".$_SESSION["lname"]."
    </div>
    <div class='profilepic'>
        <img src='".urlroot."/img/ezvotelogo.png' alt='profilepic'>
    </div>
    </div>
</div>
    ";
?>
