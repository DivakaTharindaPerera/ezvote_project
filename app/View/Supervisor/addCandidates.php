<?php //require approot . '/View/inc/header.php'; 
?>
<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>
<?php require approot . '/View/inc/sidebar-new.php'; ?>


<div class="main-container">
    <div class="w-80 mt-1 bg-white d-flex flex-column p-1">
        <input type="hidden" name="" id="electionId" value="<?php echo $data['ID'] ?>">
        <div class="title">Add Candidates</div>
        <div class="mt-2 w-80 mx-auto">
            <?php
            if (!empty($data['positions'])) {
                foreach ($data['positions'] as $position) {
            ?>
                    <div class="m-1 p-1 border-1 bg-bluew-1 d-flex flex-column border-radius-2">
                        <div class="d-flex">
                            <div class="sub-title my-auto"><?php echo $position->positionName; ?></div>
                            <div class="ml-auto my-auto"><button class="btn btn-primary text-xl" id="<?php echo $position->ID; ?>" onclick="addCandidate(this.id)">Add Candidate</button></div>
                        </div>
                        <div class="d-flex flex-column">
                            <?php
                            $flag = 0;

                            foreach ($data['candidates'] as $candidate) {
                                if ($candidate->positionId == $position->ID) {
                                    $flag = 1;
                                    break;
                                }
                            }

                            if ($flag == 1) {
                            ?>
                                <table class="mt-1">
                                    <tr>
                                        <th>Candidate Name</th>
                                        <th>Candidate Email</th>
                                        <th>Party</th>
                                    </tr>
                                    <?php
                                    foreach ($data['candidates'] as $candidate) {
                                        if ($candidate->positionId == $position->ID) {
                                    ?>
                                            <tr>
                                                <td><?php echo $candidate->candidateName; ?></td>
                                                <td><?php echo $candidate->candidateEmail; ?></td>
                                                <?php
                                                $f = 0;
                                                foreach ($data['parties'] as $party) {
                                                    if ($party->partyId == $candidate->partyId) {
                                                        echo "<td>" . $party->partyName . "</td>";
                                                        $f = 1;
                                                        break;
                                                    } 
                                                }
                                                if($f == 0){
                                                    echo "<td>No Party</td>";
                                                }
                                                ?>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </table>
                            <?php
                            }

                            ?>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<div class='text-2xl text-danger text-center my-1'>No positions added yet</div>";
            }
            ?>
        </div>
        <div id="popupForCandidate" class="popup-window-1 bg-secondary min-h-30 min-w-30 text-center border-1 border-radius-2">
            <div class="popup-window-1-content bg-light border-radius-2 w-45 h-50 p-1">
                <form action="<?php echo urlroot ?>/Elections/addSingleCandidate2" method="POST">
                    <div class="d-flex flex-column p-1">
                        <input type="hidden" name="id" value="<?php echo $data['ID'] ?>" class="mt-1">
                        <input type="hidden" name="positionId" value="" id="position" class="mt-1">
                        <div class="mt-1">
                            <input type="text" name="candidateName" class="mt-1" placeholder="Candidate Name..." required>
                        </div>
                        <div class="mt-1">
                            <input type="text" name="candidateEmail" class="mt-1" placeholder="Candidate Email..." required>
                        </div>
                        <div class="mt-1 d-flex">
                            <label for="" class="my-auto mr-1">Party: </label>    
                        <select name="party" id="" class="mt-1">
                                <option value="NULL">No Party</option>
                                <?php
                                foreach ($data['parties'] as $party) {
                                    echo "<option value='" . $party->partyId . "'>" . $party->partyName . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex mx-auto mt-3 mb-1">
                        <button class="btn btn-primary text-xl ml-auto mr-2 card-hover" type="submit">Add</button>
                        <button class="btn btn-danger text-xl mr-auto ml-2 card-hover" type="button" onclick="addCandidate()">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="mt-auto mb-2 mx-auto">
            <a href="<?php echo urlroot?>/Pages/createElectionSuccess" class="btn btn-primary text-2xl card-hover">Continue</a>
        </div>
    </div>
</div>

<script>
    const electionId = document.getElementById('electionId').value;
    const popupForCandidate = document.getElementById('popupForCandidate');

    function addCandidate(id = null) {
        if (popupForCandidate.style.display == 'none') {
            popupForCandidate.style.display = 'block';
            document.getElementById('position').value = id;
        } else {
            popupForCandidate.style.display = 'none';
        }
    }
</script>

<?php require approot . '/View/inc/footer.php'; ?>