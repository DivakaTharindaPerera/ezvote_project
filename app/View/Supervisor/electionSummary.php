<?php
//echo '<pre>';
//print_r($data['positions']);
//exit();
require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>
<?php require approot . '/View/inc/sidebar-new.php'; ?>

<div class="main-container" id="printThis">
    <!-- <button  onclick="printThis()">PRINT</button> -->
    <!-- <button id="printBtn">PRINT</button> -->
    <?php
    $partyVotes = array();
    foreach ($data['parties'] as $party) {
        $partyVotes[$party->partyName] = 0;
    }

    $positionVotes = array();
    foreach ($data['positions'] as $position) {
        $positionVotes[$position->ID] = 0;
        foreach ($data['candidates'] as $candidate) {
            if ($candidate->positionId == $position->ID) {
                $positionVotes[$position->ID] += $data['votes'][$candidate->candidateId];
            }
        }
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

    <div id="taskbar" class="d-flex flex-column w-100 bg-blue-1" style="border-bottom-left-radius: 20px; border-bottom-right-radius: 20px; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.4);" >
        <div class="d-flex w-100">
            <div id="buttons" class="m-1 w-100 d-flex">
                <a href="<?php echo urlroot?>/Pages/ViewMyElections" class="btn btn-danger card-hover min-h-90 mr-auto"><i class="fa-solid fa-angles-left"></i><span class="ml-1">Back</span></a>
                <button class="btn btn-primary min-h-90 card-hover ml-auto mr-2" id="printBtn"><b>PRINT</b></button>
            </div>
        </div>         
    </div>

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
            <div class="d-flex sub-title justify-content-center align-items-center w-100">Candidates</div>
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
                                            $perc = 0;
                                            if ($positionVotes[$position->ID] != 0) {
                                                $perc = $data['votes'][$key] / $positionVotes[$position->ID] * 100;
                                            }
                                            echo "<tr>
                                                        <td>$candidate->candidateName</td>
                                                        <td>" . $data['votes'][$key] . " [" . $perc . "%]</td>";
                                            if ($candidate->partyId == NULL) {
                                                echo "<td>No Party</td>";
                                            } else {
                                                foreach ($data['parties'] as $party) {
                                                    if ($candidate->partyId == $party->partyId) {
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
    <div id="printContent" class="d-flex flex-column border-1 w-100" style="display: none;">
        <div class="d-flex flex-column text-center mb-auto">
            <div class="sub-title"><b><?php echo $data['election']->Title; ?></b></div>
            <div class="sub-title">By</div>
            <div class="sub-title"><b><?php echo $data['election']->OrganizationName; ?></b></div>
        </div>
        <div class="text-left d-flex w-100 flex-column mt-1">
            <div class="text-x">Election Supervisor</div>
            <div class="text-x text-primary"><?php echo $data['supervisor']->Fname . " " . $data['supervisor']->Lname; ?></div>
            <div class="text-x text-primary"><?php echo $data['supervisor']->Email; ?></div>
        </div>

        <div class="w-100 d-flex">
            <div class="mt-1 d-flex flex-column w-45 p-2">
                <div class="text-xl mb-1 text-center w-100">Votes</div>
                <ol type="1" style="list-style-type: decimal;">
                    <?php foreach ($data['positions'] as $position) { ?>
                        <li class="mt-1">
                            <?php echo $position->positionName; ?>
                            <ul type='disc'>
                                <?php foreach ($data['candidates'] as $candidate) {
                                    if ($candidate->positionId == $position->ID) {
                                        $perc = 0;
                                        if ($positionVotes[$position->ID] != 0) {
                                            $perc = $data['votes'][$candidate->candidateId] / $positionVotes[$position->ID] * 100;
                                        }
                                        if ($candidate->partyId == null) {
                                            echo "<li class='mt-1'> " . $candidate->candidateName . " - No Party - " . $data['votes'][$candidate->candidateId] . " vote(s) - " . $perc . "%";
                                        } else {
                                            foreach ($data['parties'] as $party) {
                                                if ($party->partyId == $candidate->partyId) {
                                                    echo "<li class='mt-1'> " . $candidate->candidateName . " - " . $party->partyName . "- " . $data['votes'][$candidate->candidateId] . " vote(s) - " . $perc . "%";
                                                }
                                            }
                                        }
                                    }
                                } ?>
                            </ul>
                        </li>
                    <?php } ?>
                </ol>
            </div>
            <div class="mt-1 d-flex flex-column w-45 p-2 ml-auto">
                <div class="text-xl mb-1 text-center w-100">Election parties</div>
                <?php if ($data['parties'] == null) {
                    echo "<div class='text-center text-danger'>No parties in this election</div>";
                } else {
                ?>
                    <div>
                        <ol type="1" style="list-style-type: decimal;">
                            <?php foreach ($data['parties'] as $party) {
                                echo "<li class='mt-1'>" . $party->partyName . " - " . $partyVotes[$party->partyName] . "</li>";
                            } ?>
                        </ol>
                    </div>
                <?php
                } ?>
            </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="/ezvote/public/js/printThis.js"></script>
<script>
    //for party comparison
    var votesInOrder = [];
    var partyVotes = JSON.parse('<?php echo $jsonData; ?>');
    console.log(partyVotes);
    let keys = Object.keys(partyVotes);

    for (let key of keys) {
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

    function printThis() {
        document.getElementById('printContent').style.display = 'block';
        html2canvas(document.querySelector('#printContent')).then((canvas) => {
            let base64img = canvas.toDataURL('image/png');
            let pdf = new jsPDF('p', 'px', 'a4');
            pdf.addImage(base64img, 'PNG', 2, 2, 595, 89);
            pdf.save('report.pdf');
        });
        document.getElementById('printContent').style.display = 'none';

    }

    $(document).ready(function() {
        $('#printBtn').click(function() {
            $('#printContent').css('display', 'block');
            $('#printContent').printThis();
        });
    });
</script>
<?php require approot . '/View/inc/footer.php'; ?>