<?php
//echo '<pre>';
//print_r($data['data6']);
//exit();
require approot.'/View/inc/VoterHeader.php';
require approot.'/View/inc/AuthNavbar.php';
require approot.'/View/inc/sidebar-new.php';
?>
<div class="main-container">
    <div id="Elections" class="w-95 d-flex flex-column my-1" style="z-index: 2">
        <div id="ongoingElections" class="d-flex flex-column mb-1" style="justify-content: center;align-items: center">
            <div class="sub-title dark-title ">ONGOING ELECTIONS</div>
            <div class="d-flex mx-auto flex-wrap justify-content-center align-items-center">
                <div class="d-flex flex-column justify-content-center align-items-center bg-white-0-7 border-radius-2 shadow mx-2 min-h-37vh">
                    <div class="d-flex text-xl justify-content-center align-items-center my-1">Supervising Elections</div>
                    <div class="d-flex justify-content-center align-items-center mb-1 mx-1">
                        <?php if ($data['data1'] == null){?>
                            <div class="d-flex flex-column text-center text-primary text-xl" style="align-items: center">No Ongoing Elections</div>
                        <?php }
                        else{
                            foreach ($data['data1'] as $row){
                                $id=$row->ElectionId;
                                ?>
                                <div class="d-flex flex-column bg-secondary p-1 border-radius-3 card" style="align-items: center">
                                    <div id="election-title" class="title"><?php echo $row->Title?></div>
                                    <!--                    <div class="text-center text-lg">by</div>-->
                                    <div id="election-title" class="sub-title"><?php echo $row->OrganizationName?></div>
                                    <div class="d-flex flex-column justify-center align-center">
                                        <div id="time" class="mx-1 text-info text-lg blink">
                                            <?php
                                            $now = new DateTime();
                                            try {
                                                $end_date = new DateTime($row->EndDate . " " . $row->EndTime);
                                            } catch (Exception $e) {
                                            }
                                            $interval = $end_date->diff($now);
                                            echo $interval->format("%h hours, %i minutes");
                                            ?>
                                        </div>
                                        <button class="btn btn-primary"  onclick="ongoing_summary('<?=$id?>')">View</button>
                                    </div>
                                </div>
                            <?php }
                        }?>
                    </div>
                </div>
                <div class="d-flex flex-column justify-content-center align-items-center bg-white-0-7 border-radius-2 shadow mx-2 min-h-37vh">
                    <div class="d-flex text-xl justify-content-center align-items-center my-1">Elections for Voting</div>
                    <div class="d-flex justify-content-center align-items-center mb-1 mx-1">
                    <?php if ($data['data4']== null){?>
                    <div class="d-flex flex-column text-center text-primary text-xl" style="align-items: center">No Ongoing Elections</div>
                    <?php }
                    else{
                    foreach ($data['data4'] as $row){
                        $id=$row->ElectionId;
                        ?>
                        <div class="d-flex flex-column bg-secondary p-1 border-radius-3 card" style="align-items: center">
                            <div id="election-title" class="title"><?php echo $row->Title?></div>
                            <!--                    <div class="text-center text-lg">by</div>-->
                            <div id="election-title" class="sub-title"><?php echo $row->OrganizationName?></div>
                            <div class="d-flex flex-column justify-center align-center">
                                <div id="time" class="mx-1 text-info text-lg blink">
                                    <?php
                                    $now = new DateTime();
                                    try {
                                        $end_date = new DateTime($row->EndDate . " " . $row->EndTime);
                                    } catch (Exception $e) {
                                    }
                                    $interval = $end_date->diff($now);
                                    echo $interval->format("%h hours, %i minutes");
                                    ?>
                                </div>
                                <button class="btn btn-primary"  onclick="vote('<?=$id?>')">Vote</button>
                            </div>
                        </div>
                    <?php }
                }?>
                    </div>
                </div>
            </div>
        </div>
<!--        <hr class="w-100 h-10" style="color: var(--primary)">-->
        <div id="ongoingElections" class="d-flex flex-column mb-1 " style="justify-content: center;align-items: center">
            <div class="sub-title dark-title">UPCOMING ELECTIONS</div>
            <div class="d-flex mx-auto flex-wrap justify-content-center align-items-center">
                <div class="d-flex flex-column flex-wrap justify-content-center align-items-center bg-white-0-7 border-radius-2 shadow mx-2 min-h-37vh">
                    <div class="d-flex text-xl justify-content-center align-items-center my-1">Supervising Elections</div>
                    <div class="d-flex justify-content-center align-items-center mb-1 mx-1">
                    <?php if ($data['data2'] == null ){?>
                        <div class="d-flex flex-column text-center text-primary text-xl mx-1" style="align-items: center">No Upcoming Elections</div>
                    <?php }
                    else{
                        foreach ($data['data2'] as $row){?>
                            <?php $id=$row->ElectionId;?>
                            <div class="d-flex bg-secondary p-1 border-radius-3 card" style="align-items: center">
                                <div id="election-title" class="title"><?php echo $row->Title?></div>
                                <div id="election-title" class="sub-title"><?php echo $row->OrganizationName?></div>
                                <div class="d-flex flex-column justify-center align-center">
                                    <div id="time" class="mx-1 text-info">
                                        <?php
                                        $now = new DateTime();
                                        try {
                                            $start_date = new DateTime($row->StartDate . " " . $row->StartTime);
                                        } catch (Exception $e) {
                                        }
                                        $interval = $start_date->diff($now);
                                        echo $interval->format("%d days %h hours, %i minutes");
                                        ?>
                                    </div>
                                    <button class="btn btn-primary" onclick="viewElection(<?=$id?>)">View</button>
                                </div>
                            </div>
                        <?php }
                    }?>
                    </div>
                </div>
                <div class="d-flex flex-column flex-wrap justify-content-center align-items-center bg-white-0-7 border-radius-2 shadow mx-2 min-h-37vh">
                    <div class="d-flex text-xl justify-content-center align-items-center my-1">Elections as Voter</div>
                    <div class="d-flex justify-content-center align-items-center mb-1 mx-1">
                    <?php if ($data['data5']==null){?>
                        <div class="d-flex flex-column text-center text-primary text-xl mx-1" style="align-items: center">No Upcoming Elections</div>
                    <?php }
                    else{
                        foreach ($data['data5'] as $row){?>
                            <?php $id=$row->ElectionId;?>
                            <div class="d-flex bg-secondary p-1 border-radius-3 card" style="align-items: center">
                                <div id="election-title" class="title"><?php echo $row->Title?></div>
                                <div id="election-title" class="sub-title"><?php echo $row->OrganizationName?></div>
                                <div class="d-flex flex-column justify-center align-center">
                                    <div id="time" class="mx-1 text-info">
                                        <?php
                                        $now = new DateTime();
                                        try {
                                            $start_date = new DateTime($row->StartDate . " " . $row->StartTime);
                                        } catch (Exception $e) {
                                        }
                                        $interval = $start_date->diff($now);
                                        echo $interval->format("%h hours, %i minutes");
                                        ?>
                                    </div>
                                    <button class="btn btn-primary" onclick="viewElection(<?=$id?>)">View</button>
                                </div>
                            </div>
                        <?php }

                    }?>
                    </div>
                </div>
            </div>
        </div>
<!--        <hr class="w-100">-->
        <div id="ongoingElections" class="d-flex flex-column mb-1" style="justify-content: center;align-items: center">
            <div class="sub-title dark-title ">COMPLETED ELECTIONS</div>
            <div class="d-flex justify-content-center align-items-center">
                <div class="d-flex flex-column justify-content-center align-items-center bg-white-0-7 border-radius-2 shadow mx-2">
                    <div class="d-flex text-xl justify-content-center align-items-center my-1 text-center">Supervised Elections</div>
                    <div class="d-flex justify-content-center align-items-center mb-1 mx-1">
                    <?php if ($data['data3'] == null){?>
                    <div class="d-flex flex-column text-center text-primary text-xl" style="align-items: center">No Completed Elections</div>
                    <?php }
                    else{
                    foreach ($data['data3'] as $row){?>
                    <div class="d-flex bg-secondary p-1 border-radius-3 card" style="align-items: center">
                        <?php $id=$row->ElectionId;?>
                        <div id="election-title" class="title"><?php echo $row->Title?></div>
                        <div id="election-title" class="sub-title"><?php echo $row->OrganizationName?></div>
                        <div class="d-flex flex-column justify-center align-center">
                            <button class="btn btn-primary" onclick="viewSummaryForSupervisor('<?=$id?>')">View</button>
                        </div>
                    </div>
                    <?php }
                    }?>
                    </div>
                </div>
                <div class="d-flex flex-column justify-content-center align-items-center bg-white-0-7 border-radius-2 w-75 shadow mx-2">
                    <div class="d-flex text-xl justify-content-center align-items-center my-1">Elections as Voter/Candidate</div>
                    <div class="d-flex justify-content-center align-items-center flex-wrap mb-1 mx-1">
                        <?php if ($data['data6'] == null){?>
                            <div class="d-flex flex-column text-center text-primary text-xl" style="align-items: center">No Completed Elections</div>
                        <?php }
                        else{
                            foreach ($data['data6'] as $row){?>
                                <?php $id=$row->ElectionId;
                                if($row->StatVisibality==1){?>
                                    <div class="d-flex bg-secondary p-1 border-radius-3 card" style="align-items: center">
                                        <div id="election-title" class="title"><?php echo $row->Title?></div>
                                        <div id="election-title" class="sub-title"><?php echo $row->OrganizationName?></div>
                                        <div class="d-flex flex-column justify-center align-center">
                                            <button class="btn btn-primary" onclick="viewSummary('<?=$id?>')">View</button>
                                        </div>
                                    </div>
                                <?php }
                                else{?>
                                    <div class="d-flex bg-secondary p-1 border-radius-3 card" style="align-items: center">
                                        <div id="election-title" class="title"><?php echo $row->Title?></div>
                                        <div id="election-title" class="sub-title"><?php echo $row->OrganizationName?></div>
                                        <div class="d-flex flex-column justify-center align-center">
                                            <button class="btn btn-primary" onclick="viewSummaryRestricted()">View</button>
                                            <div class="dialog-box-outer" id="popup">
                                                <div class="popup mx-1 my-1 px-1 py-1 max-w-50 max-h-50 border-radius-2 border-primary border-3" >
                                                    <div class="d-flex justify-content-end mb-1">
                                                        <a href="#" class="close-btn" onclick="closePopup()"><i class="fa-solid fa-xmark"></i></a>
                                                    </div>
                                                    <div class="d-flex text-xl justify-content-center align-items-center">Statistics are not visible to the public</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                            }
                        }?>
                    </div>
                </div>

        </div>
    </div>
    </div>
</div>
<script src="/ezvote/public/js/dashboard.js"></script>
<?php require approot.'/View/inc/footer.php';?>
