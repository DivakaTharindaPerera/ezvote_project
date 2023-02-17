<?php
    // session_start();
    
    echo "
    <style>
        h4{
            margin: 0;
            padding: 0;
        }
        .logo, .homelink, .authlink, .profilepic{
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
            width: 70px;
            height: 70px;
            margin-top: 15px;
        }
        .profile{
            text-align: right;
            float: right;
            font-weight: bold;
        }
        .authlink{
            float: right;
            margin-left: auto;
            font-weight: bold;
            text-align: right;
        }
        .authlink a{
            color: blue;
        }
        .homelink a{
            color: blue;
        }
        .logout a{
            color: blue;
            text-decoration: none;
            font-size: 26px;
            position: absolute;
            margin-top: 1.2vh;
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

    if(isset($_SESSION["UserId"])){
        echo "
        <div class='profile'>
            <h4 style='margin-left: 0%;
            margin-top: 18px;
            width: 300px;'
            >".$_SESSION["name"]."</h4>
        </div>
        <div class='logout'>
        <a href='".urlroot."./System_manager/logout'>Logout</a>
        </div>
        ";
    }
    echo "
    </div>
    ";
    if(isset($_SESSION["UserId"])){
        echo "
    <div class='profilepic'>
        <img src='".urlroot."/img/profile.png' alt='profilepic'>
    </div>
        ";
    }
    echo "
    </div>
</div>
    ";
?>
