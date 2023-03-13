<?php //require approot . '/View/inc/header.php'; ?>
<?php require approot.'/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>
<?php require approot . '/View/inc/sidebar-new.php'; ?>
<!--    <style>-->
<!--        span{-->
<!--            color: red;-->
<!--        }-->
<!--    </style>-->
<!--    <div class="top_nav_bar">-->
<!--        --><?php
//            require_once(approot."/View/topnavbar.php");
//        ?>
<!--    </div>-->
<!--</head>-->
<!--<body>-->
<div class="main-container">
    <div class="candidate d-flex flex-column border-primary border-radius-2 border-2 my-4">
        <div class="title">Adding Candidates</div>
        <div class="mx-1 my-1">
            <label for="type">This election is for: </label><br>
            <input type="radio" name="type" id="humanRadio" onclick="displayDiv()"><label for="humanRadio">Humans</label>
            <input type="radio" name="type" id="nonHumanRadio" onclick="displayDiv()"><label for="nonHumanRadio">Non-Humans</label>
        </div>
        <div class="humansDiv" id="humansDiv" style="display: none;">
            <div class="text-center text-xl">Humans</div>
            <div class="d-flex align-items-center"><button onclick="createParty()" class="btn btn-primary w-45 mx-1 my-1">Create Party</button></div>
            <div class="partyCreate mx-1 my-1" id="createParty" style="display: none;" >
                <div class="my-1"><label for="party">Party name:</label>
                <input type="text" id="partyName"><span id="partyNameError"></span></div>

                <div id="partySup">
                    <label for="partySup" class="text-underline">Party Supervisor </label><br>
                    <div class="my-1"><label for="email">Email: </label><input type="email" id="partySupEmail"> <span id="supEmailError"></span></div>
                    <div class="my-1"><label for="name">Name: </label> <input type="text" id="partySupName"> <span id="supNameError"></span><br></div>
                </div>
                <div class="d-flex my-1 align-items-center justify-content-between">
                <button onclick="addParty()" class="btn btn-primary w-45">Add Party</button>
                <button onclick="cancelAddParty()" class="btn btn-primary w-45">Cancel</button>
                </div>
            </div>

            <div id="partyList" class="table mx-1 my-1" style="visibility: hidden";>
                <table border="1" id="partyTable">
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

            <div id="addCandidate" class="addCandidate mx-1">
                <!-- <label for="Position">Election Position: </label>
                <select name="position" id="positionList">
                    <option value="1"> Head </option>
                    <option value="2"> Vice </option>
                    <option value="3"> Secretary </option>
                    <option value="4"> Treasurer </option>
                </select><br> -->
                <label for="cPosition" class="my-1">Election Position: </label>
                <select name="" id="positionListCandidate">
                    <?php
                    $c = 0;
                    $s = "";
                    foreach($data["positionName"] as $key => $value){
                        echo "<option value='".$data["positionId"][$key]."'>".$value."</option>";
                        $s = $s.$value."-".$data["positionId"][$key]."|";
                        $c++;
                    }
                    echo "<input type='hidden' id='positionData' value='".$s."'>";
                    echo "<input type='hidden' id='positionCount' value='".$c."'>";
                    ?>
                </select><br>
                <div class="my-1">
                    <label for="cName">Candidate Name: </label>
                    <input type="text" id="cName"><span id="cNameError"></span><br>
                    <div class="my-1"><label for="cEmail">Candidate Email:</label>
                        <input type="email" id="cEmail"><span id="cEmailError"></span><br></div>
                    <div class="my-1"><label for="cParty">Candidate Party: </label>
                        <select name="" id="partyListCandidate"></select></div>
                </div>
                <button onclick="addCandidateToList()" class="btn btn-primary w-45">Add Candidate</button>

                <div id="candidateList" class="d-flex my-1"></div>
            </div>
            <div class="my-1">
                <form action="<?php echo urlroot; ?>/Elections/insertParty" id="submissionForm" method="POST" class="d-flex justify-content-end">
                    <input type="hidden" name="electionId" value="<?php echo $data['electionId'];?>">
                    <button type="submit" class="btn btn-primary mx-1 w-45">SUBMIT</button>
                </form>
            </div>
        </div>
        <div class="nonHumansDiv text-center text-xl" id="nonHumansDiv" style="display: none;">
            Non humans
        </div>
    </div>
</div>

<script src="<?php echo urlroot; ?>/js/addCandidates.js"></script>
<?php require approot . '/View/inc/footer.php'; ?>

