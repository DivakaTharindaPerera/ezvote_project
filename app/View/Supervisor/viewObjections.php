<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>
<?php require approot . '/View/inc/sidebar-new.php'; ?>
<div class="main-container">
    <div id="taskbar" class="d-flex flex-column w-100 bg-blue-1" style="border-bottom-left-radius: 20px; border-bottom-right-radius: 20px; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.4);">
        <div class="d-flex">
            <div id="buttons" class="m-1 mr-auto">
                <a href="<?php echo urlroot ?>/Pages/ViewMyElection/<?php echo $data['ID'] ?>" class="btn btn-danger card-hover min-h-90"><i class="fa-solid fa-angles-left"></i><span class="ml-1">Back</span></a>
            </div>
        </div>
    </div>
    <div id="objectionArea" class="d-flex flex-wrap w-100 bg-secondary overflow-scroll justify-content-center p-1 mt-1 mb-1">
        <?php

        foreach ($data['candidates'] as $candidate) {
            $count = 0;
            foreach ($data['objections'] as $objection) {
                if ($candidate->candidateId == $objection->CandidateID) {
                    $count++;
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
            }
        ?>
            <div class="popup-window-1 bg-secondary min-h-30 min-w-45 text-center border-1 border-radius-2" id="popup-<?php echo $candidate->candidateId; ?>" style="display: none;">
                <div class="popup-window-1-content bg-light border-radius-2 p-2">
                    <?php 
                        foreach($data['objections'] as $objection){
                            if($candidate->candidateId == $objection->CandidateID){
                    ?>
                        <div class="w-100 d-flex flex-column my-1 border-radius-2">
                            <div class="w-100 bg-primary border-radius-2 px-1 d-flex text-white">
                                <div class="text-x mr-auto my-auto">Subject...</div>
                                <div class="ml-auto my-auto"><button id="<?php echo $objection->ObjectionID ?>" class="btn bg-primary text-white text-x" onclick="expandDiv(this.id)"><i class="fa-solid fa-angle-right"></i></button></div>
                            </div>
                            <div class="w-100 border-radius-2 my-1" style="display: none;" id="expand-<?php echo $objection->ObjectionID; ?>" >
                                
                            </div>
                        </div>
                    <?php 
                            }
                        }

                    ?>
                    <div>
                        <button class="btn btn-danger my-1"><b>Remove Candidate</b></button>
                        <button class="btn btn-danger my-1"><b>Remove Objection</b></button>
                    </div>
                    <div>
                        <button class="btn btn-primary my-1" id="<?php echo $candidate->candidateId; ?>" onclick="objectionPopUp(this.id)"><b>Cancel</b></button>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>

<script>
    function objectionPopUp(id) {
        var popup = document.getElementById("popup-" + id);

        if (popup.style.display === "none") {
            popup.style.display = "block";
            document.querySelector('body').classList.add('no-scroll-for-popup');
        } else {
            popup.style.display = "none";
            document.querySelector('body').classList.remove('no-scroll-for-popup');
        }
    }
    function expandDiv(id){
        var elementDiv = document.getElementById("expand-" + id);
        var elementButton = document.getElementById(id);
        if(elementDiv.style.display === "none"){
            elementDiv.style.display = "block";
            elementButton.innerHTML = '<i class="fa-solid fa-angle-down"></i>';
            var others = elementButton.parentNode.parent
        }else{
            elementDiv.style.display = "none";
            elementButton.innerHTML = '<i class="fa-solid fa-angle-right"></i>';
        }
    }
</script>
<?php require approot . '/View/inc/footer.php'; ?>