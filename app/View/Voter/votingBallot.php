<?php
//echo '<pre>';
//print_r ($data['candidates']);
//exit();
?>
<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>
<?php require approot . '/View/inc/sidebar-new.php'; ?>

<div class="main-container">

    <div class="title justify-content-center mt-1"><?php echo $data['election']->Title ?><br>By <?php echo $data['election']->OrganizationName ?></div>
    <div class="justify-content-center">
        <div class="border border-radius-2 border-white border-2 p-1">
            <div class="justify-content-center align-items-center text-center text-xl mb-1">Description & Regulation</div>
            <p class="text-lg"><?php echo $data['election']->Description; ?></p>
        </div>
    </div>
    <div class="d-flex flex-column w-100" id="candidatesWithPositions">
        <?php $i = 0;
        //            $voted=array();
        foreach ($data['positions'] as $position) {
            $position_id = $position->ID;
        ?>
            <div class="d-flex flex-column" id="<?php echo $position_id; ?>">
                <div class="title w-100 bg-info p-1" style="color: white;"><?php echo $position->positionName; ?></div>
                <div class="text-danger text-center text-2xl">
                    <span class="optionCounts">
                        <?php
                        echo $position->NoofOptions . " ";
                        ?>
                    </span>
                    option(s) available

                </div>
                <div class="d-flex justify-content-center flex-wrap">
                    <?php foreach ($data['candidates'] as $candidates) {
                        $user_id = $candidates->userId;
                        foreach ($data['users'] as $user){
//                            echo '<pre>';
//                            var_dump($user);
//                            var_dump($user_id);
//                            exit();
                            if($user->UserId==$user_id){
                                $profile_picture=$user->ProfilePicture;
                                break;
                            }
                        }
                        if ($candidates->positionId == $position_id) {
                            $i = $i + 1; ?>
                            <div class="card" id="card-<?php echo $candidates->candidateId; ?>">
                                <div class="d-flex flex-column">
                                    <div class="sub-title">
                                        <?php echo $candidates->candidateName; ?>
                                    </div>
                                    <div><img src="<?= $profile_picture?>" style="max-height:50px;max-width: 50px" alt="profile photo"></div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <div class="text-lg">
                                        <?php
                                        $flag = 0;
                                        foreach ($data['parties'] as $party) {
                                            if ($party->ID == $candidates->partyId) {
                                                echo $party->partyName;
                                                $flag = 1;
                                                break;
                                            }
                                        }
                                        if ($flag == 0) {
                                            echo "--No Party--";
                                        }
                                        ?>
                                    </div>
                                    <!-- <div class="text-lg">BraveIo</div> -->
                                </div>
                                <div class="d-flex justify-content-center mb-1 mt-1">
                                    <button class="btn btn-primary min-w-50 card-hover text-x" id="<?php echo $position_id; ?>-<?php echo $candidates->candidateId; ?>" onclick="voteMarked(this.id)"><b>Vote</b></button>
                                    <!--                            --><?php //array_push($voted,)
                                                                        ?>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    <?php } ?>


                </div>
            </div>
        <?php } ?>
        <div id="submitBtn" class="justify-content-center text-center m-2">
            <button class="btn btn-primary min-w-20 text-2xl text-uppercase card-hover" onclick="submitVote()">Submit</button>
            <button class="btn btn-danger min-w-20 text-2xl text-uppercase ml-1 card-hover" onclick="resetVotes()">Reset</button>
        </div>
    </div>
    <div id="confirmDiv" class="w-100" style="display: none;">
        <div class="">
            <div class="title w-100 " style="color: red;">Confirm Your Votes</div>
            <div class="title w-100 p-1"><span id="optionsRemaining" class="my-1" style="color: red;"></span></div>
            <div id="finalVotes">
                <?php
                foreach ($data['positions'] as $position) {
                ?>
                    <div id="<?php echo $position->ID ?>-confirm">
                        <div class="title w-100 bg-blue-10 p-1" style="color: white;"><?php echo $position->positionName; ?></div>
                        <div class="d-flex justify-content-center flex-wrap" id="finalCandidates-<?php echo $position->ID?>"></div>
                    </div>

                <?php
                }
                ?>
            </div>
            <form action="<?php echo urlroot;?>/Votings/saveVotes" method="POST" id="finalData" class="m-1 text-center">
                <input type="hidden" name="voterId" value="<?php echo $data['voter']->voterId; ?>">
                <input type="hidden" name="electionId" value="<?php echo $data['election']->ElectionId; ?>">
                <input type="hidden" name="cCount" value="" id="candidateCount">
                <button type="submit" class="btn btn-primary text-2xl"><b>CONFIRM</b></button>
                <button type="button" class="btn btn-danger text-2xl" onclick="recast()"><b>RECAST</b></button>
            </form>
        </div>
    </div>
</div>

<script>
    var c = 0;
    function voteMarked(id) {
        console.log(id);
        var idArray = id.split("-");
        var positionId = idArray[0];
        var candidateId = idArray[1];

        var cardId = "card-" + candidateId;

        var card = document.getElementById(cardId);
        var cardBtn = document.getElementById(id);

        var position = document.getElementById(positionId);
        var noOfOptionsElement = position.getElementsByTagName("div")[1].getElementsByTagName("span")[0];
        var noOfOptions = noOfOptionsElement.innerHTML;

        if (cardBtn.classList.contains("btn-primary")) {
            cardBtn.classList.remove("btn-primary");
            cardBtn.classList.add("btn-danger");
            cardBtn.innerHTML = "Unvote";

            noOfOptions = parseInt(noOfOptions) - 1;
            //console.log(noOfOptions);

            if (noOfOptions <= 0) {
                var btns = position.getElementsByTagName("button");
                for (var i = 0; i < btns.length; i++) {
                    if (btns[i].classList.contains("btn-primary")) {
                        btns[i].disabled = true;
                        btns[i].style.cursor = "not-allowed";
                        btns[i].style.opacity = "0.5";

                    }
                }
            }

            card1 = card.cloneNode(true);
            card1.getElementsByTagName("button")[0].style.display = "none";
            card1.setAttribute('id',candidateId+'-voted');
            document.getElementById('finalCandidates-'+positionId).appendChild(card1);

            c++;
            var data = document.createElement("input");
            data.setAttribute("hidden", "text");
            data.setAttribute("name", "candidate"+c);
            data.setAttribute("value", candidateId);
            data.setAttribute("id", candidateId+"-data");
            document.getElementById("finalData").appendChild(data);

        } else {
            cardBtn.classList.remove("btn-danger");
            cardBtn.classList.add("btn-primary");
            cardBtn.innerHTML = "Vote";

            if (noOfOptions <= 0) {
                var btns = position.getElementsByTagName("button");
                for (var i = 0; i < btns.length; i++) {
                    if (btns[i].classList.contains("btn-primary")) {
                        btns[i].disabled = false;
                        btns[i].style.cursor = "pointer";
                        btns[i].style.opacity = "1";
                    }
                }
            }

            noOfOptions = parseInt(noOfOptions) + 1;
            c--;
            document.getElementById('finalCandidates-'+positionId).removeChild(document.getElementById(candidateId+'-voted'));
            document.getElementById("finalData").removeChild(document.getElementById(candidateId+"-data"));

        }

        noOfOptionsElement.innerHTML = noOfOptions;


    }

    function resetVotes() {
        location.reload();
    }

    function submitVote() {
        document.getElementById("candidatesWithPositions").style.display = "none";
        document.getElementById("confirmDiv").style.display = "block";
        var counts = document.getElementsByClassName("optionCounts");

        for (var i = 0; i < counts.length; i++) {
            var count = counts[i].innerHTML;
            if (count > 0) {
                document.getElementById("optionsRemaining").innerHTML = "You have unspent votes remaining!!";
                console.log(count);
                break;
                
            }else{
                document.getElementById("optionsRemaining").innerHTML = "";
            }
        }
        document.getElementById("candidateCount").value = c;
        // document.getElementById("confirmDiv").style.display = "block";
        // document.querySelector('body').classList.add('no-scroll-for-popup');
    }

    function recast() {
        document.getElementById("candidatesWithPositions").style.display = "block";
        document.getElementById("confirmDiv").style.display = "none";
        // document.getElementById("confirmDiv").style.display = "none";
        // document.querySelector('body').classList.remove('no-scroll-for-popup');
    }
</script>

<?php require approot . '/View/inc/footer.php'; ?>