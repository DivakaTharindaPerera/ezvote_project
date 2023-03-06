<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>
<?php require approot.'/View/inc/sidebar-new.php';?>


<!--    <div class="top_nav_bar">-->
<!--            --><?php
//                require_once(approot."/View/topnavbar.php");
//            ?>
<!--    </div>-->
    <div class="main-container h-100">
        <?php
        // echo $data['electionRow']->ElectionId."<br>".$data['electionRow']->Title."<br>";

        // foreach($data['positionRow'] as $row){
        //     echo $row->positionName."<br>";
        //     echo $row->description."<br>";
        //     echo $row->NoofOptions."-".$row->ID."<br>";
        //     echo $row->ElectionID."<br><br>"."Candidates: "."<br>";
        //     $i = 0;
        //     foreach($data['candidateRow'] as $row1){
        //         $i++;
        //         if($row->ID == $row1->positionId){
        //             echo "$i. ".$row1->candidateName."<br>"; 
        //         } 
        //     }
        // }
        ?>
    <form action="<?php echo urlroot; ?>/Elections/updateElection" method="post" class="min-w-60 border-radius-1 border-3 border-primary my-2 w-100 overflow-y" id="updateForm">
        <div id="btn panel" class="d-flex text-center">
            <a href="<?php echo urlroot;?>/Pages/electionVoters/<?php echo $data['ID']?>" class="btn btn-primary m-3"> <div>Voters</div> </a>
            <a href="<?php echo urlroot;?>/Pages/electionCandidates/<?php echo $data['ID']?>" class="btn btn-primary m-3"> <div>Candidates & Positions</div> </a>
            <a href="<?php echo urlroot;?>/Pages/viewObjections" class="btn btn-primary m-3"> <div>Objections</div> </a>

        </div>
        <div id="information" class="card-pane d-flex flex-column">
            <input type="hidden" name="id" value="<?php echo $data['ID'] ?>">
            Title: <input type='text' name="title" value="<?php echo $data['electionRow']->Title ?>" disabled>
            Organization: <input type="text" name="org" value="<?php echo $data['electionRow']->OrganizationName; ?>" disabled>
            <div>
                <div class="text-lg mb-1">Description</div>
                <textarea name="desc" id="" cols="30" rows="10" class="border-1 w-100 border-radius-1" disabled>
                <?php echo $data['electionRow']->Description; ?>
                </textarea>
            </div>
            <div class="d-flex flex-column text-center" id="electionDateAndTime">
                <div id="elecTopic" class="text-center text-xl text-info">
                   Election Duration
                </div>
                <div class="d-flex justify-content-evenly">
                <div class="card">
                        <div> <img src="<?php echo urlroot;?>/public/img/start.png" alt="" style="max-height: 40px;max-width:40px"></div>
                        <div class="justify-content-center text-lg mb-1">Commencing</div>
                        <div class="justify-content-start mb-1">
                            Date: <input type="date" id="EstartDate" name="EstartDate" class="date" value="<?php echo $data['electionRow']->StartDate ?>" onchange="dateCheck()" required disabled>
                        </div>
                        <div class="justify-content-start mb-1">
                            &emsp14;Time: <input type="time" id="EstartTime" name="EstartTime" value="<?php echo $data['electionRow']->StartTime ?>" class="time" onchange="timeCheck()" required disabled>
                        </div>
                </div>
                <div class="card">
                        <div class="mt-1"> <img src="<?php echo urlroot;?>/public/img/end.png" alt="" style="max-height: 40px;max-width:40px"></div>
                        <div class="justify-content-center text-lg mb-1">Ending</div>
                        <div class="justify-content-start mb-1">
                            Date: <input type="date" id="EendDate" name="EendDate" class="date" value="<?php echo $data['electionRow']->EndDate ?>" onchange="dateCheck()" required disabled>
                        </div>
                        <div class="justify-content-start mb-1">
                            Time: <input type="time" id="EendTime" name="EendTime" class="time" value="<?php echo $data['electionRow']->EndTime ?>" onchange="timeCheck()" required disabled>
                        <em id="out" style="color:red;"></em>
                        </div>&emsp14;
                </div>
                </div>
            </div>
            <div id="checks" class="d-flex flex-column card-pane justify-content-center align-items-center">
                <div id="stat">
                    Status Visibality

                    <input type="checkbox" name="stat" id="" value="1"<?php if($data['electionRow']->StatVisibality == 1) echo "checked"; ?> disabled >
                </div>
                <div id="nomi">
                    Self Nomination
                    
                   <input type="checkbox" name="nomi" id="" value="1" <?php if($data['electionRow']->SelfNomination == 1) echo "checked"; ?> disabled >

                    <?php 
                        if($data['electionRow']->SelfNomination == 1){
                            echo "
                            <textarea name='nomiDesc' id='' cols='30' rows='10' disabled>
                                ".$data['electionRow']->NominationDescription."
                            </textarea>
                            ";
                        }
                    ?>
                </div>
                <div id="obj">
                    Objection Status

                    <input type="checkbox" name="ostat" id="" value="1" <?php if($data['electionRow']->ObjectionStatus == 1) echo "checked"; ?> disabled >

                </div>
            </div>
            
            <?php 
                if($data['electionRow']->ObjectionStatus == 1){
                    echo "
                    <div id='objDateAndTime' class='d-flex flex-column'>
                    <div id='objTopic' class='text-center'>
                       <h4> Objection Duration</h4>
                    </div>
                    <div class='d-flex'>
                    <div class='card'>
                            <div> <img src='".urlroot."/public/img/start.png' alt='' style='max-height: 40px;max-width:40px'></div>
                            <div class='justify-content-center text-lg mb-1'>Begin</div>
                            <div class='justify-content-start mb-1'>
                                Date: <input type='date' id='EstartDate' name='OstartDate' class='date' value='".$data['electionRow']->ObjectionStartDate."' onchange='dateCheck()' required disabled>
                            </div>
                            <div class='justify-content-start mb-1'>
                                &emsp14;Time: <input type='time' id='EstartTime' name='OstartTime' value='".$data['electionRow']->ObjectionStartTime."' class='time' onchange='timeCheck()' required disabled>
                            </div>
                    </div>
                    <div class='card'>
                            <div class='mt-1'> <img src='".urlroot."/public/img/end.png' alt='' style='max-height: 40px;max-width:40px'></div>
                            <div class='justify-content-center text-lg mb-1'>End</div>
                            <div class='justify-content-start mb-1'>
                                Date: <input type='date' id='EendDate' name='OendDate' class='date' value='".$data['electionRow']->ObjectionEndDate."' onchange='dateCheck()' required disabled>
                            </div>
                            <div class='justify-content-start mb-1'>
                                Time: <input type='time' id='EendTime' name='OendTime' class='time' value='".$data['electionRow']->ObjectionEndTime."' onchange='timeCheck()' required disabled>
                            <em id='out' style='color:red;'></em>
                            </div>&emsp14;
                    </div> 
                    </div>   
                </div>
                    ";
                }
            ?>
        </div>
        
    </form>
    <div class="text-center d-flex justify-content-end mb-1 mr-1" id="buttonContainer">
        <button type="button" onclick="edit()" class="btn btn-primary w-30 py-1" id="editBtn"><b>EDIT</b></button>
        <a href="<?php echo urlroot; ?>/Elections/removeElection/<?php echo $data['ID'];?>" class="btn btn-danger ml-1"><b>Delete Election</b></a>
    </div>
    </div>
<script src="<?php echo urlroot; ?>/js/createElection.js"></script>
<?php require approot . '/View/inc/footer.php'; ?>