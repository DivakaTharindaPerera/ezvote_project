<?php
require approot.'/View/inc/VoterHeader.php';
require approot . '/View/inc/AuthNavbar.php';
require approot . '/View/inc/sidebar-new.php';
?>

<div class="main-container">
    <div class="my-auto border-2 p-5" style="box-shadow:5px 10px #888888;">
    <div class="bg-danger">
    <h1><i class="fas fa-triangle-exclamation" style="padding-left:5rem;"></i></h1>
    </div>

        <div class="stripe">
        <form action="<?php echo urlroot; ?>/Pages/dashboard" method="POST">
        <br>
        <p class="text-center">You are not allowed to <br>access party requests</p>
        <button type="submit" class="btn bg-danger text-white m-2 text-md" style="" id="continue">
        <div class="d-flex">
        Continue 
        <img src="<?php echo urlroot; ?>/img/welcome/next.png" style="margin-left:5px;"></button>
        </div>
        </form>
</div>  
</div>

<?php require approot.'/View/inc/footer.php';?>