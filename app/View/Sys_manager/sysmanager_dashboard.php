<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/ManagerNavbar.php'; ?>
<?php require approot . '/View/inc/manager_sidebar.php'; ?>

    <script>

    window.onload = function(){
        var element = document.getElementById("home");
        element.classList.remove("active");

        var element = document.getElementById("dashboard");
        element.classList.add("active");
    }
    </script>

<div class="main-container">
    <div class="min-w-85 overflow-y overflow-x">
    <div class="title">Activities</div>
    <div class="w-90 h-50">
    <div class="w-100 h-50 d-flex flex-wrap justify-content-center align-items-center">

                        <?php

                        $arrlength = count($data, COUNT_RECURSIVE);

                        for($x = 0; $x < $arrlength-1; $x++){
                        echo ' 
                        <div class="card-pane justify-content-center align-items-center mt-1">
                        <div class="card">
                        <div class="header-title">'.$data[0][$x]-> Description.'</div>
                        <div class="mt-1 d-flex flex-column">
                            Date: '.$data[0][$x]-> Date .'
                            <a href="/ezvote/subscription_plan/edit_subscription/'.$data[0][$x]->PlanID.'"><div class="btn btn-info mt-1">DETAILS</div></a>
                       </div>
                    </div>
    </div>'; } ?>
   
        <!-- <table class="table border border-primary w-100 my-1">
            <tbody>
                <?//php
                //$arrlength = count($data, COUNT_RECURSIVE);

                // for($x = 0; $x < $arrlength-1; $x++) {
                //     echo '<tr>
                //         <td class="td-1"></td>
                //         <td class="td-2">'.$data[0][$x]-> Date .'</td>
                //         <td class="td-3"><a href="/ezvote/subscription_plan/edit_subscription/'.$data[0][$x]->PlanID.'">
                //             <button class="btn btn-info">DETAILS</button>
                //         </td></a>
                //     </tr>';
                //}
                 ?> -->
                </tbody>
                </table>
                </div>
                </div>
            </div>
    </div>
    </p>
</div>
<?php require approot . '/View/inc/footer.php'; ?>