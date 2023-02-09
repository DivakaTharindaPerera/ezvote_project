
<?php require approot.'/View/inc/VoterHeader.php';?>
<?php require approot.'/View/inc/AuthNavbar.php';?>
<?php require approot.'/View/inc/sidebar-new.php'?>
<?php

            $data = [
                    'names' => ['basic', 'premium', 'enterprise','basic', 'premium', 'enterprise','basic', 'premium', 'enterprise'],
                    'prices' => [100, 200, 300,100, 200, 300,100, 200, 300],
                    'desc' => ['This is the basic plan', 'This is the premium plan', 'This is the enterprise plan','This is the basic plan', 'This is the premium plan', 'This is the enterprise plan','This is the basic plan', 'This is the premium plan', 'This is the enterprise plan']
            
            ];

            ?>

        
            
<div class="main-container">
<!--        <div class="text-center">-->
            <div class="d-flex flex-column my-1">
                <div>
                    <?php

                    if(isset($_SESSION['plan'])) {
                        echo '<h3 class="text-center">You are currently subscribed to '.$_SESSION['plan'].' plan</h3>';
                    } else {
                        echo '<h3 class="text-center text-danger">You are currently not subscribed to any plan</h3>';
                    }

                    ?>
                </div>

                <div class="text-xl text-center">Choose a plan from below that suits you</div>
            </div>
            <div id="plans" class="subsplans d-flex flex-wrap mb-2 mx-2">
                <?php 
                    foreach($data['names'] as $key => $name) {
                        echo '<div class="card card-hover m-2 bg-info text-center border-radius-2">
                                <div class="sub-title">
                                    '.$name.'
                                </div>
                                <div class="text-xl text-danger ">
                                    $'.$data['prices'][$key].'
                                </div>
                                <div class="text-md ">
                                    '.$data['desc'][$key].'
                                </div>
                                <div class="d-flex justify-content-center m-1">

                                    <a href="#" class="btn btn-primary">Subscribe</a>
                                </div>
                            </div>';
                    }
                ?>
            </div>

<!--            <div class="d-flex justify-content-center align-items-center">-->
<!--                <a href="#" class="btn btn-radius-2 btn-info w-20">Cancel</a>-->
<!--            </div>-->

<?php require approot . '/View/inc/footer.php'; ?>


