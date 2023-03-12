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
        if (empty($data['objectionRow'])) {
            echo "<h1 class='text-center text-danger mt-5'>No Objections</h1>";
        }
        foreach ($data['objectionRow'] as $objectionRow) {
        ?>
            <div class="card">
                <h4><?php echo $objectionRow->Subject; ?></h4>
                <p><?php echo $objectionRow->Description; ?></p>
                <?php
                foreach ($data['candidateRow'] as $candidateRow) {
                    if ($candidateRow->candidateId == $objectionRow->CandidateID) {
                        echo "<p> Candidate: " . $candidateRow->candidateName . "</p>";
                    }
                }
                ?>
                <?php
                foreach ($data['users'] as $user) {
                    if ($objectionRow->VoterID == $user->UserId) {
                        echo "<p> Voter: " . $user->Fname . " " . $user->Lname . "</p>";
                    }
                }

                ?>
            </div>
        <?php
        }
        ?>
    </div>
</div>
<?php require approot . '/View/inc/footer.php'; ?>