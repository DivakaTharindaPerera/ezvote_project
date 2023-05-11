<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>
<?php require approot . '/View/inc/sidebar-new.php'; ?>
<div class="main-container">
    <input type="hidden" name="" id="eid" value="<?php echo $data['ID']; ?>">
    <div id="taskbar" class="d-flex flex-column w-100 bg-light" style="border-bottom-left-radius: 20px; border-bottom-right-radius: 20px; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.4);">
        <div class="d-flex">
            <div id="buttons" class="m-1 mr-auto">
                <a href="<?php echo urlroot ?>/Pages/ViewMyElection/<?php echo $data['ID'] ?>" class="btn btn-danger card-hover min-h-90"><i class="fa-solid fa-angles-left"></i><span class="ml-1">Back</span></a>
            </div>
        </div>
    </div>
    <div id="positions" class="d-flex flex-column justify-content-center w-100 my-1">
        <?php

        foreach ($data['positions'] as $position) {
        ?>
            <div class="w-90 mx-auto">
                <div class="text-4xl text-white bg-blue-10 p-1 border-radius-10 text-center w-100 m-1">
                    <?php echo $position->positionName; ?>
                </div>
                <div class="w-100 d-flex flex-wrap justify-content-center">

                    <?php
                    $flag = 0;
                    foreach ($data['candidates'] as $candidate) {
                        if ($candidate->positionId == $position->ID) {
                            $count = 0;
                            foreach ($data['objections'] as $objection) {
                                if ($candidate->candidateId == $objection->CandidateID) {
                                    $count++;
                                    $flag = 1;
                                }
                            }
                            if ($count > 0) {
                    ?>
                                <div class="card d-flex flex-column">
                                    <div class="sub-title mb-auto mt-1">
                                        <?php
                                        echo $candidate->candidateName;
                                        ?>
                                    </div>
                                    <div class="text-danger my-1 text-xl">
                                        <?php echo $count; ?> objection(s)
                                    </div>
                                    <div>
                                        <button id="<?php echo $candidate->candidateId; ?>" class="border-none border-radius-5 text-2xl w-45 h-75 mt-auto mb-1 mx-auto bg-primary text-white" style="cursor: pointer;" onclick="objectionPopUp(this.id)"><i class="fa-solid fa-eye"></i></button>
                                    </div>
                                </div>
                                <?php

                                ?>
                                <div class="popup-window-1 bg-secondary text-center border-1 border-radius-2" id="popup-<?php echo $candidate->candidateId; ?>" style="display: none;">
                                    <div class="popup-window-1-content bg-light border-radius-2 p-2 d-flex flex-column w-50 h-75">
                                        <div>
                                            <div class="text-2xl"><a href="<?php echo urlroot ?>/Pages/viewCandidate/<?php echo $candidate->candidateId; ?>" target="_blank"><?php echo $candidate->candidateName; ?></a></div>
                                        </div>
                                        <div class="d-flex flex-column overflow-scroll">
                                            <div class="w-100">
                                                <?php
                                                foreach ($data['objections'] as $objection) {
                                                    if ($candidate->candidateId == $objection->CandidateID) {

                                                ?>
                                                        <div class="w-100 d-flex flex-column my-1 border-radius-2 bg-primary">
                                                            <div class="w-100 bg-blue-10 border-radius-2 px-1 d-flex text-white">
                                                                <div class="text-x mr-auto my-auto"><?php echo $objection->ObjectionID; ?><?php echo $objection->Subject; ?></div>
                                                                <input type="hidden" value="<?php echo $objection->ObjectionID; ?>" class="objection-<?php echo $candidate->candidateId ?>">
                                                                <div class="my-auto ml-auto" style="color: red;" id="status-<?php echo $objection->ObjectionID; ?>">
                                                                    <?php
                                                                    if ($objection->inspected == 0) {
                                                                        echo 'New!';
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <div class="my-auto"><button id="<?php echo $objection->ObjectionID ?>" class="btn bg-blue-10 text-white text-x" onclick="expandDiv(this.id)"><i class="fa-solid fa-angle-right"></i></button></div>
                                                            </div>
                                                            <div class="w-100 border-radius-2 my-1 mx-1 text-white " style="display: none;" id="expand-<?php echo $objection->ObjectionID; ?>">
                                                                <p>
                                                                    <?php echo $objection->Description; ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                <?php
                                                    }
                                                }
                                                ?>

                                            </div>

                                        </div>
                                        <div class="mt-auto mx-auto">
                                            <button id="del-<?php echo $candidate->candidateId; ?>" class="btn btn-danger ml-auto mr-2 card-hover" onclick="removeCand(this.id,'<?= $candidate->candidateName; ?>')"><b>Remove Candidate</b></button>
                                            <button class="btn btn-danger mr-auto card-hover"><b>Remove Objections</b></button>
                                        </div>
                                        <div>
                                            <button class="btn btn-primary my-1" id="<?php echo $candidate->candidateId; ?>" onclick="objectionPopUp(this.id)"><b>Cancel</b></button>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        }
                    }
                    if ($flag == 0) {
                        ?>
                        <div class="text-2xl text-danger my-1">
                            <b>No objections to show</b>
                        </div>
                <?php
                    }
                }
                ?>
                </div>
            </div>
    </div>
    <div class="popup-window-1 bg-secondary text-center border-1 border-radius-2" id="deletePopUp" style="display: none;">
        <div class="popup-window-1-content bg-light border-radius-2 p-2 d-flex flex-column">
            <div class="text-2xl text-danger">Confirm Deleting Candidate </div>
            <div class="text-2xl text-primary mb-1" id="candidateDeleteName"></div>
            <div class="text-xl text-danger mb-1">This action cannot be undone after confirming</div>
            <form action="<?php echo urlroot; ?>/Elections/removeCanidateFromObjections" method="POST" id="deleteForm">
                <input type="text" id="candidateDelete" name="cid" value="">
                <button type="submit" class="btn btn-danger mt-1 text-xl">Confirm</button>
                <button type="button" class="btn btn-primary mt-1 text-xl" onclick="removeCand()">Cancel</button>
            </form>
        </div>
    </div>
</div>

<script>
    var eid = document.getElementById('eid').value;

    var selectedPositions = [];

    function objectionPopUp(id) {
        var popup = document.getElementById("popup-" + id);

        if (popup.style.display === "none") {
            popup.style.display = "block";
            document.querySelector('body').classList.add('no-scroll-for-popup');
        } else {
            popup.style.display = "none";
            document.querySelector('body').classList.remove('no-scroll-for-popup');

            var others = document.querySelectorAll('div[id*="expand-"]');

            for (let element of others) {
                if (element.id != "expand-" + id) {
                    element.style.display = "none";
                    element.parentElement.querySelectorAll('button')[0].innerHTML = '<i class="fa-solid fa-angle-right"></i>';
                }
            }
        }
    }

    function selectPosition(id) {
        if (document.getElementById(id).parentElement.parentElement.classList.contains('bg-blue-10')) {
            selectedPositions.push(id);
            document.getElementById(id).parentElement.parentElement.classList.remove('bg-blue-10');
            document.getElementById(id).parentElement.parentElement.classList.add('bg-danger');
            document.getElementById(id).classList.add('text-danger');
            document.getElementById(id).classList.remove('text-primary');
        } else {
            for (i = 0; i < selectedPositions.length; i++) {
                if (selectedPositions[i] == id) {
                    selectedPositions.splice(i, 1);
                }
            }
            document.getElementById(id).parentElement.parentElement.classList.add('bg-blue-10');
            document.getElementById(id).parentElement.parentElement.classList.remove('bg-danger');
            document.getElementById(id).classList.remove('text-danger');
            document.getElementById(id).classList.add('text-primary');
        }
        console.log(selectedPositions);
        if (selectedPositions.length > 0) {
            document.getElementById('removePositions').disabled = false;
            document.getElementById('removePositions').classList.remove('border-1');
            document.getElementById('removePositions').classList.add('btn-danger');
            document.getElementById('removePositions').classList.add('card-hover');
        }
    }

    function removeCand(id = null, name = null) {
        if (id != null) {
            id = id.split('-')[1];
            document.getElementById('candidateDelete').value = id;
        }
        if (name != null) {
            document.getElementById('candidateDeleteName').innerHTML = "<b>"+name + " ?</b>";
        }else{
            document.getElementById('candidateDeleteName').innerHTML = "";
        }
        var popup = document.getElementById('deletePopUp');
        if (popup.style.display === "none") {
            popup.style.display = "block";
            document.querySelector('body').classList.add('no-scroll-for-popup');
        } else {
            popup.style.display = "none";
            document.querySelector('body').classList.remove('no-scroll-for-popup');
        }
    }

    function expandDiv(id) {
        var elementDiv = document.getElementById("expand-" + id);
        var elementButton = document.getElementById(id);
        if (elementDiv.style.display === "none") {
            elementDiv.style.display = "block";
            elementButton.innerHTML = '<i class="fa-solid fa-angle-down"></i>';
            // var others = elementButton.parentNode.parentNode.parentNode.childNodes;
            // for(let i = 0; i < others.length; i++){
            //     others[i].childNodes[1].style.display = "none";
            // }

            fetch('<?php echo urlroot ?>/Elections/objectionSeen/' + id, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id: id
                })
            }).then(response => {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error('Something went wrong');
                }
            }).then(data => {
                var msg = data.msg;
                console.log(msg);

                if (msg == 'success') {
                    document.getElementById('status-' + id).innerHTML = '';
                } else {
                    console.log(msg);
                }
            }).catch(error => {
                console.error('Error:', error);
                console.log(error.message);
            });

            var others = document.querySelectorAll('div[id*="expand-"]');

            for (let element of others) {
                if (element.id != "expand-" + id) {
                    element.style.display = "none";
                    element.parentElement.querySelectorAll('button')[0].innerHTML = '<i class="fa-solid fa-angle-right"></i>';
                }
            }


        } else {
            elementDiv.style.display = "none";
            elementButton.innerHTML = '<i class="fa-solid fa-angle-right"></i>';
        }
    }
</script>
<?php require approot . '/View/inc/footer.php'; ?>