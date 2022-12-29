<?php require approot.'/View/inc/header.php'; ?>
    <div class="top_nav_bar">
        <?php
            require_once(approot."/View/topnavbar.php");
        ?>
    </div>
    <br>
    <div class="pagecontent center">
    <h1><u>Create new election</u></h1><br>
    <div class="form">
        
    <form method="POST" action='<?php echo urlroot; ?>/Elections/crteelection'>
        <div class="orgName">
        Organization name: <input type="text" id="orgName" name="orgName" class="text" required><br>
        </div>
        <div class="title">
        Election/ballot title: <input type="text" id="electionTitle" name="electionTitle" class="text" required><br>
        </div>
        <div class="description">
        Description: <br><br>
        <textarea id="description" cols="50" rows="10" name="description">Enter description of the election and other rules and regulations.... </textarea><br>
        </div>
        <div class="startDT">
        Election start date: <input type="date" id="EstartDate" name="EstartDate" class="date" onchange="dateCheck()" required> &emsp14; Time: <input type="time" id="EstartTime" name="EstartTime" class="time" onchange="timeCheck()" required><br><br>
        </div>
        <div class="endDT">
        Election end date: <input type="date" id="EendDate" name="EendDate" class="date" onchange="dateCheck()" required> &emsp14; Time: <input type="time" id="EendTime" name="EendTime" class="time" onchange="timeCheck()" required><br><br>
        <em id="out" style="color:red;"></em><br><br>
        </div>
        <div class="objectionStatus">
        <input type="checkbox"  id="objStatus" name="objectionstatus" value="1" onclick="ObjStatus()">Allow objections against candidates<br><br>
        </div>
        <div class="objstartDT" id="objstart" style="display: none;">
        Objection period start date: <input type="date" id="OstartDate" name="OstartDate" class="date" onchange="dateCheckO()" disabled> &emsp14; Time: <input type="time" id="OstartTime" name="OstartTime" class="time" onchange="timeCheckO()" disabled><br><br>
        </div>
        <div class="objendDT" id="objend" style="display: none;">
        Objection period end date: <input type="date" id="OendDate" name="OendDate" class="date" onchange="dateCheckO()" disabled> &emsp14; Time: <input type="time" id="OendTime" name="OendTime" class="time" onchange="timeCheckO()" disabled><br><br><br>
        <em id="out1" style="color:red;"></em><br><br>
        </div>
        <!-- <b>Positions</b><br>
        <input type="text" id="positionName" value="Position name...."><br>
        No of options per voter for the position : <input type="text" id="noOfChoices"> &emsp; <button onclick="">ADD</button><br>
        <table>
            
        </table> -->
        <div class="stat">
        <input type="checkbox"  id="showStat" name="statVisibality" value="1">Show ongoing status to the voters and candidates <br><br>
        </div>
        <div class="selfNomi">
        <input type="checkbox"  id="selfNomi" name="selfnomination" value="1" onclick="Snomi()">Allow self nominations<br><br>
        </div>
        <div class="nomidescr">
        <textarea id="nomi-description" cols="50" rows="10" name="nomi_description" disabled >Enter description that should be displayed when self nominations.... </textarea><br>
        </div>

        <!-- <b>Voters</b><br>
        Upload the CSV file to add voters............ <a href="">How to create CSV file</a><br><br>
        <form id="uploadForm">
            <input type="text" placeholder="for testing....."><br>
            <input type="file"  id="votersFile" accept=".txt"><br>
            
            <button type="submit" value="upload">Upload</button><br><br>
            <br>
            <p id="output">...output here...</p>
        </form>

        <script>
        document.getElementById("votersFile").addEventListener('change', function(e){
            e.preventDefault();

            var fr = new FileReader();
            fr.onload = function(){
                document.getElementById("output").textContent = fr.result;
            }
            console.log(fr.readAsText(this.files[0]));
            document.getElementById("output").innerHTML=readAsText(this.files[0]);
        })
        </script>  
        <table>
            
        </table>
    -->
    <br>
    <div class="submit">
        <input class="submitbtn" type="submit" id="sbmit" value="SUBMIT">
        <a href='<?php echo urlroot ?>'><div class="cancel">CANCEL</div></a>  
    </div>

    </form>
    </div>
    <br><br>
    
    
    </div>
    <br>
    <!-- <div class="bot_nav_bar">
        <?php
            // require_once("bottomnavbar.php");
        ?>
    </div> -->
    <script src="<?php echo urlroot; ?>/js/createElection.js"></script>
<?php require approot.'/View/inc/footer.php'; ?>