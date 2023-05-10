<?php
//print_r($data['all_elections']) ;
//exit();
require approot.'/View/inc/VoterHeader.php';
require approot.'/View/inc/AuthNavbar.php';
require approot.'/View/inc/sidebar-new.php';
?>
<div class="main-container">
    <div class="title">My Conferences</div>
<!--    <div class="d-flex flex-column justify-content-end ml-auto absolute right-0 top-5">-->
<!--        <button type="button" class="btn btn-primary mr-2 mb-1" onclick="showElections()"><i class="fa-solid fa-plus"></i><br>Schedule Meeting</button>-->
<!--        <div class="none my-1 " id="dropdown-content">-->
<!--            --><?php
//            if (isset($data['elections']) and !empty($data['elections'])):
//                foreach ($data['elections'] as $election){?>
<!--                    <ul style="text-decoration: none;list-style-type: none" class="d-flex gap-1 justify-content-center align-items-center hover-effect">-->
<!--                    <li class="text-md text-primary">-->
<!--                        <a href="--><?php //echo urlroot.'/Pages/addConference/'.$election->ElectionId?><!--">--><?php //echo $election->OrganizationName?><!--</a>-->
<!--                    </li>-->
<!--                    </ul>-->
<!--                --><?php //}
//            else: ?>
<!--                <div class="text-xl text-primary mb-1">-->
<!--                    No Elections-->
<!--                </div>-->
<!---->
<!--                --><?php //endif;
//            ?>
<!---->
<!--        </div>-->
<!--    </div>-->
    <div class="d-flex flex-column bg-secondary justify-content-center align-items-center mx-1 mb-2 mt-1">
        <div class="d-flex flex-column bg-white-0-7 border-radius-2 shadow justify-content-center align-items-center mx-1 my-1 w-80">
            <div class="sub-title mx-1 my-1">SUPERVISING CONFERENCES</div>
<!--            `<div class="d-flex flex-wrap justify-content-evenly my-1">-->
<!--                --><?php
//                if (isset($data['ongoing_conferences']) and !empty($data['ongoing_conferences'])):
//                foreach ($data['ongoing_conferences'] as $conference){?>
<!--                    <div class="card my-1">-->
<!--                        <div class="text-xl">--><?php //echo $conference->ConferenceName?><!--</div>-->
<!--                        <div class="text-lg">--><?php //echo $conference->DateAndTime?><!--</div>-->
<!--                        <div class="sub-title">--><?php //echo $conference->ElectionID?><!--</div>-->
<!--                        <div class="sub-title">--><?php //echo $conference->SupervisorID?><!--</div>-->
<!--                        <div class="sub-title">--><?php //echo $conference->candidateID?><!--</div>-->
<!--                        <div class="btn btn-primary justify-content-center align-items-center w-50 mx-3">-->
<!--                            <a href="--><?php //echo $conference->ConferenceLink?><!--" class="text-white">Join</a>-->
<!--                            <button class=" btn btn-primary " onclick="joinMeeting(--><?php //=$conference->ConferenceLink?>
<!--                            //)">Join</button>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                --><?php //}
//                else:?>
<!--                    <div class="text-xl text-primary mb-1">No Ongoing Conferences</div>-->
<!--                --><?php //endif;?>
<!--            </div>`-->
            <div class="d-flex flex-wrap justify-content-evenly my-1">
                <?php
                if (isset($data['supervising_conferences']) and !empty($data['supervising_conferences'])):
                    foreach ($data['supervising_conferences'] as $conference){?>
                        <div class="card my-1">
                            <?php
                            foreach ($data['elections'] as $election){
                                if($election->ElectionId==$conference->ElectionID){
                                    $ename=$election->Title." ".$election->OrganizationName;
                                }
                            }?>
                            <div class="text-lg"><?php echo $ename?></div>
                            <div class="text-xl"><?php echo $conference->ConferenceName?></div>
                            <div class="">
                                <img src="" alt="">
                            </div>
                            <div class="text-lg text-info"><?php echo $conference->DateAndTime?></div>
                            <!--                        <div class="sub-title">--><?php //echo $conference->ElectionID?><!--</div>-->
                            <!--                        <div class="sub-title">--><?php //echo $conference->SupervisorID?><!--</div>-->
                            <!--                        <div class="sub-title">--><?php //echo $conference->candidateID?><!--</div>-->
                            <div class="btn btn-primary justify-content-center align-items-center w-50 mx-3">
                                <a href="<?php echo $conference->ConferenceLink?>" class="text-white">Join</a>
                                <!--                            <button class=" btn btn-primary " onclick="joinMeeting(--><?php //=$conference->ConferenceLink?>
                                <!--                            //)">Join</button>-->
                            </div>
                        </div>
                    <?php }
                else:?>
                    <div class="text-xl text-primary mb-1">No Conferences</div>
                <?php endif;?>
            </div>
        </div>
        <div class="d-flex flex-column bg-white-0-7 border-radius-2 shadow justify-content-center align-items-center mx-1 my-1 w-80">
            <div class="sub-title mt-1 mx-1">CONFERENCES AS CANDIDATES</div>
            <div class="d-flex my-1">
                <?php
                if(isset($data['candidating_conferences']) and !empty($data['candidating_conferences'])):
                    foreach ($data['candidating_conferences'] as $conference){
                        if($conference->ParticipantsC==1){?>
                        <div class="card mx-1 my-1">
                            <?php
                            foreach ($data['all_elections'] as $aElection){
                                if($aElection->ElectionId==$conference->ElectionID){
                                    $ename=$aElection->Title." ".$aElection->OrganizationName;
                                }
                            }?>
                            <div class="text-lg"><?php echo $ename?></div>
                            <div class="text-xl"><?php echo $conference->ConferenceName?></div>
                            <div class="text-lg text-info"><?php echo $conference->DateAndTime?></div>
<!--                            <div class="sub-title">--><?php //echo $conference->ElectionID?><!--</div>-->
<!--                            <div class="sub-title">--><?php //echo $conference->SupervisorID?><!--</div>-->
<!--                            <div class="sub-title">--><?php //echo $conference->candidateID?><!--</div>-->
                            <div class="btn btn-primary justify-content-center align-items-center w-50 mx-3">
                                <a href="<?php echo $conference->ConferenceLink?>" class="text-white">Join</a>
                                <!--                            <button class=" btn btn-primary " onclick="joinMeeting(--><?php //=$conference->ConferenceLink?>
                                <!--                            //)">Join</button>-->
                            </div>
                        </div>
                    <?php }
                    }
                    else:?>
                        <div class="text-xl text-primary mb-1">No Conferences</div>
                    <?php endif;?>
            </div>
        </div>
<!--        <div class="d-flex flex-column bg-white-0-7 border-radius-2 shadow justify-content-center align-items-center mx-1 my-1">-->
<!--            <div class="sub-title mt-1 mx-1">UPCOMING CONFERENCES</div>-->
<!--            <div class="d-flex my-1">-->
<!--                --><?php
//                if(isset($data['upcoming_conferences']) and !empty($data['upcoming_conferences'])):
//                foreach ($data['upcoming_conferences'] as $conference){?>
<!--                    <div class="card mx-1 my-1">-->
<!--                        <div class="text-xl">--><?php //echo $conference->ConferenceName?><!--</div>-->
<!--                        <div class="text-lg">--><?php //echo $conference->DateAndTime?><!--</div>-->
                        <!--                        <div class="sub-title">--><?php //echo $conference->ElectionID?><!--</div>-->
                        <!--                        <div class="sub-title">--><?php //echo $conference->SupervisorID?><!--</div>-->
                        <!--                        <div class="sub-title">--><?php //echo $conference->candidateID?><!--</div>-->
<!--                    </div>-->
<!--                --><?php //}
//                else:?>
<!--                    <div class="text-xl text-primary mb-1">No Upcoming Conferences</div>-->
<!--                --><?php //endif;?>
<!--            </div>-->
<!--        </div>-->
        <div class="d-flex flex-column bg-white-0-7 border-radius-2 shadow justify-content-center align-items-center mx-1 my-1 w-80">
            <div class="sub-title mt-1 mx-1">CONFERENCES AS Voters</div>
            <div class="d-flex my-1">
                <?php
                if(isset($data['voting_conferences']) and !empty($data['voting_conferences'])):
                    foreach ($data['voting_conferences'] as $conference){
                        if($conference->ParticipantsV==1){?>
                        <div class="card mx-1 my-1">
                            <?php
                            foreach ($data['all_elections'] as $aElection){
                                if($aElection->ElectionId==$conference->ElectionID){
                                    $ename=$aElection->Title." ".$aElection->OrganizationName;
                                }
                            }?>
                            <div class="text-lg"><?php echo $ename?></div>
                            <div class="text-xl"><?php echo $conference->ConferenceName?></div>
                            <div class="text-lg text-info"><?php echo $conference->DateAndTime?></div>
<!--                            <div class="sub-title">--><?php //echo $conference->SupervisorID?><!--</div>-->
<!--                            <div class="sub-title">--><?php //echo $conference->candidateID?><!--</div>-->
                            <div class="btn btn-primary justify-content-center align-items-center w-50 mx-3">
                                <a href="<?php echo $conference->ConferenceLink?>" class="text-white">Join</a>
                                <!--                            <button class=" btn btn-primary " onclick="joinMeeting(--><?php //=$conference->ConferenceLink?>
                                <!--                            //)">Join</button>-->
                            </div>
                        </div>
                        <?php }
                    }
                else:?>
                    <div class="text-xl text-primary mb-1">No Conferences</div>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>
<script src="/ezvote/public/js/conference.js"></script>
<?php require approot.'/View/inc/footer.php';?>
