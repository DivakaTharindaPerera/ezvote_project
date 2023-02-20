<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>
<?php require approot.'/View/inc/sidebar-new.php';?>

    <div class="main-container">
        <div class="h-80 overflow-scroll w-100" >
            <div class="m-3 d-flex">
                <a href="<?php echo urlroot; ?>/Pages/viewMyElection/<?php echo $data['ID'];?>" class="btn btn-danger m-2">Back To Election</a>
                
            </div>
            <div class="m-3 w-50 ml-auto mr-auto" id='formForCandidate' style="display: none;" >
                <form action="<?php echo urlroot; ?>/Elections/addSingleCandidate" method="POST">
                    <input type="hidden" name="id" value="<?php echo $data['ID']; ?>">
                    <input type="hidden" name="positionId"id='positionId' >
                    <h4 id="positionPlaceholder"></h4>
                    <div class="m-1">
                        <input type="email" name="candidateEmail" placeholder="Candidate email..." required >
                    </div>
                    <div class="m-1">
                        <input type="text" name="candidateName" placeholder="Candidate Name..." required>
                    </div>
                    <div class="m-1">
                        Party:  
                        <select name="party" id="partyList" class="bg-secondary border border-1 border-radius-1 w-25 text-right px-1">
                            <?php
                                foreach($data['partyRow'] as $party){
                                    echo "<option value='".$party->partyId."'>".$party->partyName."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary m-1 w-10">Add</button>
                        <button type="button" class="btn btn-danger m-1 w-10" onclick="cancel()">Cancel</button>
                    </div>
                </form>
            </div>
            <div class="m-3 d-flex flex-column p-1">
            <?php 
                foreach($data['positionRow'] as $position){
                    echo "<div class='bg-blue-10 text-white p-1'>
                        <div>
                            <h3>".$position->ID."-". $position->positionName." -- ".$position->NoofOptions." Option(s)</h3>
                            <div class='text-center'>
                            <input type='hidden' value='".$position->positionName."'>
                            <button class='btn btn-primary m-1' id='".$position->ID."' onclick='addCandidate(this.id)'><b>Add Candidate</b></button>
                            <div class='d-flex'>
                                <h3> Name </h3>
                                <h3 class='ml-auto'> Party
                            </div>
                            </div>
                        </div>
                        <div>";
                            $i =0;
                            foreach($data['candidateRow'] as $candidate){
                                
                                if($candidate->positionId == $position->ID){
                                    $i++;
                                    echo "<div class='d-flex bg-orange-10 m-1 p-1 border-radius-2'>
                                        <h4 class='mr-auto'>".$i." ".$candidate->candidateName." - 
                                        ".$candidate->description."
                                        image</h4>
                                        <h4 class='ml-auto'>";
                                        foreach($data['partyRow'] as $party){
                                            if($party->partyId == $candidate->partyId){
                                                echo $party->partyName;
                                            }
                                        }
                                        echo "</h4>
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

<script>
    function addCandidate(id){
        document.getElementById("positionId").value = id;
        positionName = document.getElementById(id).parentNode.getElementsByTagName("input")[0].value;
        document.getElementById('positionPlaceholder').innerHTML ="Position : "+ positionName;
        document.getElementById('formForCandidate').style.display = "block";
        document.getElementById('formForCandidate').getElementsByTagName('input')[2].focus();
    }

    function cancel(){
        document.getElementById('formForCandidate').style.display = "none";
    }
</script>

<?php require approot . '/View/inc/footer.php'; ?>
