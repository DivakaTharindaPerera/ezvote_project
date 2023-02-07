
    // session_start();
    

//
            <div class='d-flex'>
                <div class='d-flex justify-content-center'>
                    <a href='Supervisor_login.php'><img src='<?php echo urlroot;?>"/img/ezvotelogo.png' alt='logo'></a>
                </div>
                <div class='homelink'>
                    <a href='".urlroot."'>Home</a>
                </div>
                <div class='authlink'>";

                    if(!isset($_SESSION["UserId"])){
                    echo "
                    <div class= 'login'>
                        <a href='".urlroot."/View/Login'>Login</a> <a href='".urlroot."/View/Register'>Signup</a>
                    </div>
                    ";
                    }else{
                    echo "


                    <div class='profile'>
                        <h4>".$_SESSION["fname"]." ".$_SESSION["lname"]."</h4>
                    </div>
                    <div class='logout'>
                        <a href='".urlroot."/View/Logout'>Logout</a>
                    </div>
                    ";
                    }
                    echo "
                </div>
                ";
                if(isset($_SESSION["UserId"])){
                echo "
                <div class='profilepic'>
                    <img src='".urlroot."/img/ezvotelogo.png' alt='profilepic'>
                </div>
                ";
                }
                echo "
            </div>


