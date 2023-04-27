<?php
//print_r($_SESSION);
//exit();
require approot.'/View/inc/VoterHeader.php';
require approot.'/View/inc/AuthNavbar.php';
require approot.'/View/inc/sidebar-new.php';
?>
<div class="main-container">
    <div class="title">SCHEDULE CONFERENCE</div>
    <div class="justify-content-center align-items-center bg-white-0-7 border-radius-2 shadow w-50">
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
            <div>
                <div class="text-xl text-center">Add Candidates</div>
                <div class="d-flex my-1">
                    <div class="justify-content-evenly">
                        <input id="all" type="radio" name="candidate" value="all">
                        <label for="all" class="mr-2">All Candidates</label>
                        <input id="some" type="radio" name="candidate" value="some">
                        <label for="some">Selected Candidates</label>
                    </div>
                </div>
                <div class="my-1 selectCandidates">
                <label for="SelectCandidate">Candidate</label>
                <select id="SelectCandidate" name="candidateID" class="select border-box w-25 mx-1">
                    <?php foreach ($data['candidates'] as $candidate){?>
                        <option value="<?php echo $candidate->candidateId?>"><?php echo $candidate->candidateName?></option>
                    <?php }?>
                </select>
                </div>
                <div class="d-flex my-1">
                    <button class="btn btn-primary" type="button" onclick="AddCandidate()">Add Candidate</button>
                </div>
                <div id="Cdata" class="none">

                </div>
                <div class="table" id="candidateList">
                    <table id="Ctable">
                        <thead>
                        <tr>
                            <th>Candidate Name</th>
                            <th>Email</th>
                        </tr>
                        </thead>
                        <tbody id="list">
                        <?php foreach ($data['candidates'] as $candidate){?>
                            <tr id="<?=$candidate->candidateId?>" class="none">
                                <td><?php echo $candidate->candidateName?></td>
                                <td><?php echo $candidate->candidateEmail?></td>
                            </tr>
                        <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="d-flex justify-content-center align-items-center my-1">
                <input type="submit" class="btn btn-primary" value="Schedule Conference">
            </div>
        </form>
    </div>
</div>
<script src="<?php echo urlroot?>/js/conference.js"></script>
<?php require approot.'/View/inc/footer.php';?>
