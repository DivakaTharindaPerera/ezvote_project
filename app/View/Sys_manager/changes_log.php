<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/ManagerNavbar.php'; ?>
<?php require approot . '/View/inc/manager_sidebar.php'; ?>

<script>

window.onload = function(){
    var element = document.getElementById("home");
    element.classList.remove("active");

    var element = document.getElementById("changelog");
    element.classList.add("active");
}
</script>

<div class="main-container">
    <div class="title text-center">Changes Log</div>
    <div class="min-w-85 min-h-85">
        <div class="w-100 h-50 justify-content-center align-items-center">
            <table class="table border border-primary w-90 h-50 ml-2 mt-2 overflow-scroll">
                <thead>
                    <tr class="h-75">
                        <th>Plan ID</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Description</th>
                    </tr>
                </thead>

                <tbody>

                <?php

                $arrlength = count($data);

                for($x = 0; $x < $arrlength; $x++){
            
                   echo '<tr>
                        <td class="td-1">'.$data[$x]->PlanID.'</td>
                        <td class="td-2">'.$data[$x]->Date.'</td>
                        <td class="td-3">'.$data[$x]->Time.'</td>
                        <td class="td-4">'.$data[$x]->Description.'</td>
                    </tr>';} ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>

<?php require approot . '/View/inc/footer.php'; ?>