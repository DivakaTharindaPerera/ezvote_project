<?php
require approot.'/View/inc/VoterHeader.php';
require approot . '/View/inc/AuthNavbar.php';
?>
    <div class="m-5 border-2 border-dark p-5 border-radius-5" style="box-shadow: 5px 10px #888888">
    <img src="<?php echo urlroot; ?>/img/welcome/success.png" alt="success" style="padding-left:55vh;">
        <div class="stripe">

        <form action="<?php echo urlroot; ?>/Pages/dashboard" method="POST">

        <h1 class="text-center">Party Request Sent Successfully</h1>
        </div>
        <br>
        <p class="text-center">Congratulations, your party request application <br>has been successfully submitted.
        We will inform you if the request is accepted or rejected by the party owner via email.
        </p>

        <button type="submit" class="btn bg-primary text-white m-2 text-3xl" style="margin-left:45vh;" id="continue">Continue <img src="<?php echo urlroot; ?>/img/welcome/next.png"></button>
        </form>

    </div>

    <?php require approot.'/View/inc/footer.php';?>