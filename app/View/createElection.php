<?php require approot.'/View/inc/header.php'; ?>
    <div class="top_nav_bar">
        <?php
            require_once("topnavbar.php");
        ?>
    </div>
    <br>
    <div class="pagecontent center">
    <h1><u>Create new election</u></h1><br>
    <div class="form">
    <form method="POST" action='<?php echo urlroot; ?>/Elections/crteelection'>
        <div class="orgName">
        Organization name: <input type="text" id="orgName" name="orgName" class="text"><br>
        </div>
        <div class="title">
        Election/ballot title: <input type="text" id="electionTitle" name="electionTitle" class="text" ><br>
        </div>
        <div class="description">
        Description: <br><br>
        <textarea id="description" cols="50" rows="10" name="description">Enter description of the election and other rules and regulations.... </textarea><br>
        </div>
        <div class="startDT">
        Election start date: <input type="date" id="EstartDate" name="EstartDate" class="date" > &emsp14; Time: <input type="time" id="EstartTime" name="EstartTime" class="time" ><br><br>
        </div>
        <div class="endDT">
        Election end date: <input type="date" id="EendDate" name="EendDate" class="date" > &emsp14; Time: <input type="time" id="EendTime" name="EendTime" class="time" ><br><br>
        </div>
        <div class="objectionStatus">
        <input type="checkbox"  id="showStat" name="objectionstatus" value="1">Allow objections against candidates<br><br>
        </div>
        <div class="objstartDT">
        Objection period start date: <input type="date" id="OstartDate" name="OstartDate" class="date"> &emsp14; Time: <input type="time" id="OtartTime" name="OstartTime" class="time" ><br><br>
        </div>
        <div class="objendDT">
        Objection period end date: <input type="date" id="OendDate" name="OendDate" class="date"> &emsp14; Time: <input type="time" id="OendTime" name="OendTime" class="time" ><br><br><br>
        </div>
        <!-- <b>Positions</b><br>
        <input type="text" id="positionName" value="Position name...."><br>
        No of options per voter for the position : <input type="text" id="noOfChoices"> &emsp; <button onclick="">ADD</button><br>
        <table>
            
        </table> -->
        <div class="stat">
        <input type="checkbox"  id="showStat" name="statVisibality" value="1">Show ongoing status to the voters and candidates <br><br>
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
        <input class="submitbtn" type="submit" value="SUBMIT">
        <a href="Supervisor_session.php"><div class="cancel">CANCEL</div></a>  
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

<?php require approot.'/View/inc/footer.php'; ?>