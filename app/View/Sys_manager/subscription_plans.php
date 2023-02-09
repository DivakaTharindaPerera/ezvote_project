<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/ManagerNavbar.php'; ?>
<?php require approot . '/View/inc/manager_sidebar.php'; ?>

<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width , initial-scale=1.0">
    <title>subscription plan</title>
    <link rel="stylesheet" href="<?php echo urlroot; ?>/public/css/subscription_plans.css">
</head>

<body> -->

<div class="main-container">
    <div class="w-75 justify-content-center align-items-center">
    <div class="d-flex flex-column min-h-85 min-w-95"> 
    <h2 class="title">Subscription Plans</h2>
    <div class="d-flex justify-content-center align-items-center my-1">
    <a href="create_subscription">
        <button class="btn btn-primary my-1" type="button">
            Create new plan
        </button>
    </a>
    </div>


<!-- <a href="/ezvote/System_manager/dashboard">
    <div class="back-to">
        <img src="<?php echo urlroot; ?>/public/img/button.png" style="width: 50px; height: 50px; margin-left: 0px; margin-top: 0px;" />
    </div>
</a> -->
<div class="w-100">
    <div class="d-flex flex-column">
    <div class="d-flex justify-content-evenly ">
        <div class="justify-content-center border border-primary my-3 mr-1 min-w-50">
        <input type="text" id="searchPlan" style="height:100%;" onkeyup="myFunction()" placeholder="Search Plan......" class="w-100 h-100">
        </div>
        <div class="my-3 d-flex mr-5">
        <a href="#">
            <button class="btn btn-primary">SEARCH</button></a>
            <div class="d-flex text-center align-items-center text-md ml-2">FILTER
            </div>
        </div>
    </div>
    </div>
    

    <!-- <div class="filter-img">
        <img src="<?php echo urlroot; ?>/public/img/filter.png" />
    </div> -->

    <div>
        <table class="table border border-radius-2 border-primary w-95">
            <!-- <div class="my-1"> -->
                <tbody>

                <?php

                $i = 1;

                $arrlength = count($data, COUNT_RECURSIVE);

                for($x = 0; $x < $arrlength-1; $x++) {
                    echo '<tr>
                            <td class="td-1">'.$data[0][$x]->PlanName.'</td>
                            <td class="td-2">
                                    <label class="switch">
                                    <input type="checkbox" id="toggle-'.$i.'" onclick="myFunction'.$i.'()">
                                        <span class="slider round"></span>
                                    </label>
                                    <span id="myDIV-'.$i.'" class="enabled"> Enabled</span>
                                </td>
                                <td class="td-3"><a href="edit_subscription/'.$data[0][$x]->PlanID.'"> 

                                    <button class="btn btn-info ml-5">Details</button>
                                    </td></a>
                                    <td class="td-4">
                                    <button class="btn btn-danger mr-1" ">Delete</button>
                                    </td>
                            </tr>
                            
                            <script>
                                function myFunction'.$i.'() {
                                    var checkBox = document.getElementById("toggle-'.$i.'");
                                    var text = document.getElementById("myDIV-'.$i.'");
                                    if (checkBox.checked == false) {
                                        text.innerHTML = "Enabled";
                                    }else{
                                        text.innerHTML = "Disabled";
                                    }
                                }
                            </script>
                            ';
                    $i++;
                } ?>

                <!-- <script>
                    function toggleText() {
                        var x = document.getElementById("myDIV");
                        if (x.innerHTML === "Disabled") {
                            x.innerHTML = "Enabled";
                        } else {
                            x.innerHTML = "Disabled";
                        }
                    }
                </script> -->
                </tbody>
            <!-- </div> -->
        </table>
    </div>
    </div>
</div>
</div>
</div>
</div>

<script src="../public/js/search.js"></script>
<?php require approot . '/View/inc/footer.php'; ?>

<!-- </body>

</html> -->
