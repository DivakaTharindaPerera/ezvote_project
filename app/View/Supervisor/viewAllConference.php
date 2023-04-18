<?php
//print_r($data['upcoming_conferences']) ;
//exit();
require approot.'/View/inc/VoterHeader.php';
require approot.'/View/inc/AuthNavbar.php';
require approot.'/View/inc/sidebar-new.php';
?>
<div class="main-container">
    <div class="title">My Conferences</div>
    <div class="d-flex flex-column bg-secondary justify-content-center align-items-center mx-1 my-1">
        <div class="d-flex flex-column bg-white-0-7 border-radius-2 shadow justify-content-center align-items-center mx-1 my-1">
            <div class="sub-title mx-1 my-1">ONGOING CONFERENCES</div>
            <div class="d-flex justify-content-evenly">
                <?php
                if (isset($data['ongoing_conferences']) and !empty($data['ongoing_conferences'])):
                foreach ($data['ongoing_conferences'] as $conference){?>
                    <div class="card my-1">
                        <div class="text-xl"><?php echo $conference->ConferenceName?></div>
                        <div class="text-lg"><?php echo $conference->DateAndTime?></div>
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
                    <div class="text-xl text-primary mb-1">No Ongoing Conferences</div>
                <?php endif;?>
            </div>
        </div>
        <div class="d-flex flex-column bg-white-0-7 border-radius-2 shadow justify-content-center align-items-center mx-1 my-1">
            <div class="sub-title mt-1 mx-1">UPCOMING CONFERENCES</div>
            <div class="d-flex my-1">
                <?php
                foreach ($data['upcoming_conferences'] as $conference){?>
                    <div class="card mx-1 my-1">
                        <div class="text-xl"><?php echo $conference->ConferenceName?></div>
                        <div class="text-lg"><?php echo $conference->DateAndTime?></div>
                        <!--                        <div class="sub-title">--><?php //echo $conference->ElectionID?><!--</div>-->
                        <!--                        <div class="sub-title">--><?php //echo $conference->SupervisorID?><!--</div>-->
                        <!--                        <div class="sub-title">--><?php //echo $conference->candidateID?><!--</div>-->
                    </div>
                <?php }
                ?>
            </div>
        </div>
    </div>
</div>
<script src="/ezvote/public/js/conference.js"></script>
<?php require approot.'/View/inc/footer.php';?>
