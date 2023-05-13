<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>
<?php require approot . '/View/inc/sidebar-new.php' ?>

<div class="main-container">
    <div class="d-flex flex-column my-1">
        <div>
            <?php

            if (isset($_SESSION['plan'])) {
                echo '<h3 class="text-center">You are currently subscribed to ' . $_SESSION['plan'] . ' plan</h3>';
            } else {
                echo '<h3 class="text-center text-danger">You are currently not subscribed to any plan</h3>
                        <div class="text-xl text-center">Choose a plan from below that suits you</div>
                        ';
            }

            ?>
        </div>


    </div>
    <div id="plans" class="subsplans d-flex flex-wrap m-2">
        <?php 
            foreach($data['plans'] as $plan){
            ?>
                <div class="card">
                    <div class="text-xl mt-1"><?php echo $plan->PlanName; ?></div>
                    <div class="mt-auto"><?php echo $plan->Price; ?>$</div>
                    <div class="mt-1 mb-1"><button class="btn btn-primary card-hover"><b>Subscribe</b></button></div>
                </div>
            <?php
            }
        ?>
    </div>
</div>


<?php require approot . '/View/inc/footer.php'; ?>