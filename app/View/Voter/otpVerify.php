<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>

<div class="border-1 bg-light p-3">
    <div id="form">
        <form action="" method="post">
            <h3 class="text-center">An OTP has sent to your email [<?php echo $data['email'];?>]</h3>
            <h3 class="text-center">Please enter the OTP to verify yourself</h3>
            <div id="error" class="mr-1 ml-1 mb-1 mt-3">
                <span id='error'>
                    <?php
                    if (isset($data['error'])) {
                        echo $data['error'];
                    }
                    ?>
                </span>
            </div>

            <div id="inputs" class="m-1">
                <input type="text" name="otp" placeholder="Enter OTP...." required style="border-radius: 20px; padding-left: 15px;">
            </div>
            <div id="buttons" class="m-1 text-center">
                <button type="submit" name="submit" class="btn btn-primary text-2xl">Verify</button>
                <button class="btn btn-danger text-2xl">Resend OTP</button>
            </div>
        </form>
    </div>
</div>

<?php require approot . '/View/inc/footer.php'; ?>