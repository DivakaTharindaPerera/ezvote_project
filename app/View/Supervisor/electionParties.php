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
                        <input type="text" placeholder="Party name...." class="border-1 mr-1" style="border-radius: 20px;">
                    </div>
                    <div class="mr-1">
                        <input type="text" placeholder="Supervisor name...." class="border-1" style="border-radius: 20px;">
                    </div>
                    <div>
                        <input type="text" placeholder="Supervisor email...." class="border-1" style="border-radius: 20px;">
                    </div>
                </div>
                <div class="d-flex mr-auto ml-1">
                    <button class="btn btn-primary h-100 w-50 text-xl mr-1 card-hover" onclick="addParty()" style="border-radius: 50%;"><i class="fa-regular fa-circle-check"></i></button>
                    <button class="btn btn-danger h-100  w-50 text-xl card-hover" onclick="closePartyAddDiv()" style="border-radius: 50%;"><i class="fa-regular fa-circle-xmark"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div id="parties" class="mt-2 d-flex flex-wrap">
        <?php
        if ($data['partyRow'] == NULL) {
            echo "<h3 class='text-danger'>No parties added yet</h3>";
        }
        foreach ($data['partyRow'] as $party) {
        ?>
            <div class="card text-center">
                <div class="card-title">
                    <?php echo $party->partyName; ?>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>

<script>
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
</script>

<?php require approot . '/View/inc/footer.php'; ?>