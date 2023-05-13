<?php require approot.'/View/inc/VoterHeader.php'; ?>

<div class="d-flex border-radius-3 min-w-60 min-h-85 border-4 border-primary">
    <div class="d-flex w-50 bg-primary justify-content-center align-items-center">
        <img src="<?php echo urlroot;?>/public/img/login.jpg" alt="" style="min-height: 165px; max-width:400px;" > </div>
    <div class="d-flex flex-column w-50">
        <div class="d-flex justify-content-center"> <img src="<?php echo urlroot;?>/public/img/ezvotelogo.png" alt="" style="min-height: 80px; max-width:200px;"></div>
        <div class="title ">Welcome Back</div>
        <div class="d-flex flex-column justify-content-center mx-2 bg-secondary mb-1 border-radius-1">
            <form action='<?php echo urlroot; ?>/System_manager/dashboard' method='POST' class="d-flex flex-column" >
                <div class="d-flex flex-column my-1 mx-1">
                    <div><label for="email">Email</label></div>
                    <div><input type="email" name="email" id="email" value="<?= htmlspecialchars($_POST["email"] ?? "") ?>" placeholder="Email...." onclick="clickToclear()" required></div>
                </div>
                <div class="d-flex flex-column my-1 mx-1">
                    <div><label for="email">Password</label></div>
                    <div>
                        <input type="password" name="password" id="password" placeholder="password...." required>
                        <em class="text-danger" id="error"><?php if(isset($data['error'])){ echo $data['error']; } ?></em>
                    </div>
                </div>
                <div class="text-s mx-1">
                    <a href="/ezvote/System_manager/forgot">Forgotten Password?</a>
                </div>
                <div class="d-flex justify-content-center mt-1 px-1 mb-1">
                    <button type="submit" class="btn btn-primary" style="min-width: 250px">SIGN IN</button>
                </div>
        </form>
        </div>
    </div>
</div>


<?php require approot.'/View/inc/footer.php'; ?>