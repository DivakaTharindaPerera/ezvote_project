<?php require approot.'/View/inc/VoterHeader.php'; ?>

<div class="d-flex border-radius-3 min-w-60 min-h-85 border-4 border-primary">
    <div class="d-flex w-50 bg-primary justify-content-center align-items-center">
        <img src="<?php echo urlroot;?>/public/img/reset.jpg" alt="" style="min-height: 200px; max-width:400px;" > </div>
    <div class="d-flex flex-column w-50">
        <div class="d-flex justify-content-center"> <img src="<?php echo urlroot;?>/public/img/ezvotelogo.png" alt="" style="min-height: 80px; max-width:200px;"></div>
        <div class="title ">Update Password</div>
        <div class="d-flex flex-column justify-content-center mx-2 bg-secondary mb-1 border-radius-1">
            <form action='<?php echo urlroot; ?>/System_manager/update' method='POST' class="d-flex flex-column" >
                <div class="d-flex flex-column my-1 mx-1">
                    <div><label for="email">Verification Code</label></div>
                    <div><input type="text" name="v-code" id="code" value="<?= htmlspecialchars($_POST["email"] ?? "") ?>" placeholder="Enter verification code...." onclick="clickToclear()"></div>
                </div>
                <div class="d-flex flex-column my-1 mx-1">
                    <div><label for="email">New Password</label></div>
                    <div>
                        <input type="password" name="pwd" id="password" placeholder="Enter new password....">
                        <em id="error"><?php if(isset($data['error'])){ echo $data['error']; } ?></em>
                    </div>
                </div>
                <div class="d-flex flex-column my-1 mx-1">
                    <div><label for="email">Confirm Password</label></div>
                    <div>
                        <input type="password" name="confirm-pwd" id="confirm-password" placeholder="Re enter password....">
                        <em id="error"><?php if(isset($data['error'])){ echo $data['error']; } ?></em>
                    </div>
                </div>
                <!-- <div class="text-s mx-1">
                    <a href="/ezvote/System_manager/forgot">Forgotten Password?</a>
                </div> -->
                <div class="d-flex justify-content-center mt-1 px-1 mb-1">
                    <button type="submit" class="btn btn-primary" style="min-width: 250px">RESET</button>
                </div>
                <!-- <div class="d-flex justify-content-center mt-1 px-1">
                    <button type="submit" class="btn bg-white text-center" style="min-width: 250px">
                        <img src="<?php echo urlroot;?>/public/img/google.png" alt="" style="max-width: 30px; max-height: 25px" class="mx-1">SIGN IN WITH GOOGLE</button>
                </div> -->
        </form>
        </div>
    </div>
</div>


<?php require approot.'/View/inc/footer.php'; ?>