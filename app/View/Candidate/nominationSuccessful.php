<?php
require approot.'/View/inc/VoterHeader.php';
require approot . '/View/inc/AuthNavbar.php';
?>
    <div class="m-5 border-2 border-dark p-5 border-radius-5" style="box-shadow: 5px 10px #888888">
    <img src="<?php echo urlroot; ?>/img/welcome/success.png" alt="success" style="padding-left:150px;">
        <div class="stripe">

        <!-- ********************** -->
        <form action="<?php echo urlroot; ?>/Pages/dashboard" method="POST">
        <!-- <form action="index.php?controller=Election&action=view" method="POST"> -->

        <h1>Nomination Successful</h1>
        </div>
        <br>
        <p class="text-center">Congratulations, your nomination application <br>has been successfully submitted.</p>
        <button type="submit" class="btn bg-primary text-white m-2 text-3xl" style="margin-left:85px;" id="continue">Continue <img src="<?php echo urlroot; ?>/img/welcome/next.png"></button>
        </form>

    </div>

    <?php require approot.'/View/inc/footer.php';?>