<?php require approot.'/View/inc/header.php'; ?>
<?php
require approot.'/View/sysmanager_topnavbar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width , initial-scale=1.0">
    <title>subscription plan</title>
    <link rel="stylesheet" href="<?php echo urlroot; ?>/public/css/subscription_plans.css">
    <script src="../public/js/search.js"></script>
</head>

<body>

<div class="plan">
    <h2>Subscription Plans</h2>
    <a href="create_subscription">
        <button type="button">
            Create new plan
        </button>
    </a>
</div><br>

<a href="/ezvote/System_manager/dashboard">
    <div class="back-to">
        <img src="<?php echo urlroot; ?>/public/img/button.png" />
    </div>
</a>
<div>
    <p>
    <div class="search">
        <img src="<?php echo urlroot; ?>/public/img/search.png">
        <input type="text" id="searchPlan" onkeyup="myFunction()" placeholder="Search Plan......">
        <a href="#">
            <button>SEARCH</button>
            <label>FILTER</label>
        </a>
    </div><br>

    <div class="filter-img">
        <img src="<?php echo urlroot; ?>/public/img/filter.png" />
    </div>

    <div class="plan-box1">
        <table>
            <div class="table-dash">
                <tbody>
                <!-- <tr>
                    <td class="td-1">Annual plan [$99.99]</td>
                    <td class="td-2">
                        <label class="switch">
                            <input type="checkbox" id="toggle" onclick="myFunction()">
                            <span class="slider round"></span>

                        </label>
                        <span id="myDIV" class="enabled"> Enabled</span>
                    </td>
                    <td class="td-3">
                    <a href="edit_subscription.php">
                    <button>Details</button>
                    </a>
                </td>
                </tr>
                <script>
                    function myFunction() {
                        var checkBox = document.getElementById("toggle");
                        var text = document.getElementById("myDIV");
                        if (checkBox.checked == false) {
                            text.innerHTML = "Enabled";
                        }else{
                            text.innerHTML = "Disabled";
                        }
                    }
                </script> -->
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

                                    <button class="delete" style="background: #C30000">Delete</button>
                                    <button>Details</button>
                                    </td></a>
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
            </div>
        </table>
    </div>
    </p>
</div>

</body>

</html>
