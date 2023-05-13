<?php
require approot . '/View/inc/VoterHeader.php';
require approot . '/View/inc/AuthNavbar.php';
require approot . '/View/inc/sidebar-new.php';

?>

<div class="main-container">
    <div id="Election" class="w-95 align-center d-flex flex-column p-1 ">
        <div class="d-flex flex-column w-75 justify-content-start align-items-center">
            <div class="title"><?= $data['election']->Title ?></div>
            <div id="desc-reg" class="w-50 d-flex flex-column px-1 align-items-center bg-white border-radius-2">
                <div class="sub-title">
                    Description & Regulation
                </div>
                <div id="regulations" class="mt-1">
                    <?= $data['election']->Description ?>
                    <!--                    <ol>-->
                    <!--                        --><?php //foreach ($data->Description as $row){
                                                    ?>
                    <!--                        <li>--><?php //= $row
                                                        ?>
                    <!--</li>-->
                    <!--                    </ol>-->
                </div>
                <div class="d-flex mt-1">
                    <div><input type="checkbox" onchange="accepted()" id="rules"></div>
                    <div class="mx-1">
                        I agree for above rules and regulations.
                    </div>
                </div>
            </div>
        </div>
        <div id="content" class="flex-column w-100 ">
            <div id="scheduled" class="mt-1 d-flex justify-content-evenly">
                <div id="from" class="card">
                    <div class="justify-content-center sub-title mb-1">Commencing</div>
                    <div class="mb-1">
                        <?= $data['election']->StartDate ?>
                    </div>
                    <div class="justify-content-start mb-1">
                        &emsp14;Time:<?= $data['election']->StartTime ?>
                    </div>
                    <!--                From : <span>01/02/2023   18.30 </span>-->
                </div>
                <div class="d-flex justify-content-center align-items-center"> <img src="<?php echo urlroot; ?>/public/img/right-arrow.png" alt="" style="max-height: 100px; max-width: 100px"></div>
                <div id="to" class="card">
                    <div class="justify-content-center sub-title mb-1">Ending</div>
                    <div class=" mb-1">
                        Date:<?= $data['election']->EndDate ?>
                    </div>
                    <div class="justify-content-start mb-1">
                        &emsp14;Time:<?= $data['election']->EndTime ?>
                    </div>
                    <!--                To : <span>01/02/2023   20.30 </span>-->
                </div>
            </div>
            <div id="data" class="d-flex flex-column justify-content-center align-items-center mt-1 border-primary border-2 border-radius-1 mx-5">
                <div id="self-nomination" class="d-flex text-lg text-center">
                    <div class="text-center">Self Nomination :</div>
                    <div class="d-flex text-lg text-primary">
                        <?php if ($data['election']->SelfNomination == 1) { ?>
                            <!--                        <img src="--><?php //echo urlroot;
                                                                        ?>
                            <!--/public/img/on.png" alt="" style="max-width: 40px;max-height: 40px">-->
                            ON
                        <?php } else { ?>
                            <!--                        <img src="--><?php //echo urlroot;
                                                                        ?>
                            <!--/public/img/off.png" alt="" style="max-width: 40px;max-height: 40px">-->
                            OFF
                        <?php } ?>
                    </div>
                </div>
                <div id="self-nomination" class="d-flex text-lg ">
                    <div class="text-center">Visibility of Statistics For Voters and Candidates: </div>
                    <div class="d-flex text-lg text-primary">
                        <?php if ($data['election']->StatVisibality == 1) { ?>
                            ON
                        <?php } else { ?>
                            OFF
                        <?php } ?>
                    </div>
                    <!--                        <img src="--><?php //echo urlroot;
                                                                ?>
                    <!--/public/img/off.png" alt="" style="max-width: 40px;max-height: 40px"> </div>-->
                </div>
            </div>
          

<!-- <?php 
if(!empty($result)){
if($result[0]->status == 1){ 
?>
    <div class="title">
        Apply Nomination
    <br><br>
    <button onclick="location.href='/ezvote/Candidates/applyNomination?id=<?= $data['election']->ElectionId ?>'" class="btn btn-primary">Apply</button>
    </div>

<?php }else{ ?>
    <div class="title">
        Apply Party
    <br><br>
    <button onclick="location.href='/ezvote/Candidates/applyParty/<?= $data['election']->ElectionId ?>'" class="btn btn-success">Apply</button>
    </div>

    <div class="title bg-danger border-radius-2">
    <i class="fas fa-info-circle"></i>
        <p class="text-white">You have to apply for the party first.</p>      
    </div>

<?php 
}
}else{ 
?>
    <div class="title">
        Apply Party
        <br><br>
        <button onclick="location.href='/ezvote/Candidates/applyParty/<?= $data['election']->ElectionId ?>'" class="btn btn-success">Apply</button>
    </div>

    <div class="title bg-danger">
        <p class="text-white">You have to apply for the party first.</p> 
    </div>

<?php }?> -->
    <div id="candidates" class="d-flex flex-column w-100">
        <div class="title">
            Candidates
        </div>

                <div id="competitors" class="d-flex flex-wrap w-100">
                    <?php foreach ($data['positions'] as $position) {
                        $position_id = $position->ID; ?>
                        <div id="positions" class="d-flex w-100 flex-wrap mb-2" style="gap: 2rem">
                            <div id="president" class="d-flex flex-column w-45" style="gap: 0.2rem">
                                <div class="sub-title"><?= $position->positionName ?></div>
                                <?php $i = 0;
                                foreach ($data['candidates'] as $candidate) {
                                    if ($candidate->positionId == $position_id) {
                                        $i = $i + 1; ?>
                                        <div id="candidate" class="d-flex align-center bg-white justify-content-between border-2" style="padding: 0.4rem;border-radius: 20px; width:100vh;">
                                            <div id="can-det" class="d-flex" style="gap: 0.5rem">
                                                <div id="can-ID" class="font-bold"><?= $i ?></div>
                                                <div id="can-Name"><?= $candidate->candidateName ?></div>
                                            </div>
                                            <div id="btn-panel" class="mr-1">
                                            <?php
                                                if($candidate->candidateId == $candidate_id){
                                                ?>
                                                <button class=" btn btn-primary" onclick="location.href='/ezvote/Candidates/discussionForum/<?= $data['election']->ElectionId ?>/<?= $candidate->candidateId ?>/<?= $voter_id ?>'">Q & A</button>
                                                <?php } ?>
                                                <?php
                                                if($candidate->candidateId != $candidate_id){
                                                ?>
                                                <button class=" btn btn-primary" onclick="makeObjection(<?= $candidate->candidateId ?>)">Make Objection</button>
                                                
                                                <button class="btn btn-primary" onclick="viewObjections(<?= $candidate->candidateId ?>,<?= $data['election']->ElectionId ?>)">View Objection</button>
                                                <?php 
                                                
                                                }else {
                                                    
                                                }?>

                                                <button class="btn btn-primary" onclick="location.href='/ezvote/Candidates/candidateProfile/<?= $candidate->candidateId ?>'">View Profile</button>

                                            </div>

                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <div class="popup-window-1 bg-secondary text-center border-1 border-radius-2" id="popupSubmission">
        <div class="popup-window-1-content bg-light border-radius-2 p-2 d-flex flex-column">
            <div class="title">Make Objection</div>
            <form action="/ezvote/Voters/submitObjection" method="POST" class="d-flex flex-column my-1 px-1 align-items-flex-start" id="Objection_form">
                <input type="text" name="candidateId" value="">
                <input type="text" name="electionId" value="<?php echo $data['election']->ElectionId; ?>">
                <div class="d-flex flex-column justify-content-center my-1 w-100">
                    <label for="Subject" class="mr-1 text-left text-md">Subject</label>
                    <input id="Subject" type="text" class="border-1" style="width:100%" name="Subject" required>
                </div>
                <div class="d-flex flex-column my-1 w-100">
                    <label for="Description" class="mr-1 text-left text-md">Description</label>
                    <textarea id="Description" class="border-1" name="Description" style="height: 150px;width: 100%" required></textarea>
                </div>
                <!--                                                <div>-->
                <input type="hidden" name="CandidateID" value="" id="CandidateID">
                <!--                                                </div>-->
                <div class="d-flex justify-content-between my-1 w-100">
                    <div><button class="btn btn-danger px-1" onclick="makeObjection()" id="close" type="reset">Cancel</div>
                    <div><button class="btn btn-primary px-1" type="submit">Submit</div>
                </div>
            </form>
        </div>
    </div>
    <a href="/ezvote/Pages/addConference/<?= $data['election']->ElectionId ?>">Schedule a meeting</a>

</div>
<script>
    function makeObjection(id = null) {
        var popup = document.getElementById('popupSubmission');
        if (popup.style.display == "none" || popup.style.display == "") {
            popup.style.display = "block";
            popup.getElementsByTagName('input')[0].value = id;
            document.querySelector('body').classList.add('no-scroll-for-popup');
        }else{
            popup.style.display = "none";
            document.querySelector('body').classList.remove('no-scroll-for-popup');
        }
        console.log(id);
    }
</script>
<?php require approot . '/View/inc/footer.php'; ?>