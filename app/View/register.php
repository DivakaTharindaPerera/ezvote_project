<?php require approot.'/View/inc/header.php'; ?>
    <div class="top_nav_bar">
        <?php
            require_once("topnavbar.php");
        ?>
    </div>
    
    <br><br>
    <div class="registerForm center">
    <div class="heading">
    <h1>Signup for ezVote</h1>
    </div>
    <br>
    <br>
    <form action="<?php echo urlroot; ?>/users/register" method="post"> 
        <div class="nameBox">
            
            <input type="text" id="fname" name="fname" placeholder="First Name" required>

            <input type="text" id="lname" name="lname" placeholder="Second Name" required>
        </div>
        <br>
        <div class="emailBox">
            <input type="email" id="email" name="email" placeholder="Email" required>
            <br>
            <?php 
                if(isset($data['emailError'])){
                    echo "<em style='color: red'> ".$data['emailError']." </em>";
                }
            ?>
        </div>
        <br>
        <div class="passwordBox">
            <div class="passwordinput">
            <input type="password" id="password" name="password" placeholder="Password" required>
            </div>
            <div class="passwordConst">
            <p>Your password must contain more than 8 characters and contain atleast one lowercase letter, one uppercase letter and one number!</p>
        
            </div>
            </div><br>
        <div class="passwordConfirm">
            <input type="password" id="passwordConfirm" name="passwordConfirm" placeholder="Confirm password.."  onkeyup="passConfirmValidation()" required>
            <br><em id="passConfirmError" style="color: red;"></em>
        </div>
        <br>
        <div class="submit">
            <button type="submit" id="regBtn">REGISTER</button>
        </div>
    </form>
    </div>
    <div class="logoimg">
        
    </div>
    <script src="<?php echo urlroot; ?>/js/register.js"></script>
<?php require approot.'/View/inc/footer.php'; ?>