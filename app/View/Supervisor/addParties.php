<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>
<?php require approot . '/View/inc/sidebar-new.php'; ?>

<div class="main-container">
    <div class="w-80 mt-1 bg-white d-flex flex-column p-1">
        <input type="hidden" name="" id="electionId" value="<?php echo $data['ID'];?>">
        <div class="title">Add Parties to Election</div>

        <div class="mt-2 d-flex flex-column w-80 mx-auto">
            <div class="mt-1 d-flex">
                <label for="" class="w-30 my-auto text-right mx-1">Party name: </label>
                <input type="text" id='partyName'>
            </div>
            <div class="mt-1 d-flex">
                <label for="" class="w-30 my-auto text-right mx-1">Party supervisor name: </label>
                <input type="text" id='partySupName'>
            </div>
            <div class="mt-1 d-flex">
                <label for="" class="w-30 my-auto text-right mx-1">Party supervisor email: </label>
                <input type="email" id='partySupEmail'>
            </div>
            <div class="mt-1 d-flex">
                <button class="btn btn-primary text-xl card-hover ml-auto" onclick="addParty()">Add Party</button>
            </div>
        </div>

        <?php
        if (!empty($data['parties'])) {
        ?>
            <div id="partyList" class="mt-2 w-80 mx-auto">
                <div class="sub-title my-1 text-center">Added parties</div>
                <table>
                    <tr>
                        <th>Party Name</th>
                        <th>Supervisor Name</th>
                        <th>Supervisor Email</th>
                    </tr>
                    <?php
                    foreach ($data['parties'] as $party) {
                        echo "<tr>";
                        echo "<td>" . $party->partyName . "</td>";
                        echo "<td>" . $party->supName . "</td>";
                        echo "<td>" . $party->supEmail . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
        <?php
        }
        ?>

        <div class="mt-5 mb-2 w-100 justify-content-center d-flex">
            <a href="<?php echo urlroot; ?>/Pages/wayToAddCandidates/<?php echo $data['ID']; ?>" class="btn btn-primary text-xl card-hover"><b>Continue</b></a>
        </div>
    </div>
</div>

<script>
    const partyName = document.getElementById('partyName');
    const partySupName = document.getElementById('partySupName');
    const partySupEmail = document.getElementById('partySupEmail');
    const electionId = document.getElementById('electionId').value;

    function addParty() {
        if (partyName.value == '' || partySupName.value == '' || partySupEmail.value == '') {
            alert('Please fill all the fields');
            return;
        }

        fetch("<?php echo urlroot; ?>/Elections/addSingleParty", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    partyName: partyName.value,
                    supervisorName: partySupName.value,
                    supervisorEmail: partySupEmail.value,
                    electionId: electionId
                })
            }).then(response => {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error("Request failed!");
                }
            }).then(data => {
                if (data.msg == "success") {
                    location.reload();
                } else {
                    alert(data.msg);
                    partyName.value = '';
                    partySupName.value = '';
                    partySupEmail.value = '';

                }
            }).catch(error => console.log(error));
    }
</script>

<?php require approot . '/View/inc/footer.php'; ?>