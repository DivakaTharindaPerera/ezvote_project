<?php
//var_dump($data);
//exit();
require approot.'/View/inc/VoterHeader.php';
require approot.'/View/inc/AuthNavbar.php';
require approot.'/View/inc/sidebar-new.php';
?>
<div class="main-container">
    <div class="title">EDIT PROFILE</div>
    <div class="d-flex flex-column justify-content-center align-items-center bg-white-0-7 border-radius-2 shadow">
        <form action="/ezvote/pages/editProfile" method="post" class="border border-3 border-radius-2">
            <div class="d-flex align-items-center justify-content-center mt-1">
                <img src="<?= urlroot?>/public/img/profile.jpg" alt="" class="max-h-20 max-w-20">
            </div>
            <div class="d-flex mt-1 mx-1">
                <input type="text" id="fname" name="fname" placeholder="First Name" required>
            </div>
            <div class="d-flex mt-1 mx-1">
                <input type="text" id="lname" name="lname" placeholder="Last Name" required>
            </div>
            <div class="d-flex mt-1 mx-1">
                <input type="email" id="email" name="email" placeholder="Email" required>
                <br>
                <?php
                if(isset($data['emailError'])){
                    echo "<em style='color: red'> ".$data['emailError']." </em>";
                }
                ?>
            </div>
            <div class="d-flex flex-column my-1 mx-1" >
<!--                <label for="changePassword">Do you want to change password?</label>-->
<!--                <input type="checkbox" id="changePassword_check" name="changePassword" onclick="showPassword()" class="mt-1">-->
                <div class="d-flex flex-column my-1 " id="changePassword">
                    <label for="changePassword" class="">Old Password</label>
                    <input type="password" id="old_password" name="old_password" placeholder="Password" class="mt-1">
                    <br>
                    <?php if(isset($data['old_passwordError'])){
                        echo "<em style='color: red'> ".$data['passwordError']." </em>";
                    }?>
<!--                        <input type='submit' name='submit' value='Submit' class='d-flex btn btn-primary w-25 justify-content-center align-items-center' onclick="confirmOld()">-->
                </div>
                <div class="d-flex flex-column my-1" id="getNewPassword">
                    <label for="changePassword">New Password</label>
                    <input type="password" id="new_password" name="new_password" placeholder="New Password" class="mb-1">
                    <input type="password" id="confirmed_password" name="confirmed_password" placeholder="Confirm New Password">
                    <?php if(isset($data['confirmPasswordError'])){
                        echo "<em style='color: red'> ".$data['confirmPasswordError']." </em>";
                    }?>
                    <!--                        <input type='submit' name='submit' value='Submit' class='d-flex btn btn-primary w-25 justify-content-center align-items-center'>-->
                </div>

            </div>
            <div class="d-flex justify-content-center align-items-center my-1">
                <input class="btn btn-primary " type="submit"></input>
            </div>
        </form>
    </div>
</div>
<script src="<?= urlroot?>/public/js/editProfile.js"></script>

<?php require approot.'/View/inc/footer.php';?>

