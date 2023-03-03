<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>
<?php require approot . '/View/inc/sidebar-new.php'; ?>

<div class="main-container">
    <div id="taskbar" class="d-flex w-90 " >
        <div id="buttons" class="m-1 mr-auto">
            <button class="btn btn-primary" id="addVoterBtn"><b>ADD VOTER</b></button>
            <a href="<?php echo urlroot?>/Pages/ViewMyElection/<?php echo $data['ID'] ?>"><span class="btn btn-danger">Back</span></a>
        </div>
        <div id="searchBar" class="m-1">
            <input type="text" name="" id="searchInput" placeholder="search for voters...." class="border-1" style="border-radius: 20px;" onkeyup="searchVoter()">
        </div>
    </div>
    <div>
        <input type="hidden" name="" id="electionId" value="<?php echo $data['ID'] ?>">

        <div id="insertNewVoter" class="d-flex flex-column border-1 p-1 border-radius-2 w-100" style="display: none;">
            <h3 class="text-center">Add new Voter</h3>
            <span class="text-danger mt-1"></span>
            <div class="mb-1 mt-1">
                <input type="text" name="" id="" placeholder="Email...." class="border-1" style="border-radius: 20px;">
            </div>
            <div class="mb-1">
                <input type="text" name="" id="" placeholder="Name....." class="border-1" style="border-radius: 20px;">
            </div>
            <div class="mb-1">
                Value of the vote: <input type="number" name="" id="" min="1" class="border-1 w-20" value="1" style="border-radius: 20px; padding: 5px;">
            </div>
            <div class="text-center d-flex">
                <button class="btn btn-primary mr-auto" onclick="insertVoter()"><b>ADD</b></button>
                <button class="btn btn-danger ml-auto" onclick="closeDiv()"><b>CANCEL</b></button>
            </div>
        </div>
    </div>

    <div id="popup-delete-voter-unreg" class="popup-window-1 bg-secondary min-h-30 min-w-30 text-center border-1 border-radius-2">
        <div class="popup-window-1-content bg-light border-radius-2 p-1">
            <form action="<?php echo urlroot; ?>/Elections/removeVoter" method="post">
                <input type="hidden" name="eid" value="<?php echo $data['ID'] ?>">
                <input type="hidden" name="email" value="">
                <Span>
                    <h3 class="mt-1"> Confirm Deleting Voter?</h3>
                    <h3 class="text-danger ml-1 mr-1 mt-1"> You cannot undo this action after clicking 'Confirm'</h3>
                </Span>
                <button type="submit" class="btn btn-primary w-15 h-10 m-1 p-1"><b>Confirm</b></button>
                <button type="button" onclick="closeDiv()" class="btn btn-danger w-15 h-10 p-1 m-1"><b>Cancel</b></button>
            </form>
        </div>
    </div>

    <div id="popup-delete-voter-reg" class="popup-window-1 bg-secondary min-h-30 min-w-30 text-center border-1 border-radius-2">
        <div class="popup-window-1-content bg-light border-radius-2 p-1">
            <form action="<?php echo urlroot; ?>/Elections/removeVoterReg" method="post">
                <input type="hidden" name="eid" value="<?php echo $data['ID'] ?>">
                <input type="hidden" name="uid" value="">
                <Span>
                    <h3 class="mt-1"> Confirm Deleting Voter?</h3>
                    <h3 class="text-danger ml-1 mr-1 mt-1"> You cannot undo this action after clicking 'Confirm'</h3>
                </Span>
                <button type="submit" class="btn btn-primary w-15 h-10 m-1 p-1"><b>Confirm</b></button>
                <button type="button" onclick="closeDiv()" class="btn btn-danger w-15 h-10 p-1 m-1"><b>Cancel</b></button>
            </form>
        </div>
    </div>

    <div id="popup-edit-voter-unreg" class="popup-window-1 bg-secondary min-h-30 min-w-30 text-center border-1 border-radius-2">
        <div class="popup-window-1-content bg-light border-radius-2">
            <span class="text-danger m-1 "></span>
            <input type="hidden" name="eid" value="<?php echo $data['ID'] ?>">
            <input type="hidden" name="" value="">
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
                <button class="btn btn-primary" onclick="editUnregVoter()">Save</button>
                <button class="btn btn-danger ml-1" onclick="closeDiv()">Cancel</button>
            </div>
        </div>
    </div>

    <div id="votersArea" class="p-1 h-80 overflow-scroll w-100 d-flex flex-wrap align-center justify-content-center mt-1 mb-1">
        <?php
        foreach ($data['unregVoterRow'] as $row) {
        ?>
            <div class="card text-center p-1">
                <div class="mt-2" style="overflow-wrap: break-word;">
                    <h4><?php echo $row->name ?></h4>
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
                    <input type="hidden" name="" value="<?php echo  $row->name; ?>">
                    <input type="hidden" name="" value="<?php echo  $row->Email; ?>">
                    <input type="hidden" name="" value="<?php echo $row->value; ?>">
                    <button class="btn btn-danger mr-1" id="<?php echo $row->Email; ?>" onclick="deleteUnregVoter(this.id)"><i class='fa-sharp fa-solid fa-trash'></i></button>
                    <button class="btn btn-primary" id="<?php echo $row->Email; ?>" onclick="editVoter(this.id)"><i class='fa-sharp fa-solid fa-pen'></i></button>
                </div>
                <div class="mb-1">
                    <label class="text-danger">Not yet registered</label>
                </div>
            </div>
            <?php
        }
        foreach ($data['regVoterRow'] as $voter) {
            foreach ($data['users'] as $user) {
                if ($user->UserId == $voter->UserId) {
            ?>

                    <div class="card text-center">
                        <div>
                            <h4><?php echo $user->Fname . " " . $user->Lname ?></h4>
                        </div>
                        <div class="max-w-95 mb-1">
                            <label class="Email"><?php echo $user->Email ?></label>
                        </div>
                        <div>
                            <div><img src='/ezvote/public/img/profile.jpg' style='max-height:50px;max-width: 50px' alt='profile photo'></div>
                        </div>
                        <div>

                        </div>
                        <div class="buttons mb-1">
                            <!-- for the action butttons -->
                            <button class="btn btn-danger mr-1" id="<?php echo $voter->UserId; ?>" onclick="deleteRegVoter(this.id)"><i class='fa-sharp fa-solid fa-trash'></i></button>
                            <button class="btn btn-primary" id="" onclick="editVoterReg()"><i class='fa-sharp fa-solid fa-pen'></i></button>
                        </div>
                    </div>
        <?php
                }
            }
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

        document.getElementById("popup-delete-voter-unreg").style.display = "none";
        document.getElementById("popup-delete-voter-reg").style.display = "none";
        document.getElementById("popup-edit-voter-unreg").style.display = "none";


        document.querySelector('body').classList.remove('no-scroll-for-popup');
    }

    function deleteUnregVoter(email) {
        var confirmDiv = document.getElementById("popup-delete-voter-unreg");
        confirmDiv.getElementsByTagName('input')[1].value = email;

        document.querySelector('body').classList.add('no-scroll-for-popup');

        confirmDiv.style.display = "block";
    }

    function deleteRegVoter(uid) {
        var confirmDiv = document.getElementById("popup-delete-voter-reg");
        confirmDiv.getElementsByTagName('input')[1].value = uid;

        document.querySelector('body').classList.add('no-scroll-for-popup');

        confirmDiv.style.display = "block";
    }

    function editVoter(id) {
        var parentDiv = document.getElementById(id).parentElement;
        var name = parentDiv.getElementsByTagName("input")[0].value;
        var email = parentDiv.getElementsByTagName("input")[1].value;
        var value = parentDiv.getElementsByTagName("input")[2].value;

        const body = document.querySelector('body');
        body.classList.add('no-scroll-for-popup');

        console.log(name);

        var formDiv = document.getElementById("popup-edit-voter-unreg");

        formDiv.getElementsByTagName("input")[1].value = email;
        formDiv.getElementsByTagName("input")[2].value = email;
        formDiv.getElementsByTagName("input")[3].value = name;
        formDiv.getElementsByTagName("input")[4].value = value;

        formDiv.style.display = "block";
    }

    function editVoterReg(){

    }

    function editUnregVoter() {
        var dataForm = document.getElementById("popup-edit-voter-unreg").getElementsByTagName("input");

        var eid = dataForm[0].value;
        var oldEmail = dataForm[1].value;
        var email = dataForm[2].value;
        var name = dataForm[3].value;
        var value = dataForm[4].value;


        if (email == "") {
            document.getElementById("popup-edit-voter-unreg").getElementsByTagName("span")[0].innerHTML = "Email is required";
            document.getElementById("popup-edit-voter-unreg").getElementsByTagName("input")[1].focus();
            return;
        }

        if (name == "") {
            document.getElementById("popup-edit-voter-unreg").getElementsByTagName("span")[0].innerHTML = "Name is required";
            document.getElementById("popup-edit-voter-unreg").getElementsByTagName("input")[2].focus();
            return;
        }

        if (value == "") {
            document.getElementById("popup-edit-voter-unreg").getElementsByTagName("span")[0].innerHTML = "Value is required";
            document.getElementById("popup-edit-voter-unreg").getElementsByTagName("input")[3].focus();
            return;
        }

        fetch('<?php echo urlroot; ?>/Elections/editUnregVoter', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    eid: eid,
                    oldEmail: oldEmail,
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
                    document.getElementById("popup-edit-voter-unreg").getElementsByTagName("span")[0].innerHTML = data.msg;
                    document.getElementById("popup-edit-voter-unreg").getElementsByTagName("input")[0].focus();
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