<?php
//echo '<pre>';
//print_r($data['positions']);
//exit();
require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>
<?php require approot . '/View/inc/sidebar-new.php'; ?>
<div class="main-container">
    <?php
    $partyVotes = array();
    foreach($data['parties'] as $party){
        $partyVotes[$party->partyName] = 0;
    }

    $keys = array_keys($data['votes']);
    // 
    // echo "Candidates : Votes <br>";
    // foreach ($keys as $key) {
    //     echo $key . " : " . $data['votes'][$key] . "<br>";
    // }
    $c = 0;
    $voted = 0;
    foreach ($data['voters'] as $voter) {
        $c++;
        if ($voter->cast == 1) {
            $voted++;
        }
    }
    ?>

    <input type="hidden" name="" id="votersCount" value="<?php echo $c ?>">
    <input type="hidden" name="" id="votedCount" value="<?php echo $voted ?>">
    <div class="title"><?= $data['election']->Title ?></div>
    <div class="sub-title"><?= $data['election']->OrganizationName ?></div>
    <div class="d-flex flex-column border-radius-2 border-primary border-1 my-1 min-w-30">
        <div class="d-flex text-xl justify-content-center my-1">Date and Time</div>
        <div class="d-flex text-x justify-content-center">From</div>
        <div class="d-flex justify-content-center align-items-center text-xl mb-1">
            <div id="time" class="mx-1 text-danger text-lg">
                <?php
                //                                $now = new DateTime();
                try {
                    $end_date = new DateTime($data['election']->StartDate . " " . $data['election']->StartTime);
                    //                                var_dump($end_date);
                    echo $end_date->format('Y-m-d H:i:s');
                } catch (Exception $e) {
                }
                //                                $interval = $end_date->diff($now);
                //                                echo $interval->format("%h hours, %i minutes");
                ?>
            </div>
        </div>
        <div class="d-flex text-x justify-content-center">To</div>
        <div class="d-flex justify-content-center align-items-center text-xl mb-1">
            <div id="time" class="mx-1 text-danger text-lg">
                <?php
                //                                $now = new DateTime();
                try {
                    $end_date = new DateTime($data['election']->EndDate . " " . $data['election']->EndTime);
                    //                                var_dump($end_date);
                    echo $end_date->format('Y-m-d H:i:s');
                } catch (Exception $e) {
                }
                //                                $interval = $end_date->diff($now);
                //                                echo $interval->format("%h hours, %i minutes");
                ?>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column my-1 bg-white-0-7 border-radius-2 w-75 shadow">
        <div class="d-flex mx-1 my-1 justify-content-center">
            <div class="d-flex flex-column mx-2 w-30">
                <div class="d-flex justify-content-center align-items-center text-xl">Voted Percentage</div>
                <div>
                    <canvas id="voted_state"></canvas>
                </div>
            </div>
            <?php if ($data['parties'] != NULL) { ?>
                <div class="d-flex flex-column mx-2 w-45">
                    <div class="d-flex justify-content-center align-items-center text-xl">Party Comparison</div>
                    <div class=" my-auto">
                        <canvas id="party_state"></canvas>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="d-flex flex-column mx-2 my-2">
        <!--                    <div class="d-flex my-1">-->
        <!--                        <div class="btn btn-primary">END ELECTION</div>-->
        <!--                    </div>-->
        <div class="d-flex flex-column mt-1 min-w-50 justify-content-center">
            <div class="d-flex sub-title justify-content-center align-items-center w-100">Selected Candidates</div>
            <div class="d-flex flex-wrap justify-content-center">
                <?php
                $candidatesForCheck = [];
                foreach ($data['candidates'] as $candidate) {
                    if (in_array($candidate->candidateEmail, $candidatesForCheck)) {
                        continue;
                    } else {
                ?>
                        <div class="bg-primary d-flex flex-column m-1 p-1 border-radius-2">
                            <div class="text-xl text-white">
                                <?php echo $candidate->candidateName ?>
                            </div>
                            <div class="text-xl text-white">
                                <?php echo $candidate->candidateEmail ?>
                            </div>
                        </div>
                <?php
                        array_push($candidatesForCheck, $candidate->candidateEmail);
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column mx-1 my-1">
        <div class="d-flex justify-content-center align-items-center sub-title mb-1">Votes</div>
        <div class="d-flex flex-wrap justify-content-center">
            <?php
            foreach ($data['positions'] as $position) { ?>
                <div class="d-flex flex-column mx-1 w-45">
                    <div class="text-xl text-center"><?= $position->positionName ?></div>
                    <div class="table my-1">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Candidate</th>
                                    <th scope="col">Votes</th>
                                    <th scope="col">Party</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $keys = array_keys($data['votes']);

                                foreach ($keys as $key) {
                                    foreach ($data['candidates'] as $candidate) {
                                        if ($candidate->candidateId == $key && $candidate->positionId == $position->ID) {
                                            echo "<tr>
                                                        <td>$candidate->candidateName</td>
                                                        <td>" . $data['votes'][$key] . "</td>";
                                            if ($candidate->partyId == NULL) {
                                                echo "<td>No Party</td>";
                                            } else {
                                                foreach ($data['parties'] as $party) {
                                                    if ($candidate->partyId == $party->partyId){
                                                        $partyVotes[$party->partyName] += $data['votes'][$key];
                                                        echo "<td>$party->partyName</td>";
                                                    }
                                                }
                                            }
                                            echo "</tr>";
                                        }
                                    }
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>
    <div style="display:none;">
        <?php 
            $jsonData = json_encode($partyVotes);
        ?>

        <?php
        $candidateArray = [];
        foreach ($data['candidates'] as $candidate) {
            echo "<tr>
                <td>$candidate->candidateName</td>";
            foreach ($data['positions'] as $position) {
                if ($position->ID == $candidate->positionId) {
                    echo "<td>$position->positionName</td>";
                }
            }
            if ($candidate->partyId != NULL) {
                foreach ($data['parties'] as $party) {
                    if ($party->ID == $candidate->partyId) {
                        echo "<td>$party->partyName</td>";
                    }
                }
            } else {
                echo "<td class='text-danger'>No Party</td>";
            }

            echo "</tr>";
        }
        ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    //for party comparison
    var votesInOrder = [];
    var partyVotes = JSON.parse('<?php echo $jsonData; ?>');
    console.log(partyVotes);
    let keys = Object.keys(partyVotes);

    for(let key of keys){
        votesInOrder.push(partyVotes[key]);
    }
    //end

    var votersCount = document.getElementById('votersCount').value;
    console.log(votersCount);
    var votedCount = document.getElementById('votedCount').value;
    console.log(votedCount);
    const ctx_1 = document.getElementById('voted_state');
    new Chart(ctx_1, {
        type: 'pie',
        data: {
            labels: ['Voted', 'Not Voted'],
            datasets: [{
                label: '# of Votes',
                data: [votedCount, votersCount - votedCount],
                borderWidth: 1,
                backgroundColor: ['#10558d', '#ec8a93']
            }]
        }
    });
    const ctx_2 = document.getElementById('party_state');

    new Chart(ctx_2, {
        type: 'bar',
        data: {
            labels: keys,
            datasets: [{
                label: '# of Votes',
                data: votesInOrder,
                borderWidth: 1,
                backgroundColor: '#10558d'
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    
</script>
<?php require approot . '/View/inc/footer.php'; ?>