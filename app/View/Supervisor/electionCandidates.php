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
                    <h4 id="positionPlaceholder" class="m-1"></h4>
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
            <div id="popup-d" class="bg-secondary h-50 w-50 text-center" >
                
                <div class="d-flex flex-column">
                    <div class="d-flex fle m-1 p-1">
                     <input type="text" name="cName" id="cEditName">
                    </div>
                    <div class="d-flex m-1 p-1">
                     <input type="text" name="cEmail" id="cEditEmail">
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary w-15 h-10 m-1 p-1"><b>Update</b></button>               
                <button type="button" onclick="popupClose()" class="btn btn-danger w-15 h-10 p-1 m-1"><b>Cancel</b></button>
            </div>
            <div class="m-3 d-flex flex-column p-1 bg-blue-10 border-radius-2">
            <?php 
                foreach($data['positionRow'] as $position){
                    echo "<div class='bg-blue-10 text-white p-1'>
                        <div>
                            
                            <h3>". $position->positionName." -- ".$position->NoofOptions." Option(s)</h3>
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
                                        <a href='".urlroot."/Elections/removeCandidate/".$candidate->candidateId."/".$data['ID']."'><span class='icon mr-1'><i class='fa-sharp fa-solid fa-trash'></i></span></a>
                                        <a href='#' id='edit-btn'><span class='icon mr-1'><i class='fa-sharp fa-solid fa-pen'></i></span></a>
                                        <h4 class='mr-auto'>".$candidate->candidateName." - 
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

    function popupfunc(){
        document.getElementById('popup_window').className = "open-popup";
    }

    document.getElementById('edit-btn').addEventListener('click', (e)=>{
        e.preventDefault();
        document.getElementById('popup-d').style.display = "block";
    });

    function popupClose(){
        document.getElementById('popup-d').style.display = "none";
    }
</script>

<?php require approot . '/View/inc/footer.php'; ?>
