<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>
<?php require approot . '/View/inc/sidebar-new.php'; ?>

<div class="main-container">
    <div id="taskbar" class="d-flex p-1 flex-column w-100 bg-blue-1" style="border-bottom-left-radius: 20px; border-bottom-right-radius: 20px; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.4);">
        <div class="d-flex mr-auto">
            <input type="hidden" name="" id="electionId" value="<?php echo $data['ID']; ?>">
            <a href="<?php echo urlroot; ?>/Pages/viewMyElection/<?php echo $data['ID']; ?>" class="btn btn-danger text-xl card-hover"><i class="fa-solid fa-angles-left"></i><span class="ml-1">Back</span></a>
            <button class="btn btn-primary ml-1 card-hover" onclick="addPartyVisible()"><b class="text-xl"><i class="mt-auto mr-1 fa-solid fa-plus"></i>Add New Party</b></button>
        </div>
        <div id="formForParty" class="m-1 text-center" style="display: none;">
            <h3>Add new party</h3>
            <span class="m-1 text-danger"></span>
            <div class="d-flex text-center mt-1">
                <div class="d-flex ml-auto">
                    <div class="mr-1">
                        <input type="text" placeholder="Party name...." class="border-1 mr-1 card-hover" style="border-radius: 20px;">
                    </div>
                    <div class="mr-1">
                        <input type="text" placeholder="Supervisor name...." class="border-1 card-hover" style="border-radius: 20px;">
                    </div>
                    <div>
                        <input type="text" placeholder="Supervisor email...." class="border-1 card-hover" style="border-radius: 20px;">
                    </div>
                </div>
                <div class="d-flex mr-auto ml-1">
                    <button class="btn btn-primary h-100 w-50 text-xl mr-1 card-hover" onclick="addParty()" style="border-radius: 50%;"><i class="fa-regular fa-circle-check"></i></button>
                    <button class="btn btn-danger h-100  w-50 text-xl card-hover" onclick="closePartyAddDiv()" style="border-radius: 50%;"><i class="fa-regular fa-circle-xmark"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div id="popupForEdit" class="popup-window-1 bg-secondary min-h-30 min-w-30 text-center border-1 border-radius-2">
        <div class="popup-window-1-content bg-light border-radius-2">
            <span class="text-danger m-1 "></span>
            <input type="hidden" name="partyId" value="">
            
            <div class="m-1">
                Party name <input type="text" name="" id="" value="" class="border-1 w-50" style="border-radius: 20px;">
            </div>
            <div class="m-1">
                Supervisor name <input type="text" name="" id="" value="" class="border-1 w-50" style="border-radius: 20px;">
            </div>
            <div class="m-1">
                Supervisor Email <input type="text" name="" id="" value="" class="border-1 w-50" style="border-radius: 20px;">
            </div>
            <div class="m-1">
                <button class="btn btn-primary card-hover" onclick="editPartyConfirm()">Save</button>
                <button class="btn btn-danger ml-1 card-hover" onclick="closeDiv()">Cancel</button>
            </div>
            <input type="hidden" name="oldPName" value="">
        </div>
    </div>

    <div id="popup-delete-party" class="popup-window-1 bg-secondary min-h-30 min-w-30 text-center border-1 border-radius-2">
        <div class="popup-window-1-content bg-light border-radius-2 p-1">
            <form action="<?php echo urlroot; ?>/Elections/removeParty" method="post">
                <input type="hidden" name="partyId" value="">
                <input type="hidden" name="electionId" value="<?php echo $data['ID']; ?>">
                <Span>
                    <h3 class="mt-1"> Confirm Deleting Party?</h3>
                    <h3 class="text-danger ml-1 mr-1 mt-1"> You cannot undo this action after clicking 'Confirm'</h3>
                </Span>
                <button type="submit" class="btn btn-primary w-15 h-10 m-1 p-1 card-hover"><b>Confirm</b></button>
                <button type="button" onclick="closeDiv()" class="btn btn-danger w-15 h-10 p-1 m-1 card-hover"><b>Cancel</b></button>
            </form>
        </div>
    </div>

    <div id="parties" class="mt-2 d-flex flex-wrap">
        <?php
        if ($data['partyRow'] == NULL) {
            echo "<h3 class='text-danger'>No parties added yet</h3>";
        } else {
            foreach ($data['partyRow'] as $party) {
                $cnt = 0;
        ?>  
            <div class="card-pane">
                <div class="card text-center">
                    <h4><?php echo $party->partyName; ?></h4>
                    <?php 
                        foreach($data['candidateRow'] as $candidate){
                            if($candidate->partyId == $party->partyId){
                                $cnt++;
                            }
                        }
                    ?>
                    
                    <div id="supervisor" class="text-light bg-blue-10 mt-1 border-radius-2 w-100 h-50 p-1">
                        <h5 class="mb-1">Supervisor</h5>
                        <h6><?php echo $party->supName; ?></h6>
                        <h6><?php echo $party->supEmail; ?></h6>
                    </div>
                    <h5 class="text-primary mb-1 mb-auto"><?php echo $cnt; ?> Candidates</h5>
                    <div id="btns" class="d-flex text-center">
                        <input type="hidden" name="" value="<?php echo $party->partyName;?>">
                        <input type="hidden" name="" value="<?php echo $party->supName;?>">
                        <input type="hidden" name="" value="<?php echo $party->supEmail;?>">
                        <button class="ml-auto btn btn-primary mr-1 card-hover" id="<?php echo $party->partyId;?>" onclick="editParty(this.id)"><i class='fa-sharp fa-solid fa-pen'></i></button>
                        <button class="mr-auto btn btn-danger card-hover" id="<?php echo $party->partyId;?>" onclick="deleteParty(this.id)"><i class='fa-sharp fa-solid fa-trash'></i></button>
                    </div>
                </div>
            </div>
        <?php  
            }
        }
        ?>
    </div>
</div>

<script>
    const body = document.querySelector('body');
    const eid = document.getElementById("electionId").value;

    function deleteParty(id){
        document.getElementById("popup-delete-party").style.display = "block";
        document.getElementById("popup-delete-party").getElementsByTagName("input")[0].value = id;
    }

    function addPartyVisible() {
        document.getElementById("formForParty").style.display = "block";

        
    }

    function closePartyAddDiv() {
        document.getElementById("formForParty").getElementsByTagName("input")[0].value = "";
        document.getElementById("formForParty").getElementsByTagName("input")[1].value = "";
        document.getElementById("formForParty").getElementsByTagName("input")[2].value = "";
        document.getElementById("formForParty").getElementsByTagName("span")[0].innerHTML = "";

        document.getElementById("formForParty").style.display = "none";
    }

    function addParty() {
        const dataFields = document.getElementById("formForParty");
        const partyName = dataFields.getElementsByTagName("input")[0].value;
        const supervisorName = dataFields.getElementsByTagName("input")[1].value;
        const supervisorEmail = dataFields.getElementsByTagName("input")[2].value;

        const electionId = document.getElementById("electionId").value;

        if (partyName == "" || supervisorName == "" || supervisorEmail == "") {
            dataFields.getElementsByTagName("span")[0].innerHTML = "Please fill all the fields";
        } else {
            fetch("<?php echo urlroot; ?>/Elections/addSingleParty", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        partyName: partyName,
                        supervisorName: supervisorName,
                        supervisorEmail: supervisorEmail,
                        electionId: electionId
                    })
                }).then(response => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error("Request failed!");
                    }
                })
                .then(data => {
                    if (data.msg == "success") {
                        location.reload();
                    } else {
                        dataFields.getElementsByTagName("span")[0].innerHTML = data.msg;
                        dataFields.getElementsByTagName("input")[0].focus();
                    }
                })
                .catch(error => console.log(error));
        }
    }

    function closeDiv(){
        document.getElementById("popupForEdit").getElementsByTagName("input")[2].value = "";
        document.getElementById("popupForEdit").getElementsByTagName("input")[3].value = "";
        document.getElementById("popupForEdit").getElementsByTagName("input")[4].value = "";
        document.getElementById("popupForEdit").getElementsByTagName("span")[0].innerHTML = "";

        document.getElementById("popup-delete-party").style.display = "none";

        document.getElementById("popupForEdit").style.display = "none";
        body.classList.remove('no-scroll-for-popup');
    }

    function editParty(id){
        document.getElementById("popupForEdit").style.display = "block";
        body.classList.add('no-scroll-for-popup');

        const partyName = document.getElementById(id).parentElement.getElementsByTagName("input")[0].value;
        const supervisorName = document.getElementById(id).parentElement.getElementsByTagName("input")[1].value;
        const supervisorEmail = document.getElementById(id).parentElement.getElementsByTagName("input")[2].value;

        document.getElementById("popupForEdit").getElementsByTagName("input")[0].value = id;
        document.getElementById("popupForEdit").getElementsByTagName("input")[1].value = partyName;
        document.getElementById("popupForEdit").getElementsByTagName("input")[2].value = supervisorName;
        document.getElementById("popupForEdit").getElementsByTagName("input")[3].value = supervisorEmail;
        document.getElementById("popupForEdit").getElementsByTagName("input")[4].value = partyName;

    }

    function editPartyConfirm(){
        const dataFields = document.getElementById("popupForEdit");
        
        const partyId = dataFields.getElementsByTagName("input")[0].value;
        const partyName = dataFields.getElementsByTagName("input")[1].value;
        const supervisorName = dataFields.getElementsByTagName("input")[2].value;
        const supervisorEmail = dataFields.getElementsByTagName("input")[3].value;
        const oldPartyName = dataFields.getElementsByTagName("input")[4].value;

        if (partyName == "" || supervisorName == "" || supervisorEmail == "") {
            dataFields.getElementsByTagName("span")[0].innerHTML = "Please fill all the fields";
        } else {
            fetch("<?php echo urlroot; ?>/Elections/editSingleParty", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        electionId: eid,
                        partyId: partyId,
                        partyName: partyName,
                        supervisorName: supervisorName,
                        supervisorEmail: supervisorEmail,
                        oldPartyName: oldPartyName
                    })
                }).then(response => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error("Request failed!");
                    }
                })
                .then(data => {
                    if (data.msg == "success") {
                        location.reload();
                    } else {
                        dataFields.getElementsByTagName("span")[0].innerHTML = data.msg;
                        dataFields.getElementsByTagName("input")[0].focus();
                    }
                })
                .catch(error => console.log(error));
        }
    }
</script>

<?php require approot . '/View/inc/footer.php'; ?>