<?php //require approot . '/View/inc/header.php'; 
?>
<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>
<?php require approot . '/View/inc/sidebar-new.php'; ?>


<div class="main-container">
    <div class="candidate d-flex flex-column border-primary border-radius-2 border-2 my-4 w-95">
        <div class="title">Adding Candidates</div>
        <div class="humansDiv" id="humansDiv" class="d-flex flex-column p-1 w-100">

            <div class="text-center"><button onclick="createParty()" class="btn btn-primary w-50 mx-1 my-1 w-10 card-hover"><b>Create Party</b></button></div>
            <div class="partyCreate mx-1 my-1 w-80 border-1 p-1 border-radius-2 text-center bg-green-1" id="createParty" style="display: none;">
                <div class="my-1">
                    <input type="text" id="partyName" placeholder="Party name...." class="border-1" style="border-radius: 20px; background-color: blue;color: white; font-weight: bold;"><span id="partyNameError" class="text-danger"></span>
                </div>

                <div id="partySup" class="border-2 border-dark p-1 text-center border-radius-2">
                    <div class="mb-1">
                        <label for="partySup"><b>Party Supervisor</b></label><br>
                    </div>
                    <div class="mb-1">
                        <input type="email" id="partySupEmail" placeholder="Email...." class="border-primary" style="border-radius: 20px; background-color: blue;color: white; font-weight: bold;"> <span id="supEmailError" class="text-danger"></span><br>
                    </div>
                    <div class="mb-1">
                        <input type="text" id="partySupName" placeholder="Name...." class="border-primary" style="border-radius: 20px; background-color: blue;color: white; font-weight: bold;"> <span id="supNameError" class="text-danger"></span><br>
                    </div>
                </div>
                <div class="mt-2 w-100">
                    <button onclick="addParty()" class="btn btn-primary card-hover"><b>Add Party</b></button>
                    <button onclick="cancelAddParty()" class="btn btn-danger card-hover mr-auto"><b>Cancel</b></button>

                </div>

            </div>


            <div id="partyList" class="table mx-1 my-1" style="visibility: hidden" ;>
                <table border="1" id="partyTable" class="table">
                    <thead>
                        <tr>
                            <th>Party Name</th>
                            <th>Party Supervisor</th>
                            <th>Party Supervisor Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="parties">

                    </tbody>
                </table>
            </div>


            <div id="addCandidate" class="addCandidate mx-1 my-1">
            

                <label for="cPosition" class="my-1">Election Position: </label>
                <select name="" id="positionListCandidate" class="border-1 px-1 text-right border-radius-2">

                    <?php
                    $c = 0;
                    $s = "";
                    foreach ($data['positionRow'] as $position) {
                        echo "<option value='" . $position->ID . "'>" . $position->positionName . "</option>";
                        $s = $s . $position->positionName . "-" . $position->ID . "|";
                        $c++;
                    }
                    ?>
                </select><br>
                <?php
                echo "<input type='hidden' id='positionData' value='" . $s . "'>";
                echo "<input type='hidden' id='positionCount' value='" . $c . "'>";
                ?>
                <div class="my-1 d-flex flex-column">
                    
                    <div class="mb-1">
                        <input type="text" id="cName" placeholder="Candidate Name...." class="border-1" style="border-radius: 20px;"><span id="cNameError" class="text-danger"></span><br>
                    </div>                    
                    <div class="mb-1">
                        <input type="email" id="cEmail" placeholder="Candidate email...." class="border-1" style="border-radius: 20px;"><span id="cEmailError" class="text-danger"></span><br>
                    </div>
                    <div class="d-flex mb-1">
                        <label for="cParty">Candidate Party: </label>
                        <select name="" id="partyListCandidate" class="border-1 px-1 text-right border-radius-2 ml-1">

                        </select>
                    </div>

                    <div class="text-center">
                        <button onclick="addCandidateToList()" class="btn btn-primary w-25 card-hover text-xl"><b>Add Candidate</b></button>
                    </div>
                </div>
                <button onclick="addCandidateToList()" class="btn btn-primary w-45">Add Candidate</button>


                <div id="candidateList" class="my-1 text-center"></div>

            </div>
            <div class="my-1 text-center">
                <form action="<?php echo urlroot; ?>/Elections/insertParty" id="submissionForm" method="POST">
                    <input type="hidden" name="electionId" value="<?php echo $data['ID']; ?>">
                    <button type="submit" class="btn btn-primary mx-1"><b>SUBMIT</b></button>
                </form>
            </div>
        </div>

    </div>
</div>

<script src="<?php echo urlroot; ?>/js/addCandidates.js"></script>
<?php require approot . '/View/inc/footer.php'; ?>