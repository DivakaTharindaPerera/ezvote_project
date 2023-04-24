<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>

<div class="border-1 bg-light p-3">
    <div id="form">
        <form action="<?php echo urlroot;?>/Votings/otpVerify" method="post">
            <h3 class="text-center">An OTP has sent to your email [<?php echo $data['email'];?>]</h3>
            <h3 class="text-center">Please enter the OTP to verify yourself</h3>
            <div id="error" class="mr-1 ml-1 mb-1 mt-3 text-center">
                <span id='error' class="text-danger text-2xl">
                    <?php
                    if (isset($data['error'])) {
                        echo $data['error'];
                    }
                    ?>
                </span>
            </div>

            <div id="inputs" class="m-1">
                <input type="text" name="otp" placeholder="Enter OTP...." required style="border-radius: 20px; padding-left: 15px;">
                <input type="hidden" name="eid" value="<?php echo $data['eid']?>">
                <input type="hidden" name="email" value="<?php echo $data['email']?>">
            </div>
            <div id="buttons" class="m-1 text-center">
                <button type="submit" name="submit" class="btn btn-primary text-2xl">Verify</button>
                <a href="<?php echo urlroot?>/Pages/dashboard" class="btn btn-danger text-2xl">Cancel</a>
                <br><br>

                <button type="button" class="btn btn-primary text-2xl" id="resendBtn" onclick="ck()">Resend OTP</button>
            </div>
        </form>
        <form action="<?php echo urlroot;?>/Pages/castVotePrologue" method="POST" id="resendForm">
            <input type="hidden" name="eid" value="<?php echo $data['eid']; ?>">
        </form>
    </div>
</div>

<script>
    //timing function
    document.getElementById("resendBtn").disabled = true;
    document.getElementById("resendBtn").style.cursor = "not-allowed";
    document.getElementById("resendBtn").style.opacity = "0.5";
    document.getElementById("resendBtn").innerHTML = "Resend OTP (5m 0s)";
    
    var mins = 300000;
    setInterval(function(){
        mins = mins - 1000;
        if(mins >= 0){
            var minutes = Math.floor(mins/60000);
            var secs = Math.floor((mins%60000)/1000);

            document.getElementById("resendBtn").innerHTML = "Resend OTP ("+minutes+"m " + secs+ "s)";
        }
        if(mins == 0){
            document.getElementById("resendBtn").disabled = false;
            document.getElementById("resendBtn").style.cursor = "pointer";
            document.getElementById("resendBtn").style.opacity = "1";
            document.getElementById("resendBtn").innerHTML = "Resend OTP";
        }
    },1000); 
    
    
    //end of the timing function

    function ck(){
        window.alert("OTP has sent to your email");
        document.getElementById("resendForm").submit();
    }
</script>

<?php require approot . '/View/inc/footer.php'; ?>