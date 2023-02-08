<?php require approot.'/View/inc/header.php'; ?>
<?php
require approot.'/View/sysmanager_topnavbar.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create subscription</title>
    <link rel="stylesheet" href="<?php echo urlroot; ?>/public/css/create_subscription.css">
    <script src="../public/js/disableInput.js"></script>
</head>

<body>
<div class="text-box1" id="text-box1">
    <form class="sub-form" action="./create_process" method="POST">
        <label for="name">Name</label><br>
        <input class="text-x" type="text" id="name" name="name" placeholder="Name of the subscription plan"><br><br>

        <label for="description">Description</label><br>
        <input class="des-text" type="text" id="description" name="description" placeholder="Description of the subscription plan"><br><br>

        <div class="free-div">
            <input type="radio" id="free" name="duration" onclick="javascript:yesnoCheck();">
            <label for="free" id="lable-1">Free</label><br>
        </div>
        <div>
            <input type="radio" id="free-2" name="duration" onclick="javascript:yesnoCheck();" checked>
            <label id="lable-2" for="price">Price ($)</label>

            <input class="price-amount" type="text" id="price" name="price">

            <br>
            <hr>
            <br>
        </div>


        <div class="time-div">
            <input type="radio" id="time" name="time" onclick="javascript:yesnoCheckDate();">
            <label id="text-1" for="lifetime">Lifetime</label><br>
        </div>
        <input type="radio" id="time-2" name="time" onclick="javascript:yesnoCheckDate();" checked>
        <label id="text-2" for="duration">Duration</label>

        <label id="text-3" for="day">days</label>
        <input class="in-day" type="number" id="day" name="day">

        <label id="text-4" for="month">months</label>
        <input class="in-month" type="number" id="month" name="month">

        <label id="text-5" for="year">years</label>
        <input class="in-year" type="number" id="year" name="year">

        <br>

        <div class="limitation" id="limitation">
            <div class="textbox-2">
                <input type="checkbox" id="access" name="access" onclick="javascript:yesnoCheckAccess();">
                <label id="label-3" for="fullaccess">Full access</label>
            </div>
            <div id="div-access" class="box">
                <input type="checkbox" id="candidate" name="cand_limit"  onclick="javascript:disableInput1();">
                <label id="label-4" for="cand_limit">Limit No of Candidates per election</label>
                <input type="text" id="box-1" name="box-1" placeholder="enter limit....." disabled>
                <br><br>
                <hr>
                <br>

                <input type="checkbox" id="voter" name="voter_limit" onclick="javascript:disableInput2();">
                <label id="label-5" for="voter_limit">Limit No of voters per election</label>
                <input type="text" id="box-2" name="box-2" placeholder="enter limit....." disabled>
                <br><br>
                <hr>
                <br>

                <input type="checkbox" id="election" name="election_limit"  onclick="javascript:disableInput3();">
                <label id="label-6" for="election_limit">Limit No of active elections</label>
                <input type="text" id="box-3" name="box-3" placeholder="enter limit....." disabled>
                <br><br>
            </div>
        </div>

        </div>


        <div id="down">
            <button type="submit" class="create-btn">Create</button>

            <a href="../System_manager/dashboard">
                <button type="button" class="cancel-btn">Cancel</button>
            </a>
</div>
</form>
</body>

</html>
