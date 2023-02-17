<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>
<?php require approot.'/View/inc/sidebar-new.php';?>

    <div class="main-container">
        <div class="h-100" >
            <div class="m-3 d-flex">
                <a href="<?php echo urlroot; ?>/Pages/viewMyElection/<?php echo $data['ID'];?>" class="btn btn-danger m-2">Back To Election</a>
                <button class="btn btn-primary m-2">Add Candidate</button>
            </div>
            <div class="m-3 d-flex flex-column">
                <form action="" method="POST">
                    <input type="hidden" name="id">
                    <div class="m-1">
                        <input type="text" placeholder="Candidate email..." >
                    </div>
                    <div class="m-1">
                        <input type="text" placeholder="Candidate Name..." >
                    </div>
                </form>
            </div>
            <div class="m-3 d-flex flex-column">
            <?php 
                foreach($data['positionRow'] as $position){
                    echo "<div class='bg-blue-10 text-white'>
                        <div>
                            <h3>".$position->positionName."</h3>
                        </div>
                        <div>";
                            $i =0;
                            foreach($data['candidateRow'] as $candidate){
                                
                                if($candidate->positionId == $position->ID){
                                    $i++;
                                    echo "<div class='bg-orange-10 m-1'>
                                        <h4 class>".$i." ".$candidate->candidateName." - 
                                        ".$candidate->description."
                                        image</h4>
                                        </div>";
                                }
                            }
                        
                      echo "</div>
                    </div>";
                }
            ?>
            </div>
        </div> 
    </div>
<?php require approot . '/View/inc/footer.php'; ?>
