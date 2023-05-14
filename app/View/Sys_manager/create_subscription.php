<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/ManagerNavbar.php'; ?>
<?php require approot . '/View/inc/manager_sidebar.php'; ?>

<script>

window.onload = function(){
    var element = document.getElementById("dashboard");
    element.classList.remove("active");

    var element = document.getElementById("plan");
    element.classList.add("active");
}
</script>

<div class="main-container" id="text-box1">
    <div class="title text-center text-uppercase">Create Subscription Plan</div>
    <div class="min-w-85 min-h-85 border border-primary border-radius-2 border-3 px-1 py-1 mb-1 overflow-y">
    <form class="d-flex flex-column min-w-40 py-1 mb-1 " action="./create_process" method="POST">
        <label for="name" class="font-bold">Name</label><br>
        <input class="h-100 border border-primary" type="text" id="name" name="name" placeholder="Name of the subscription plan" required><br><br>

        <label class="font-bold" for="description">Description</label><br>
        <input class="h-100 border border-primary" type="long-text" id="description" name="description" placeholder="Description of the subscription plan" required><br><br>

        <div class="free-div">
            <input type="radio" id="free" name="duration" onclick="javascript:yesnoCheck();">
            <label for="free" id="lable-1">Free</label>
        </div>
        <div>
            <input type="radio" id="free-2" name="duration" onclick="javascript:yesnoCheck();" checked>
            <label id="lable-2" for="price">Price (Rs)</label>
            <div class="w-20 border border-primary">
            <input class="w-100 h-50 px-1" style="padding-left: 0.5rem;" type="number" id="price" name="price">
            </div>

        </div>
            <div class="mt-2">
            <label id="lable-2" for="price">Discount (%)</label>
            <div class="w-20 border border-primary">
            <input class="w-100 h-50" style="height:30%; padding-left: 0.5rem;" type="number" id="discount" name="discount">
            </div>
            </div>


            <br>
            <hr>
            <br>

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
        <input class="w-100 bg-primary mb-1" style="padding-left:0.5rem;" type="number" min="0" max="31" id="day" name="day">
        </div>

        <label id="text-4" for="month">months</label>
        <div class="border border-primary w-10">
        <input class="w-100 bg-primary " style="padding-left:0.5rem;" type="number" min="0" max="12" id="month" name="month">
        </div>

        <label id="text-5" for="year">years</label>
        <div class="border border-primary w-10">
        <input class="w-100 bg-primary " style="padding-left:0.5rem;" type="number" min="0" id="year" name="year">
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
            <a href="../System_manager/dashboard">
            <button type="button" class="btn btn-primary">CANCEL</button>
            </a>
            </div>
            <div class="d-flex">
                <button type="submit" class="btn btn-primary">CREATE</button>
            </div>
            
</div>
</form>
</div>
</div>
<script src="../public/js/disableInput.js"></script>
<?php require approot . '/View/inc/footer.php'; ?>

