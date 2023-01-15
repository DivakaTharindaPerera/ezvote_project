<?php require approot . '/View/inc/header.php'; ?>

    <style>
        span{
            color: red;
        }
    </style>
    <div class="top_nav_bar">
        <?php
            require_once(approot."/View/topnavbar.php");
        ?>
    </div>
</head>
<body>

<div class="candidate">
    <label for="type">This election is for: </label>
    <input type="radio" name="type" id="humanRadio" onclick="displayDiv()"><label for="humanRadio">Humans</label>
    <input type="radio" name="type" id="nonHumanRadio" onclick="displayDiv()"><label for="nonHumanRadio">Non-Humans</label>

    <div class="humansDiv" id="humansDiv" style="display: none;">
        humans <br>
        
        <button onclick="createParty()">Create Party</button><br>
        <div class="partyCreate" id="createParty" style="display: none;" >
            <label for="party">Party name: </label>
            <input type="text" id="partyName"><span id="partyNameError"></span><br>
            
            <div id="partySup">
                <label for="partySup">Party Supervisor </label><br>
                <label for="email">Email: </label><input type="email" id="partySupEmail"> <span id="supEmailError"></span><br>
                <label for="name">Name: </label> <input type="text" id="partySupName"> <span id="supNameError"></span><br>
            </div>

            <button onclick="addParty()">Add Party</button>
            <button onclick="cancelAddParty()">Cancel</button>
        </div>

        <div id="partyList">
            <table border="1" id="partyTable" style="visibility: hidden;">
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

        <div id="addCandidate" class="addCandidate">
        <!-- <label for="Position">Election Position: </label>
        <select name="position" id="positionList">
            <option value="1"> Head </option>
            <option value="2"> Vice </option>
            <option value="3"> Secretary </option>
            <option value="4"> Treasurer </option>
        </select><br> -->
            <label for="cPosition">Election Position: </label>
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
            <label for="cName">Candidate Name: </label>
            <input type="text" id="cName"><span id="cNameError"></span><br>
            <label for="cEmail">Candidate Email:</label>
            <input type="email" id="cEmail"><span id="cEmailError"></span><br>
            <label for="cParty">Candidate Party: </label>
            <select name="" id="partyListCandidate">

            </select>

            <button onclick="addCandidateToList()">Add Candidate</button>
        
            <div id="candidateList">
            </div>
        
        </div>
        <form action="<?php echo urlroot; ?>/Elections/insertParty" id="submissionForm" method="POST">
            <input type="hidden" name="electionId" value="<?php echo $data['electionId'];?>">
            <button type="submit">SUBMIT</button>
        </form>
    </div><br>
    <div class="nonHumansDiv" id="nonHumansDiv" style="display: none;">
        non humans
    </div><br>

    

</div>
<script src="<?php echo urlroot; ?>/js/addCandidates.js"></script>
<?php require approot . '/View/inc/footer.php'; ?>

