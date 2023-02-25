<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>
<?php require approot.'/View/inc/sidebar-new.php';?>

    <div class="main-container">
        <div class="h-80 overflow-scroll w-100" >
            <div class="m-3 d-flex">
                <a href="<?php echo urlroot; ?>/Pages/viewMyElection/<?php echo $data['ID'];?>" class="btn btn-danger m-2 text-xl">Back To Election</a>
                <button class="btn btn-primary m-2" onclick="addPositionVisible()"><b class="text-xl"><i class="mt-auto mr-1 fa-solid fa-plus"></i>Add New Position</b></button>
            </div>

            <!-- alert of successful position insertion -->
            <div id="positionAddingSuccess" class="popup-window bg-secondary h-50 w-50 text-center">
                <div class="m-3">
                    <h3 class="text-success">Position Added Successfully</h3>
                    <button class="btn btn-primary" id="<?php echo $data['ID']?>" onclick="funcDone(this.id)">OK</button>
                </div>
            </div>

            <div class="m-3 w-50 ml-auto mr-auto border-1 p-1 border-radius-2" id='formForPosition' style="display: none;" >
                <form action="" method="POST">
                    <input type="hidden" name="id" value="<?php echo $data['ID']; ?>">
                    <div class="m-1">
                        <span class="text-danger">
                            
                        </span>
                    </div>
                    <div class="m-1">
                        <input type="text" name="positionName" placeholder="Position Name..." required>
                    </div>
                    <div>
                        <textarea name="positionDesc" id="" cols="30" rows="10" placeholder="Position Description..." required></textarea>
                    </div>
                    <div class="m-1">
                        No of options: <input type="number" class="border-1 p-2" name="noOfOptions" placeholder="No of Options..." value="1" min="1">
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" id="addPositionBtn" class="btn btn-primary m-1 min-w-15"><b>Add</b></button>
                        <button type="button" class="btn btn-danger m-1 min-w-15 text-center" onclick="cancel()"><b>Cancel</b></button>
                    </div>
                </form>
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
            <div id="popup-d" class="popup-window bg-secondary h-50 w-50 text-center" >
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
            
            

            <div id="popup-delete-position" class="popup-window bg-secondary min-h-20 min-w-30 text-center border-1 border-radius-2">
                <form action="<?php echo urlroot;?>/Elections/deletePosition" method="post">
                    <input type="hidden" name="id" value="">
                    <Span>
                        <h3 class="mt-1"> Confirm Delete?</h3>
                        <h3 class="text-danger ml-1 mr-1 mt-1"> You cannot undo this action after clicking 'Confirm'</h3>
                    </Span>
                    <button type="submit" class="btn btn-primary w-15 h-10 m-1 p-1"><b>Confirm</b></button>               
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
                                
                                
                                <button class='btn btn-danger m-1 ml-auto h-10' id='".$position->ID."' onclick='deletePosition(this.id)'><i class='fa-sharp fa-solid fa-trash'></i></button>
                                <h2 class='text-underline mt-auto' >". $position->positionName." -- ".$position->NoofOptions." Option(s)</h2>
                                <button class='btn btn-primary m-1 mr-auto h-10' id='".$position->ID."' onclick='editPosition(this.id)'><i class='fa-sharp fa-solid fa-pen'></i></button>
                            </div>
                            
                            <div class='text-center'>
                            
                            <input type='hidden' value='".$position->positionName."'>
                            <button class='btn btn-primary m-1' id='".$position->ID."' onclick='addCandidate(this.id)'><b>Add Candidate</b></button>
                            </div>

                        </div>
                        <div class='d-flex flex-wrap align-center justify-content-center'>";
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
        document.getElementById('formForPosition').style.display = "none";
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
        document.getElementById('popup-d').style.filter = "none";

        document.getElementsByClassName('main-container')[0].style.filter = "blur(5px)";
    }


    function popupClose(){
        document.getElementById('popup-d').style.display = "none";
        document.getElementById('popup-delete-position').style.display = "none";
        document.getElementById('positionAddingSuccess').style.display = "none";
        document.getElementsByClassName('main-container')[0].style.filter = "none";
    }

    function deletePosition(id){
        document.getElementById('popup-delete-position').getElementsByTagName('input')[0].value = id;
        document.getElementById('popup-delete-position').style.display = "block";
    }

    document.getElementById('addPositionBtn').addEventListener('click',(e)=>{
        e.preventDefault();
        var form = document.getElementById('formForPosition');
        form.getElementsByTagName('span')[0].innerHTML = "Adding new position....";

        var electionId = form.getElementsByTagName('input')[0].value;
        var positionName = form.getElementsByTagName('input')[1].value;
        var positionDesc = form.getElementsByTagName('textarea')[0].innerHTML;
        var noOfOptions = form.getElementsByTagName('input')[2].value;

        fetch('<?php echo urlroot;?>/Elections/addSinglePosition',{
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                electionId: electionId,
                positionName: positionName,
                positionDesc: positionDesc,
                noOfOptions: noOfOptions
            })
        }).then(response => {
            if(response.ok){
                return response.json();
            }else{
                throw new Error('Something went wrong');
            }
        })
        .then(data => {
            var msg = data.msg;
            console.log(msg);
            form.getElementsByTagName('span')[0].innerHTML = msg;
            if(msg == "success"){
                document.getElementById('positionAddingSuccess').style.display = "block";
            }
        })
        .catch(error => {
            console.error('Error:', error);
            console.log(error.message);
        });

    });

    function addPositionVisible(){
        document.getElementById('formForPosition').style.display = "block";
        document.getElementById('formForPosition').getElementsByTagName('input')[1].focus();
    }

    function funcDone(id){
        location.reload();
        // window.location.href = '<?php echo urlroot; ?>/Pages/electionCandidates/'+id;
    }
</script>

<?php require approot . '/View/inc/footer.php'; ?>
