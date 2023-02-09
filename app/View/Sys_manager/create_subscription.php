<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/ManagerNavbar.php'; ?>
<?php require approot . '/View/inc/manager_sidebar.php'; ?>

<!-- <!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create subscription</title>
    <link rel="stylesheet" href="<?php echo urlroot; ?>/public/css/create_subscription.css">
    <script src="../public/js/disableInput.js"></script>
</head> -->

<!-- <body> -->
<div class="main-container" id="text-box1">
    <div class="title text-center">Create subscription Plan</div>
    <div class="min-w-85 min-h-85">
    <form class="d-flex flex-column min-w-40 py-1 mb-1 " action="./create_process" method="POST">
        <label for="name">Name</label><br>
        <input class="h-100 min-w-40 border border-primary" type="text" id="name" name="name" placeholder="Name of the subscription plan"><br><br>

        <label for="description">Description</label><br>
        <input class="h-100 border border-primary" type="description" id="description" name="description" placeholder="Description of the subscription plan"><br><br>

        <div class="free-div">
            <input type="radio" id="free" name="duration" onclick="javascript:yesnoCheck();">
            <label for="free" id="lable-1">Free</label>
        </div>
        <div>
            <input type="radio" id="free-2" name="duration" onclick="javascript:yesnoCheck();" checked>
            <label id="lable-2" for="price">Price ($)</label>
            <div class="w-10">
            <input class="w-5 h-5 border border-primary" type="text" id="price" name="price">
            </div>


            <br>
            <hr>
            <br>
        </div>

<div class="d-flex flex-column my-1">
<div class="time-div">
            <input type="radio" id="time" name="time" onclick="javascript:yesnoCheckDate();">
            <label id="text-1" for="lifetime">Lifetime</label><br>
        </div>
        <div>
        <input type="radio" id="time-2" name="time" onclick="javascript:yesnoCheckDate();" checked>
        <label id="text-2" for="duration">Duration</label>
        </div>
</div>
        
        

        <label id="text-3" for="day">days</label>
        <div class="border border-primary w-10">
        <input class="w-100 bg-primary mb-1" type="number" id="day" name="day">
        </div>

        <label id="text-4" for="month">months</label>
        <div class="border border-primary w-10">
        <input class="w-100 bg-primary" type="number" id="month" name="month">
        </div>

        <label id="text-5" for="year">years</label>
        <div class="border border-primary w-10">
        <input class="w-100 bg-primary" type="number" id="year" name="year">
        </div>

        <br>

        <div class="limitation" id="limitation">
            <div class="textbox-2">
                <input type="checkbox" id="access" name="access" onclick="javascript:yesnoCheckAccess();">
                <label id="label-3" for="fullaccess">Full access</label>
            </div>
            <div id="div-access" class="box">
                <input type="checkbox" id="candidate" name="cand_limit"  onclick="javascript:disableInput1();">
            
                <label id="label-4" for="cand_limit">Limit No of Candidates per election</label>
                <div class="w-25 border border-primary">
                <input type="text" id="box-1" name="box-1" placeholder="enter limit....." disabled>
                </div>
                <br><br>
                <hr>
                <br>

                <input type="checkbox" id="voter" name="voter_limit" onclick="javascript:disableInput2();">
                <label id="label-5" for="voter_limit">Limit No of voters per election</label>
                <div class="w-25 border border-primary">
                <input type="text" id="box-2" name="box-2" placeholder="enter limit....." disabled>
                </div>
                <br><br>
                <hr>
                <br>

                <input type="checkbox" id="election" name="election_limit"  onclick="javascript:disableInput3();">
                <label id="label-6" for="election_limit">Limit No of active elections</label>
                <div class="w-25 border border-primary">
                <input type="text" id="box-3" name="box-3" placeholder="enter limit....." disabled>
                </div>
                <br><br>
            </div>
        </div>



        <div class="d-flex gap-4 justify-center-end justify-content-evenly">
            <div class="d-flex">
            <button type="submit" class="btn btn-primary">Create</button>

            </div>
            <div class="d-flex">
            <a href="../System_manager/dashboard">
                <button type="button" class="btn btn-primary">Cancel</button>
            </a>
            </div>
            
</div>
</form>
</div>
</div>
<script src="../public/js/disableInput.js"></script>
<?php require approot . '/View/inc/footer.php'; ?>

<!-- </body></html> -->
