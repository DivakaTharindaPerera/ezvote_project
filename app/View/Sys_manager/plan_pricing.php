<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/ManagerNavbar.php'; ?>
<?php require approot . '/View/inc/manager_sidebar.php'; ?>

<script>

window.onload = function(){
    var element = document.getElementById("home");
    element.classList.remove("active");

    var element = document.getElementById("pricing");
    element.classList.add("active");
}
</script>
<script>
    const p1 = '<span class="my-1">Self Nomination</span><br> <span class="my-1">Unlimited Users</span><br> <span class="my-1">Unlimited elections</span><br> <span class="my-1">Conference Options</span><br> <span class="my-1">Objection Submission</span><br>';
    const p2 = '<span class="my-1">Limited Voters up to 200</span><br> <span class="my-1">Limited candidates up to 30</span><br> <span class="my-1">Limited elections up to 10</span><br> <span class="my-1">Conference Options</span><br> <span class="my-1">Objection Submission</span><br>';
    const p3 = '<span class="my-1">Limited Voters up to 200</span><br> <span class="my-1">Limited candidates up to 30</span><br> <span class="my-1">Limited elections up to 5</span><br> <span class="my-1">Conference Options</span><br> <span class="my-1">Objection Submission</span><br>'
    const p4 = '<span class="my-1">Limited Voters up to 100</span><br><span class="my-1">Limited candidates up to 20</span><br> <span class="my-1">Limited elections up to 3</span><br> <span class="my-1">Objection Submission</span><br>';
    const p5 = '<span class="my-1">Limited Voters up to 50</span><br> <span class="my-1">Limited candidates up to 10</span><br> <span class="my-1">Limited elections up to 1</span><br> <span class="my-1">Objection Submission</span><br>'
</script>

<div class="main-container">
<div class="min-w-85 min-h-85">
<div class="w-100 h-50 overflow-y overflow-x ">
    <div class="title text-center text-uppercase">Plan Pricing</div>
       
    <div class="w-100 h-50 d-flex flex-wrap justify-content-center align-items-center overflow-y overflow-x">
                    
                        <?php

                        $arrlength = count($data, COUNT_RECURSIVE);

                        for($x = 0; $x < $arrlength; $x++){
                        echo ' 
                        <div class="card-pane justify-content-center align-items-center mt-1">
                        <div class="card">
                        <div class="header-title text-uppercase">'.$data[$x]-> PlanName.'</div>
                        <div class="mt-1 d-flex flex-column">
                            Price: '."$ ".' '.$data[$x]-> Price .' '; ?>

                           
                                <div class="dialog-box-outer" id="popup">
                                    <div class="popup w-30 h-70 mx-1 my-1 px-1 py-1 min-w-20 min-h-25">
                                        <div class="my-2 text font-bold text-3xl text-center text-uppercase" id="plan2"></div>
                                        <div class="my-2 text text-center text-6xl font-bold" id="price"></div>
                                        <div class="my-2 text-center leading-normal text-xl" id="pop-up-content">
                                           
                                        </div> 
                                        <div class="d-flex flex-row mx-5 my-2 justify-content-evenly">
                                            <div class="justify-content-evenly" onclick="closePopup()">
                                                <button type="button" class="btn btn-primary ml-2">CANCEL</button>
                                            </div>
                                            <div class="justify-content-evenly">
                                                <div><a href="./payment"><button type="button" class="btn btn-primary ml-5">SUBSCRIBE</button></a></div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                       </div>
                       <button type="button" class="btn btn-primary mt-1 text-uppercase" onclick="<?php 
                       if ($data[$x]-> PlanName == 'extreme plan') {?>
                            document.getElementById('pop-up-content').innerHTML=p1;
                       <?php } ?>

                       <?php if ($data[$x]-> PlanName == 'annual plan') { ?>
                            document.getElementById('pop-up-content').innerHTML=p2;
                       <?php } ?>

                       <?php if ($data[$x]-> PlanName == 'monthly plan') { ?>
                            document.getElementById('pop-up-content').innerHTML=p3;
                       <?php } ?>

                       <?php if ($data[$x]-> PlanName == 'starter plan') { ?>
                            document.getElementById('pop-up-content').innerHTML=p4;
                       <?php } ?>

                       <?php if ($data[$x]-> PlanName == 'free plan') { ?>
                            document.getElementById('pop-up-content').innerHTML=p5;
                       <?php } ?>
                       
                       document.getElementById('price').innerHTML='<?php echo '$ '?> <?php echo $data[$x]-> Price ?> <?php echo '/ Month'?> '; 
                       document.getElementById('plan2').innerHTML='<?php echo $data[$x]-> PlanName ?>'; openPopup();">More Details</button>
                    </div>
    </div> <?php } ?>       

            </div>
        </div>
</div>


<script src="/ezvote/public/js/main.js"></script>
<?php require approot . '/View/inc/footer.php'; ?>
