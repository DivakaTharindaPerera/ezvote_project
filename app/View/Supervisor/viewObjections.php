<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>
<?php require approot . '/View/inc/sidebar-new.php'; ?>
<div class="main-container h-100">
    <div id="objectionArea" class="d-flex flex-wrap w-100 bg-white overflow-scroll justify-content-center h-75 p-1">
        <?php 
            foreach($data['objectionRow'] as $objectionRow){
        ?>
            <div class="card">
                <h4><?php echo $objectionRow->Subject; ?></h4>
                <p><?php echo $objectionRow->Description; ?></p>
                <?php 
                    foreach($data['candidateRow'] as $candidateRow){
                        if($candidateRow->candidateId == $objectionRow->CandidateID){
                            echo "<p> Candidate: " . $candidateRow->candidateName. "</p>";
                        }
                    }
                ?>
                <?php 
                    foreach($data['users'] as $user){
                        if($objectionRow->VoterID == $user->UserId){
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
