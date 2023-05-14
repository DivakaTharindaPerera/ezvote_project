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
    <div class="title text-center text-uppercase">Edit Subscription Plan</div>
    <div class="min-w-85 border border-primary border-radius-2 border-3 px-1 py-1 mb-1 overflow-y">
    <form class="d-flex flex-column min-w-40 py-1 mb-1" action="../update_process/<?php echo $data[0]->PlanID ;?>" method="POST">
        <label class="font-bold" for="name">Name</label><br>
        <input class="border border-primary" type="text" id="name" name="name" value="<?php echo $data[0]->PlanName; ?>" placeholder="<?php echo $data[0]->PlanName ?>" required><br><br>

        <label class="font-bold" for="description">Description</label><br>
        <input class="h-100 border border-primary" type="long-text" id="description" value="<?php echo $data[0]->Description; ?>" name="description" placeholder="<?php echo $data[0]->Description ?>" required><br><br>

        <div class="free-div">
            <input type="radio" id="free" name="duration" onclick="javascript:yesnoCheck();">
            <label for="free" id="lable-1">Free</label>
        </div>
        <div>
            <input type="radio" id="free-2" name="duration" onclick="javascript:yesnoCheck();" checked>
            <label id="lable-2" for="price">Price (Rs)</label>
            <div class="w-20 border border-primary">
            <input class="w-100 h-50 px-1" style="padding-left: 0.5rem;" type="number" id="price" value="<?php echo $data[0]->Price ?>" name="price" placeholder="<?php echo $data[0]->Price ?>">
            </div>
        </div>

        <div class="mt-2">
            <label id="lable-2" for="price">Discount (%)</label>
            <div class="w-20 border border-primary">
            <input class="w-100 h-50 px-1" style="height:30%; padding-left: 0.5rem;" type="number" id="discount" name="discount" value="<?php echo $data[0]->Discount ?>" placeholder="<?php echo $data[0]->Discount ?>">
            </div>
            </div>

            <br>
            <hr>
            <br>
        

<div class="d-flex flex-column">
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
        <input class="w-100 bg-primary" style="padding-left:0.5rem;" type="number" min="0" max="31" id="day" value="<?php echo $data[0]->DurationDate ?>" name="day" placeholder="<?php echo $data[0]->DurationDate ?>">
        </div>

        <label id="text-4" for="month">months</label>
        <div class="border border-primary w-10">
        <input class="w-100 bg-primary" style="padding-left:0.5rem;" type="number" min="0" max="12" id="month" value="<?php echo $data[0]->DurationMonth ?>" name="month" placeholder="<?php echo $data[0]->DurationMonth ?>">
        </div>

        <label id="text-5" for="year">years</label>
        <div class="border border-primary w-10">
        <input class="w-100 bg-primary" style="padding-left:0.5rem;" type="number" min="0" id="year" value="<?php echo $data[0]->DurationYear ?>" name="year" placeholder="<?php echo $data[0]->DurationYear ?>">
        </div>

        <br>

        <div class="limitation" id="limitation">
            <div class="textbox-2">
                <input type="checkbox" id="access" name="access" onclick="javascript:yesnoCheckAccess()">
                <label id="label-3" for="fullaccess">Full access</label>
            </div>
            <div id="div-access" class="box mb-1">
                <input type="checkbox" id="candidate" name="cand_limit"  onclick="javascript:disableInput1();">
            
                <label id="label-4" for="cand_limit">Limit No of Candidates per election</label>
                <div class="w-25 border border-primary">
                <input type="text" id="box-1" value="<?php echo $data[0]->CandidateLimit ?>" name="box-1" placeholder="<?php echo $data[0]->CandidateLimit ?>" disabled>
                </div>
                <br><br>
                <hr>
                <br>

                <input type="checkbox" id="voter" name="voter_limit" onclick="javascript:disableInput2();">
                <label id="label-5" for="voter_limit">Limit No of voters per election</label>
                <div class="w-25 border border-primary">
                <input type="text" id="box-2" value="<?php echo $data[0]->VotersLimit ?>" name="box-2" placeholder="<?php echo $data[0]->VotersLimit ?>" disabled>
                </div>
                <br><br>
                <hr>
                <br>

                <input type="checkbox" id="election" name="election_limit"  onclick="javascript:disableInput3();">
                <label id="label-6" for="election_limit">Limit No of active elections</label>
                <div class="w-25 border border-primary">
                <input type="text" id="box-3" value="<?php echo $data[0]->ElectionLimit ?>" name="box-3" placeholder= "<?php echo $data[0]->ElectionLimit ?>" disabled>
                </div>
                <br><br>
            </div>
        </div>


        <div class="d-flex gap-4 justify-content-evenly">
            <div class="d-flex">
            <a href="../../System_manager/dashboard">
            <button type="button" class="btn btn-primary">CANCEL</button>
            </div>
            </a>
            <div class="d-flex">
                <button type="submit" class="btn btn-primary">SAVE</button>
            </div>
</div>
</form>
</div>
</div>
<script src="../../public/js/disableInput.js"></script>
<?php require approot . '/View/inc/footer.php'; ?>
