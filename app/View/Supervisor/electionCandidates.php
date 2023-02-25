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
                <form action="<?php echo urlroot ?>/Elections/updateCandidate" method="post">
                    <div class="d-flex flex-column">
                        <input type="hidden" name="id" value="<?php echo $data['ID'] ?>">
                        <input type="hidden" name="cId" id="cEditId">
                        <div class="d-flex fle m-1 p-1">
                        <label for="cName" class="text-xl">Name: </label><input type="text" name="cName" id="cEditName">
                        </div>
                        <div class="d-flex m-1 p-1">
                        <label for="cEmail" class="text-xl">Email: </label> <input type="text" name="cEmail" id="cEditEmail">
                        </div>
                        <div class="m-1">
                        Party:  
                        <select name="cParty" id="cEditPartyList" class="bg-secondary border border-1 border-radius-1 w-25 text-right px-1">
                            <?php
                                foreach($data['partyRow'] as $party){
                                    echo "<option value='".$party->partyId."'>".$party->partyName."</option>";
                                }
                            ?>
                        </select>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-15 h-10 m-1 p-1"><b>Update</b></button>               
                    <button type="button" onclick="popupClose()" class="btn btn-danger w-15 h-10 p-1 m-1"><b>Cancel</b></button>
                </form>
            </div>
            <div class="m-3 d-flex flex-column p-1 border-radius-2">
            <?php 
                foreach($data['positionRow'] as $position){
                    echo "<div class=' bg-blue-1 border-radius-2 border-1 text-black p-1 m-1'>
                        <div>
                            
                            <div class='d-flex text-center'>
                                <input type='hidden' value='".$position->ID."'>
                                <input type='hidden' value='".$position->positionName."'>
                                
                                <button class='btn btn-primary m-1 ml-auto' id='".$position->ID."' onclick='editPosition(this.id)'><i class='fa-sharp fa-solid fa-pen'></i></button>

                                <h3 class='text-underline mt-2' >". $position->positionName." -- ".$position->NoofOptions." Option(s)</h3>
                                <button class='btn btn-danger m-1 mr-auto' id='".$position->ID."' onclick='deletePosition(this.id)'><i class='fa-sharp fa-solid fa-trash'></i></button>
                            </div>
                            
                            <div class='text-center'>
                            
                            <input type='hidden' value='".$position->positionName."'>
                            <button class='btn btn-primary m-1' id='".$position->ID."' onclick='addCandidate(this.id)'><b>Add Candidate</b></button>
                            </div>

                        </div>
                        <div class='d-flex flex-wrap'>";
                            $i =0;
                            foreach($data['candidateRow'] as $candidate){
                                
                                if($candidate->positionId == $position->ID){
                                    $i++;
                                    echo "<div class='card' id='$candidate->candidateId'>
                                        <input type='hidden' value='".$candidate->candidateId."'>
                                        <input type='hidden' value='".$candidate->candidateEmail."'>
                                        
                                        <div class='d-flex flex-column'>
                                            <div class='sub-title text-dark' id='cName".$candidate->candidateId."'>".$candidate->candidateName."</div>
                                            <div><img src='/ezvote/public/img/profile.jpg' style='max-height:50px;max-width: 50px' alt='profile photo'></div>
                                        </div>
                                        
                                        <div class='d-flex justify-content-center text-black'>
                                        <div>Party: &nbsp;</div>
                                        ";
                                        foreach($data['partyRow'] as $party){
                                            if($party->partyId == $candidate->partyId){
                                                echo "<input type='hidden' value='".$candidate->partyId."'>";
                                                echo $party->partyName;
                                            }
                                        }
                                    echo "</div>
                                        <div class='d-flex text-center'>
                                        <a href='".urlroot."/Elections/removeCandidate/".$candidate->candidateId."/".$data['ID']."' class='btn btn-danger m-1 ml-auto'><i class='fa-sharp fa-solid fa-trash'></i></a>
                                        <button class='btn btn-primary m-1 mr-auto' id='".$candidate->candidateId."' onclick='popupfunc(this.id)'><i class='fa-sharp fa-solid fa-pen'></i></button>
    
                                        </div>
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

    function popupfunc(id){
        var d = document.getElementById(id);
        var cId = d.getElementsByTagName("input")[0].value;
        var cName = document.getElementById("cName"+cId).innerHTML;
        var cEmail = d.getElementsByTagName("input")[1].value;
        var cParty = d.getElementsByTagName("input")[2].value;

        document.getElementById('cEditId').value = cId;
        document.getElementById('cEditName').value = cName;
        document.getElementById('cEditEmail').value = cEmail;

        document.getElementById('cEditPartyList').value = cParty;

        document.getElementById('popup-d').style.display = "block";
    }


    function popupClose(){
        document.getElementById('popup-d').style.display = "none";
    }
</script>

<?php require approot . '/View/inc/footer.php'; ?>
