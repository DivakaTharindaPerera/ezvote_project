<?php
//echo '<pre>';
//print_r($data['supervisingConferences']);
//exit();
require approot.'/View/inc/VoterHeader.php';
require approot.'/View/inc/AuthNavbar.php';
require approot.'/View/inc/sidebar-new.php';
?>
<div class="main-container">
    <div class="title">My Conferences</div>
    <div class="d-flex flex-wrap justify-content-evenly my-1 border border-white border-radius-2 border-5 min-w-80 max-w-80 bg-info">
        <?php
        if (!empty($data['supervisingConferences'])):
            foreach ($data['supervisingConferences'] as $conference){?>
                <div class="card my-1">
                    <div class="text-xl"><?php echo $conference->ConferenceName?></div>
                    <div class="">
                        <img src="" alt="">
                    </div>
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
            <div class="text-xl text-primary mb-1">No Conferences</div>
        <?php endif;?>
    </div><div class="title">SCHEDULE CONFERENCE</div>
    <div class="justify-content-center align-items-center bg-white-0-7 border-radius-2 shadow w-50 mb-2">
        <form action="/ezvote/pages/addConference/<?php echo $data['electionID']?>" method="post" class="form-grid mx-1 my-1">
            <div class="mb-1">
                <label for="conferenceName">Conference Name</label>
                <input type="text" name="conferenceName" placeholder="Conference Name" class="border-primary border-1 border-radius-1 w-100">
            </div>
            <div class="mb-1">
                <label for="date">Date</label>
                <input type="date" name="date" placeholder="Date" class="border-primary border-1 border-radius-1 w-100" >
            </div>
            <div class="mb-1">
                <label for="time">Time</label>
                <input type="time" name="time" placeholder=" Time" class="border-primary border-1 border-radius-1 w-100" >
            </div>
<!--            <div>-->
<!--                <div class="text-xl text-center">Add Candidates</div>-->
<!--                <div class="d-flex my-1">-->
<!--                    <div class="justify-content-evenly">-->
<!--                        <input id="all" type="radio" name="candidate" value="all">-->
<!--                        <label for="all" class="mr-2">All Candidates</label>-->
<!--                        <input id="some" type="radio" name="candidate" value="some">-->
<!--                        <label for="some">Selected Candidates</label>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="my-1 selectCandidates">-->
<!--                    <label for="SelectCandidate">Candidate</label>-->
<!--                    <select id="SelectCandidate" name="candidateID" class="select border-box w-25 mx-1">-->
<!--                        --><?php //foreach ($data['candidates'] as $candidate){?>
<!--                            <option value="--><?php //echo $candidate->candidateId?><!--">--><?php //echo $candidate->candidateName?><!--</option>-->
<!--                        --><?php //}?>
<!--                    </select>-->
<!--                </div>-->
<!--                <div class="d-flex my-1">-->
<!--                    <button class="btn btn-primary" type="button" onclick="AddCandidate()">Add Candidate</button>-->
<!--                </div>-->
<!--                <div id="Cdata" class="none">-->
<!---->
<!--                </div>-->
<!--                <div class="table" id="candidateList">-->
<!--                    <table id="Ctable">-->
<!--                        <thead>-->
<!--                        <tr>-->
<!--                            <th>Candidate Name</th>-->
<!--                            <th>Email</th>-->
<!--                        </tr>-->
<!--                        </thead>-->
<!--                        <tbody id="list">-->
<!--                        --><?php //foreach ($data['candidates'] as $candidate){?>
<!--                            <tr id="--><?php //=$candidate->candidateId?><!--" class="none">-->
<!--                                <td>--><?php //echo $candidate->candidateName?><!--</td>-->
<!--                                <td>--><?php //echo $candidate->candidateEmail?><!--</td>-->
<!--                            </tr>-->
<!--                        --><?php //}?>
<!--                        </tbody>-->
<!--                    </table>-->
<!--                </div>-->
<!--            </div>-->
            <div>
                <div class="text-xl text-center my-1">Add Participants</div>
                <div>
                    <div class="d-flex align-items-center justify-content-center my-1">
                        <input id="candidates" type="checkbox" name="candidate" class="mr-1" value="yes" checked>
                        <label for="candidates" class="mr-2">All Candidates</label>
                        <input id="voters" type="checkbox" name="voter" class="mr-1" value="yes" checked>
                        <label for="voters">All Voters</label>
                    </div>
                </div>
                <div class="text-center text-xl font-bold">Participants receive information via mail</div>
            </div>
            <div class="d-flex justify-content-center align-items-center my-1">
                <input type="submit" class="btn btn-primary" value="Schedule Conference">
            </div>
        </form>
    </div>
</div>
<script src="<?php echo urlroot?>/js/conference.js"></script>
<?php require approot.'/View/inc/footer.php';?>
