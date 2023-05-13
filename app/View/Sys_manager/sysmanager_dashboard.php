<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/ManagerNavbar.php'; ?>
<?php require approot . '/View/inc/manager_sidebar.php'; ?>


<div class="main-container">
    <div class="min-w-85 overflow-y overflow-x">
    <div class="title text-uppercase">Recent Activities</div>
    
    <div class="w-100 h-50 d-flex flex-wrap justify-content-center align-items-center">
        <div class="d-flex flex-wrap justify-content-center align-items-center ">


                    <?php

                        $arrlength = count($data, COUNT_RECURSIVE);

                        for($x = 0; $x < $arrlength-1; $x++){
                        echo ' 
                        <div class="card-pane justify-content-center align-items-center mt-1">
                        <div class="card">
                        <div class="text-center text-black text-lg font-bold text-uppercase">'.$data[0][$x]-> Description.'</div>
                        <div class="mt-1 d-flex flex-column">
                            Date: '.$data[0][$x]-> Date .'
                            <a href="/ezvote/subscription_plan/edit_subscription/'.$data[0][$x]-> PlanID.'"><div class="btn btn-info mt-1">DETAILS</div></a>
                       </div>
                    </div>
                </div>'; } ?>
             </div>
            
        </div>
    </div>
    
</div>
<?php require approot . '/View/inc/footer.php'; ?>