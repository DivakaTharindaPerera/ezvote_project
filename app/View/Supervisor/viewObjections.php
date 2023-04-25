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
        if (empty($data['objections'])) {
            echo "<h1 class='text-center text-danger mt-5'>No Objections</h1>";
        }
        foreach ($data['objections'] as $objectionRow) {
        ?>
            <div class="popup-window-1 bg-secondary min-h-30 min-w-30 text-center border-1 border-radius-2" id="popup-<?php echo $objectionRow->ObjectionID; ?>" style="display: none;">
                <div class="popup-window-1-content bg-light border-radius-2 p-2">
                    <div class="title"><?php echo $objectionRow->Subject; ?></div>
                    <div class="text-x"><?php echo $objectionRow->Description; ?></div>
                    <div class="text-xl my-1">
                        Objection By: <b>
                            <?php
                            foreach ($data['voters'] as $voter) {
                                if ($voter->voterId == $objectionRow->VoterID) {
                                    echo $voter->Name;
                                }
                            }
                            ?>
                        </b>
                    </div>
                    <div class="text-xl my-1">
                        Against: <b>
                            <?php
                            foreach ($data['candidates'] as $candidateRow) {
                                if ($candidateRow->candidateId == $objectionRow->CandidateID) {
                                    echo $candidateRow->candidateName;
                                }
                            }
                            ?>
                        </b>
                    </div>
                    <div>
                        <button class="btn btn-primary my-1" id="<?php echo $objectionRow->ObjectionID; ?>" onclick="objectionPopUp(this.id)"><b>Cancel</b></button>
                        <button class="btn btn-danger my-1"><b>Remove Candidate</b></button>
                        <button class="btn btn-danger my-1"><b>Remove Objection</b></button>
                    </div>
                </div>
            </div>
            <div class="card">
                <h3 class="mt-1"><?php echo $objectionRow->Subject; ?></h3>
                <?php
                foreach ($data['candidates'] as $candidateRow) {
                    if ($candidateRow->candidateId == $objectionRow->CandidateID) {
                        echo "<div class='text-xl mt-auto text-primary'><b>" . $candidateRow->candidateName . "</b></div>";
                    }
                }
                ?>
                <button id="<?php echo $objectionRow->ObjectionID; ?>" class="border-none border-radius-5 text-2xl w-45 h-25 mt-auto mb-1 mx-auto bg-primary text-white" style="cursor: pointer;" onclick="objectionPopUp(this.id)"><i class="fa-solid fa-eye"></i></button>
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
</script>
<?php require approot . '/View/inc/footer.php'; ?>