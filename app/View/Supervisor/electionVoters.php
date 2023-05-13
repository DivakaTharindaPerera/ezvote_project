<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>
<?php require approot . '/View/inc/sidebar-new.php'; ?>

<div class="main-container">
    <div id="taskbar" class="d-flex flex-column w-100 bg-blue-1" style="border-bottom-left-radius: 20px; border-bottom-right-radius: 20px; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.4);" >
        <div class="d-flex">
            <div id="buttons" class="m-1 mr-auto">
                <a href="<?php echo urlroot?>/Pages/ViewMyElection/<?php echo $data['ID'] ?>" class="btn btn-danger card-hover min-h-90"><i class="fa-solid fa-angles-left"></i><span class="ml-1">Back</span></a>
                <button class="btn btn-primary min-h-90 card-hover ml-1" id="addVoterBtn"><b>ADD VOTER</b></button>
            </div>
            <div id="searchBar" class="m-1">
                <input type="text" name="" id="searchInput" placeholder="search for voters...." class="border-1" style="border-radius: 20px;" onkeyup="searchVoter()">
            </div>
        </div>
        <div id="insertNewVoter" class="d-flex p-1 w-100" style="display: none;">
            <div class="d-flex flex-column text-center">
                <h3>Add new Voter</h3>
                <span class="text-danger mt-1"></span>
            </div>
            <div class="d-flex w-100 mt-1">
                <div class="mb-1 mt-auto w-20 ml-auto">
                    <input type="text" name="" id="" placeholder="Voter email...." class="border-1" style="border-radius: 20px;">
                </div>
                <div class="mb-1 ml-1 mt-auto w-20">
                    <input type="text" name="" id="" placeholder="Voter name....." class="border-1" style="border-radius: 20px;">
                </div>
                <div class="mb-1 ml-1 mt-auto">
                    Value of the vote: <input type="number" name="" id="" min="1" class="border-1 w-20" value="1" style="border-radius: 20px; padding: 5px;">
                </div>
                <div class="d-flex ml-auto">
                    <button class="btn btn-primary h-75 w-75 text-xl mr-1 card-hover" onclick="insertVoter()" style="border-radius: 50%;"><i class="fa-regular fa-circle-check"></i></button>
                    <button class="btn btn-danger h-75  w-75 text-xl card-hover" onclick="closeDiv()" style="border-radius: 50%;"><i class="fa-regular fa-circle-xmark"></i></button>
                </div>
            </div>
            
        </div>
    </div>
    <div>
        <input type="hidden" name="" id="electionId" value="<?php echo $data['ID'] ?>">

        
    </div>

    <div id="popup-delete-voter" class="popup-window-1 bg-secondary min-h-30 min-w-30 text-center border-1 border-radius-2">
        <div class="popup-window-1-content bg-light border-radius-2 p-1">
            <form action="<?php echo urlroot; ?>/Elections/removeVoter" method="post">
                <input type="hidden" name="voterId" value="">
                <input type="hidden" name="eid" value="<?php echo $data['ID']?>">
                <Span>
                    <h3 class="mt-1"> Confirm Deleting Voter?</h3>
                    <h3 class="text-danger ml-1 mr-1 mt-1"> You cannot undo this action after clicking 'Confirm'</h3>
                </Span>
                <button type="submit" class="btn btn-primary w-15 h-10 m-1 p-1 card-hover"><b>Confirm</b></button>
                <button type="button" onclick="closeDiv()" class="btn btn-danger w-15 h-10 p-1 m-1 card-hover"><b>Cancel</b></button>
            </form>
        </div>
    </div>

    <div id="popup-edit-voter" class="popup-window-1 bg-secondary min-h-30 min-w-30 text-center border-1 border-radius-2">
        <div class="popup-window-1-content bg-light border-radius-2">
            <span class="text-danger m-1 "></span>
            <input type="hidden" name="eid" value="<?php echo $data['ID'] ?>">
            <input type="hidden" name="voterId" value="">
            
            <div class="m-1">
                Email <input type="text" name="" id="" value="" class="border-1 w-50" style="border-radius: 20px;">
            </div>
            <div class="m-1">
                Name <input type="text" name="" id="" value="" class="border-1 w-50" style="border-radius: 20px;">
            </div>
            <div class="m-1">
                Value: <input type="number" name="" id="" min="1" value="" class="border-1 w-20 px-1" style="border-radius: 20px; padding: 5px;">
            </div>
            <div class="m-1">
                <button class="btn btn-primary card-hover" onclick="editVoterConfirm()">Save</button>
                <button class="btn btn-danger ml-1 card-hover" onclick="closeDiv()">Cancel</button>
            </div>
            <input type="hidden" name="emailOld" value="">
        </div>
    </div>

    <div id="votersArea" class="p-1 h-80 w-100 d-flex flex-wrap align-center justify-content-center mt-1 mb-1">
        <?php
        if($data['unregVoterRow'] == null && $data['regVoterRow'] == null){
            echo "<h3 class='text-danger'>No voters added yet</h3>";
        }

        foreach ($data['unregVoterRow'] as $row) {
        ?>
            <div class="card text-center p-1">
                <div class="mt-2" style="overflow-wrap: break-word;">
                    <h4><?php echo $row->Name ?></h4>
                </div>
                <div class="max-w-95 mb-1">
                    <label class="Email"><?php echo $row->Email ?></label>
                </div>
                <div>
                    <div><img src='/ezvote/public/img/profile.jpg' style='max-height:50px;max-width: 50px' alt='profile photo'></div>
                </div>
                <div>

                </div>
                <div class="buttons">
                    <!-- for the action butttons -->
                    <input type="hidden" name="" value="<?php echo  $row->Name; ?>">
                    <input type="hidden" name="" value="<?php echo  $row->Email; ?>">
                    <input type="hidden" name="" value="<?php echo $row->value; ?>">
                    <button class="btn btn-danger mr-1 card-hover" id="<?php echo $row->voterId; ?>" onclick="deleteVoter(this.id)"><i class='fa-sharp fa-solid fa-trash'></i></button>
                    <button class="btn btn-primary card-hover" id="<?php echo $row->voterId; ?>" onclick="editVoter(this.id)"><i class='fa-sharp fa-solid fa-pen'></i></button>
                </div>
                <div class="mb-1">
                    <label class="text-danger">Not yet registered</label>
                </div>
            </div>
            <?php
        }
        foreach ($data['regVoterRow'] as $voter) {
            
            ?>

                    <div class="card text-center">
                        <div class="mt-1">
                            <h4><?php echo $voter->Name ?></h4>
                        </div>
                        
                        <div class="mt-auto">
                            <div><img src='/ezvote/public/img/profile.jpg' style='max-height:50px;max-width: 50px' alt='profile photo'></div>
                        </div>
                        <div>

                        </div>
                        <div class="buttons mb-1 mt-auto">
                            <!-- for the action butttons -->
                            <input type="hidden" name="" value="<?php echo  $voter->Name; ?>">
                            <input type="hidden" name="" value="<?php echo  $voter->Email; ?>">
                            <input type="hidden" name="" value="<?php echo  $voter->value; ?>">
                            <button class="btn btn-danger mr-1 card-hover" id="<?php echo $voter->voterId; ?>" onclick="deleteVoter(this.id)"><i class='fa-sharp fa-solid fa-trash'></i></button>
                            <button class="btn btn-primary card-hover" id="<?php echo $voter->voterId?>" onclick="editVoter(this.id)"><i class='fa-sharp fa-solid fa-pen'></i></button>
                        </div>
                    </div>
        <?php
        }
        ?>
    </div>
</div>

<script>
    //electionId
    var electionId = document.getElementById("electionId").value;

    // to set the variable font size according to the container width...
    var texts = document.getElementsByClassName("Email");
    for (var i = 0; i < texts.length; i++) {
        var maxWidth = texts[i].parentNode.offsetWidth;
        var fontSize = parseInt(window.getComputedStyle(texts[i]).getPropertyValue('font-size'));
        while (texts[i].offsetWidth > maxWidth) {
            fontSize--;
            texts[i].style.fontSize = fontSize + 'px';
        }
    }
    //end

    document.getElementById("addVoterBtn").addEventListener("click", function() {
        document.getElementById("insertNewVoter").style.display = "block";
        document.getElementById("insertNewVoter").getElementsByTagName("input")[0].focus();
    });

    function insertVoter() {
        var id = document.getElementById("electionId").value;

        var email = document.getElementById("insertNewVoter").getElementsByTagName("input")[0].value;
        var name = document.getElementById("insertNewVoter").getElementsByTagName("input")[1].value;
        var value = document.getElementById("insertNewVoter").getElementsByTagName("input")[2].value;

        if (email == "") {
            document.getElementById("insertNewVoter").getElementsByTagName("span")[0].innerHTML = "Email is required";
            document.getElementById("insertNewVoter").getElementsByTagName("input")[0].focus();
            return;
        }

        if (name == "") {
            document.getElementById("insertNewVoter").getElementsByTagName("span")[0].innerHTML = "Name is required";
            document.getElementById("insertNewVoter").getElementsByTagName("input")[1].focus();
            return;
        }

        if (value == "") {
            document.getElementById("insertNewVoter").getElementsByTagName("span")[0].innerHTML = "Value is required";
            document.getElementById("insertNewVoter").getElementsByTagName("input")[2].focus();
            return;
        }

        fetch('<?php echo urlroot; ?>/Elections/addSingleVoter', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id: id,
                    email: email,
                    name: name,
                    value: value
                })
            })
            .then(response => {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error('Something went wrong');
                }
            })
            .then(data => {
                if (data.msg == "success") {
                    location.reload();
                } else {
                    document.getElementById("insertNewVoter").getElementsByTagName("span")[0].innerHTML = data.msg;
                    document.getElementById("insertNewVoter").getElementsByTagName("input")[0].focus();
                }
            })

    }

    function closeDiv() {
        var inputs = document.getElementById("insertNewVoter").getElementsByTagName("input");
        document.getElementById("insertNewVoter").getElementsByTagName("span")[0].innerHTML = "";
        for (var i = 0; i < inputs.length - 1; i++) {
            inputs[i].value = "";
        }
        inputs[inputs.length - 1].value = 1;

        document.getElementById("insertNewVoter").style.display = "none";

        document.getElementById("popup-delete-voter").style.display = "none";
        // document.getElementById("popup-delete-voter-reg").style.display = "none";
        document.getElementById("popup-edit-voter").style.display = "none";

        document.querySelector('body').classList.remove('no-scroll-for-popup');
    }

    function deleteVoter(id) {
        var confirmDiv = document.getElementById("popup-delete-voter");
        confirmDiv.getElementsByTagName('input')[0].value = id;

        document.querySelector('body').classList.add('no-scroll-for-popup');

        confirmDiv.style.display = "block";
    }

    // function deleteRegVoter(uid) {
    //     var confirmDiv = document.getElementById("popup-delete-voter-reg");
    //     confirmDiv.getElementsByTagName('input')[1].value = uid;

    //     document.querySelector('body').classList.add('no-scroll-for-popup');

    //     confirmDiv.style.display = "block";
    // }

    function editVoter(id) {
        var parentDiv = document.getElementById(id).parentElement;
        var name = parentDiv.getElementsByTagName("input")[0].value;
        var email = parentDiv.getElementsByTagName("input")[1].value;
        var value = parentDiv.getElementsByTagName("input")[2].value;

        const body = document.querySelector('body');
        body.classList.add('no-scroll-for-popup');

        console.log(name);

        var formDiv = document.getElementById("popup-edit-voter");

        formDiv.getElementsByTagName("input")[1].value = id;
        formDiv.getElementsByTagName("input")[2].value = email;
        formDiv.getElementsByTagName("input")[3].value = name;
        formDiv.getElementsByTagName("input")[4].value = value;
        formDiv.getElementsByTagName("input")[5].value = email;

        formDiv.style.display = "block";
    }


    function editVoterConfirm() {
        var dataForm = document.getElementById("popup-edit-voter").getElementsByTagName("input");

        var eid = dataForm[0].value;
        var id = dataForm[1].value;
        var email = dataForm[2].value;
        var name = dataForm[3].value;
        var value = dataForm[4].value;
        var oldEmail = dataForm[5].value;


        if (email == "") {
            document.getElementById("popup-edit-voter").getElementsByTagName("span")[0].innerHTML = "Email is required";
            document.getElementById("popup-edit-voter").getElementsByTagName("input")[1].focus();
            return;
        }

        if (name == "") {
            document.getElementById("popup-edit-voter").getElementsByTagName("span")[0].innerHTML = "Name is required";
            document.getElementById("popup-edit-voter").getElementsByTagName("input")[2].focus();
            return;
        }

        if (value == "") {
            document.getElementById("popup-edit-voter").getElementsByTagName("span")[0].innerHTML = "Value is required";
            document.getElementById("popup-edit-voter").getElementsByTagName("input")[3].focus();
            return;
        }

        fetch('<?php echo urlroot; ?>/Elections/editVoter', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    eid: eid,
                    oldEmail: oldEmail,
                    voterId: id,
                    email: email,
                    name: name,
                    value: value
                })
            })
            .then(response => {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error('Something went wrong');
                }
            })
            .then(data => {
                if (data.msg == "success") {
                    location.reload();
                } else {
                    document.getElementById("popup-edit-voter").getElementsByTagName("span")[0].innerHTML = data.msg;
                    document.getElementById("popup-edit-voter").getElementsByTagName("input")[0].focus();
                }
            })
            .catch(error => console.log(error));
    }

    function searchVoter(){
        var input = document.getElementById("searchInput").value;
        var filter = input.toUpperCase();

        var voters = document.getElementById("votersArea").getElementsByClassName("card");

        for(var i =0; i<voters.length; i++){
            var name = voters[i].getElementsByTagName("h4")[0].innerText;
            var email = voters[i].getElementsByTagName("label")[0].innerText;

            if(name.toUpperCase().indexOf(filter) > -1 || email.toUpperCase().indexOf(filter) > -1){
                voters[i].style.display = "";
            }else{
                voters[i].style.display = "none";
            }
        }

    }
</script>

<?php require approot . '/View/inc/footer.php'; ?>