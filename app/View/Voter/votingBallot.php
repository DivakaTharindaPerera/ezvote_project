<?php
//echo '<pre>';
//print_r ($data['candidates']);
//exit();?>
<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>
<?php require approot . '/View/inc/sidebar-new.php'; ?>

<div class="main-container">
    <div class="title justify-content-center mt-1"><?php echo $data['election']->Title?><br><?php echo $data['election']->OrganizationName?></div>
    <div class="d-flex flex-column">
            <?php $i=0;
//            $voted=array();
            foreach ($data['positions'] as $position){
                $position_id=$position->ID;
                ?>
            <div class="d-flex flex-column">
                <div class="title"><?php echo $position->positionName?></div>
                <div class="d-flex justify-content-center flex-wrap">
                    <?php foreach ($data['candidates'] as $candidates){
                    if ($candidates->positionId==$position_id) {
                        $i=$i+1;?>
                        <div class="card" id="card-<?=$i?>">
                        <div class="d-flex flex-column">
                            <div class="sub-title">
                                <?php echo $candidates->candidateName?>
                            </div>
                            <div><img src="/ezvote/public/img/profile.jpg" style="max-height:50px;max-width: 50px" alt="profile photo"></div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="text-lg">BraveIo</div>
                        </div>
                        <div class="d-flex justify-content-center mb-1">
                            <button class="btn btn-primary min-w-50" id="1" onclick="marked(<?=$i?>)">Vote</button>
<!--                            --><?php //array_push($voted,)?>
                        </div>
                    </div>
                       <?php
                     }
                       ?>
                    <?php } ?>
                </div>
            </div>
            <?php } ?>
        <div class="d-flex justify-content-center mb-2">
                    <button class="btn btn-primary min-w-20 mx-2 my-1" onclick="openPopup()">Submit</button>
                    <div class="dialog-box-outer" id="popup">
                        <div class="dialog-box d-flex flex-column justify-content-center">
                            <?php foreach ($data['positions'] as $position){
//                            $position_id=$position->ID;
                            ?>
                            <div class="dialog-box-content 1border-primary border-1 border-radius-1 w-75 mb-1">
                                <div class="text-lg"><?= $position->positionName?></div>
                                <div class="bg-info text-lg px-1">Sandun Jayasanka</div>
                            </div>
                            <?php }?>
                            <div class="d-flex flex-column dialog-box-content">
                                <div class="text-lg text-danger">Confirm Votes?</div>
                                <div class="text-lg text-danger">You cant undo once you confirmed.</div>
                                <div class="dialog-box-content justify-content-evenly">
                                <div>
                                    <button class="btn btn-primary justify-content-end" onclick="confirmBallot()">Confirm</button>
                                </div>
                                <div>
                                    <button class="btn btn-danger justify-content-start" onclick="cancelBallot('<?= $data['id']?>')">Cancel</button>
                                </div>
                                </div>
                            </div>
                    </div>
                </div>
                </div>
    </div>
</div>
<?php require approot . '/View/inc/footer.php'; ?>
