<?php
require approot.'/View/inc/VoterHeader.php';
require approot.'/View/inc/AuthNavbar.php';
require approot.'/View/inc/sidebar-new.php';
?>
<div class="main-container">
    <div id="Elections" class="w-95 d-flex flex-column my-1" style="z-index: 2">
        <div id="ongoingElections" class="d-flex flex-column" style="justify-content: center;align-items: center">
            <div class="sub-title dark-title max-w-8">Ongoing Elections</div>
            <div class="d-flex mx-auto">
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
                                <button class="btn btn-primary"  onclick="vote('<?=$id?>')">Vote</button>
                            </div>
                        </div>
                    <?php }
                }?>

            </div>
        </div>
        <div id="ongoingElections" class="d-flex flex-column " style="justify-content: center;align-items: center">
            <div class="sub-title dark-title max-w-8">Upcoming Elections</div>
            <div class="d-flex mx-auto">
                <?php foreach ($data['data2'] as $row){?>
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
                <?php }?>
            </div>
        </div>
        <div id="ongoingElections" class="d-flex flex-column " style="justify-content: center;align-items: center">
            <div class="sub-title dark-title max-w-8">Completed Elections</div>
            <div class="d-flex mx-auto">
                <?php foreach ($data['data3'] as $row){?>
                <div class="d-flex bg-secondary p-1 border-radius-3 card" style="align-items: center">
                    <?php $id=$row->ElectionId;?>
                    <div id="election-title" class="title"><?php echo $row->Title?></div>
                    <div id="election-title" class="sub-title"><?php echo $row->OrganizationName?></div>
                    <div class="d-flex flex-column justify-center align-center">
                        <button class="btn btn-primary" onclick="viewSummary('<?=$id?>')">View</button>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>
    </div>
</div>
<?php require approot.'/View/inc/footer.php';?>
