<?php require approot.'/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>
<?php require approot.'/View/inc/sidebar-new.php';?>

<div class="main-container">
    <div class="d-flex flex-column bg-white mt-2 min-w-60 border-3 border-radius-2 border-primary mb-2 ">
        <div class="title">Create New Election</div>
        <form method="POST" action='<?php echo urlroot; ?>/Elections/crteelection' class="d-flex flex-column justify-content-center mx-1 mb-1">
            <div class="d-flex flex-column my-1">
                <div>Organization name: </div>
                <div><input type="text" id="orgName" name="orgName" class="text border border-primary border-1 border-radius-1" required></div>
            </div>
            <div class="d-flex flex-column my-1">
                <div>Election/ballot title:</div>
                <div><input type="text" id="electionTitle" name="electionTitle" class="text border border-primary border-1 border-radius-1" required></div>
            </div>
            <div class="d-flex flex-column my-1">
                <div>Description:</div>
                <textarea id="description" cols="50" rows="10" name="description" class="border-1 w-100 border-radius-1 px-1 py-1" placeholder="Enter description of the election and other rules and regulations.... "></textarea><br>
            </div>
            <div class="d-flex justify-content-evenly">
                <div class="card">
                    <div> <img src="<?php echo urlroot;?>/public/img/start.png" alt="" style="max-height: 40px;max-width:40px"></div>
                    <div class="justify-content-center text-lg mb-1">Commencing</div>
                    <div class="justify-content-start mb-1">
                        Date: <input type="date" id="EstartDate" name="EstartDate" class="date" onchange="dateCheck()" required>
                    </div>
                    <div class="justify-content-start mb-1">
                        &emsp14;Time: <input type="time" id="EstartTime" name="EstartTime" class="time" onchange="timeCheck()" required>
                    </div>
                </div>
                <div class="card">
                    <div class="mt-1"> <img src="<?php echo urlroot;?>/public/img/endtime.png" alt="" style="max-height: 40px;max-width:40px"></div>
                    <div class="justify-content-center text-lg mb-1">Ending</div>
                    <div class="justify-content-start mb-1">
                        Date: <input type="date" id="EendDate" name="EendDate" class="date" onchange="dateCheck()" required>
                    </div>
                    <div class="justify-content-start mb-1">
                        Time: <input type="time" id="EendTime" name="EendTime" class="time" onchange="timeCheck()" required>
                       <em id="out" style="color:red;"></em>
                    </div>&emsp14;
                </div>
            </div>
            <div class="d-flex flex-column justify-content-center">
                <div class="d-flex flex-column my-1 justify-content-center text-lg">
                    <div>
                        <input type="checkbox"  id="objStatus" name="objectionstatus" value="1" onclick="ObjStatus()" class="mr-1 checkmark">Allow objections against candidates
                    </div>
                    <div class="flex-column border-primary border-radius-1 border-2 mt-1" id="objstart" style="display: none;">
                        <div class="text-center my-1">Objection Period</div>
                        <div class="d-flex justify-content-evenly mb-1" >
                            <div class="d-flex flex-column">
                                <div>
                                    Start date: <input type="date" id="OstartDate" name="OstartDate" class="date" onchange="dateCheckO()" disabled>
                                </div>
                                <div>&emsp14;
                                    Time: <input type="time" id="OstartTime" name="OstartTime" class="time" onchange="timeCheckO()" disabled>
                                </div>
                            </div>
                            <div class="d-flex" id="objend" style="display: none;">
                                <div>
                                    <div>
                                        End date: <input type="date" id="OendDate" name="OendDate" class="date" onchange="dateCheckO()" disabled> &emsp14;
                                    </div>
                                    <div>
                                        Time: <input type="time" id="OendTime" name="OendTime" class="time" onchange="timeCheckO()" disabled><br>
                                        <em id="out1" style="color:red;"></em>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


    <!-- <b>Positions</b><br>
    <input type="text" id="positionName" value="Position name...."><br>
    No of options per voter for the position : <input type="text" id="noOfChoices"> &emsp; <button onclick="">ADD</button><br>
    <table>

    </table> -->
                <div class="mb-1 justify-content-center text-lg">
                    <input type="checkbox"  id="showStat" name="statVisibality" value="1" class="mr-1 checkmark">Show ongoing status to the voters and candidates
                </div>
                <div class="my-1 justify-content-center text-lg">
                    <input type="checkbox"  id="selfNomi" name="selfnomination" value="1" class="mr-1" onclick="Snomi()">Allow self nominations
                </div>
                <div class="mb-1">
                    <textarea id="nomi-description" cols="50" rows="10" name="nomi_description" disabled placeholder="Enter description that should be displayed when self nominations.... " class="border-1 border-radius-1 w-100 px-1 py-1" ></textarea>
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
</div>

-->
            <div class="d-flex justify-content-between">
                <input class="btn btn-danger w-25" type="submit" id="sbmit" value="CANCEL">
                <!--            <a href='--><?php //echo urlroot ?><!--'><div class="cancel">CANCEL</div></a>-->
                <input class="btn btn-primary w-25" type="submit" id="sbmit" value="SUBMIT">
            </div>

        </form>
    </div>


</div>




    <!-- <div class="bot_nav_bar">
        <?php
    // require_once("bottomnavbar.php");
    ?>
    </div> -->
    <script src="<?php echo urlroot; ?>/js/createElection.js"></script>
<?php require approot.'/View/inc/footer.php'; ?>