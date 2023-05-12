<header class="bg-white text-black">
    <script>
    </script>
    <nav>
        <div class="logo">
            <img src="/ezvote/public/img/ezvotelogo.png" width="120rem" alt="">
            <span></span>
        </div>
        <ul class="navList d-flex px-1">
                <li><a href="/ezvote/pages/home" class="px-1">Home</a></li>
<!--                <a href="#" class="px-1">Notifications</a>-->
                <a href="javascript:profile();" class="px-1">Profile</a>
<!--                <br>-->
                <div class="dialog-box-outer" id="popup2">
                <div class="popup mx-1 my-1 p-1 max-w-50 max-h-50 border-primary border-1 border-radius-2" >
                    <div class="d-flex justify-content-end mb-1">
                        <a href="#" class="close-btn" onclick="closeProfile()"><i class="fa-solid fa-xmark"></i></a>
                    </div>
                    <div class="mx-1 my-1 px-1 py-1 w-90 border-primary border-4 border-radius-2">

                    <div class="align-items-center justify-content-center mt-1">
                        <img src="<?= $_SESSION['profile_picture']?>" alt="" class="max-h-20 max-w-20" style="border-radius: 50%">
                    </div>
                    <div class="title">Name:<?= " ".$_SESSION['fname']." ".$_SESSION['lname']?></div>
                    <div class="sub-title">Email:<?= " ".$_SESSION['email']?></div>
                    <div class="d-flex justify-content-center align-items-center my-1">
                        <button class="btn btn-primary" onclick="editingProfile()">Edit Profile</button>
                    </div>
                    </div>
                </div>
                </div>

                <a href="/ezvote/Controller/logout" class="btn btn-info">Logout</a>
        </ul>
    </nav>
</header>
