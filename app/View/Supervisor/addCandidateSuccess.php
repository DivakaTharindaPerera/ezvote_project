<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>
<?php require approot . '/View/inc/sidebar-new.php'; ?>

<div class="main-container">
    <div class="d-flex flex-column justify-content-center align-items-center bg-white-0-7 border-radius-2 shadow mt-5 mb-1">
        <h1 class="mx-2">Election created successfully</h1>
        <div class="d-flex">
            <img src="<?php echo urlroot?>/public/img/completed.png" alt="">
        </div>
        <a href="<?php echo urlroot?>/Pages/viewMyElections" class="btn btn-primary" style="margin-bottom: 1rem">Continue</a>
    </div>
</div>

<?php require approot . '/View/inc/footer.php'; ?>