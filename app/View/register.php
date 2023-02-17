<?php require approot.'/View/inc/VoterHeader.php'; ?>

    <div class="d-flex border-radius-3 min-w-60 min-h-85 border-4 border-primary">
        <div class="d-flex w-50 bg-primary justify-content-center align-items-center">
            <img src="<?php echo urlroot;?>/public/img/signup.jpg" alt="" style="min-height: 300px; max-width:400px;" > </div>
        <div class="d-flex flex-column w-50">
            <div class="d-flex justify-content-center"> <img src="<?php echo urlroot;?>/public/img/ezvotelogo.png" alt="" style="min-height: 80px; max-width:200px;"></div>
            <div class="title ">Create an account</div>
            <div class="d-flex flex-column justify-content-center mx-2 bg-secondary mb-1 border-radius-1">
                <form action="<?php echo urlroot; ?>/users/register" method="post"  autocomplete="off" class="d-flex flex-column ">
                    <div class="d-flex mt-1 mx-1">
                        <input type="text" id="fname" name="fname" placeholder="First Name" required>
                    </div>
                    <div class="d-flex mt-1 mx-1">
                        <input type="text" id="lname" name="lname" placeholder="Last Name" required>
                    </div>
                    <div class="d-flex mt-1 mx-1">
                        <input type="email" id="email" name="email" placeholder="Email" required>
                        <?php
                        if(isset($data['emailError'])){
                            echo "<em style='color: red'> ".$data['emailError']." </em>";
                        }
                        ?>
                    </div>
                    <div class="passwordBox">
                        <div class="mx-1 mt-1">
                            <input type="password" id="password" name="password" placeholder="Password" required>
                        </div>
<!--                        <div class="text-warning mx-1">Your password must contain more than 8 characters and contain atleast one lowercase letter, one uppercase letter and one number!</div>-->
                    </div>
                    <div class="mx-1 mt-1">
                        <input type="password" id="passwordConfirm" name="passwordConfirm" placeholder="Confirm password.."  onkeyup="passConfirmValidation()" required>
                        <br><em id="passConfirmError" style="color: red;"></em>
                    </div>
                    <div class="d-flex justify-content-center mt-1 px-1">
                        <button class="btn btn-primary " type="submit" id="regBtn" style="min-width: 250px">SIGN UP</button>
                    </div>
                </form>
                <div class="justify-content-center my-1">
                    <p class="text-center">Already have an account? <a href="ezvote/pages/login" class="nav-link-text">LogIn</a>
                </div>
            </div>

        
        </div>
    </div>
        
    <script src="<?php echo urlroot; ?>/js/register.js"></script>
<?php require approot.'/View/inc/footer.php'; ?>