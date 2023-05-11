<?php
//echo '<pre>';
//print_r($data['parties']);
//exit();
require approot . '/View/inc/VoterHeader.php';
require approot . '/View/inc/AuthNavbar.php';
require approot . '/View/inc/sidebar-new.php'; ?>
<div class="main-container" >
    <div id="printJS-report" class="d-flex flex-column border border-3 border-white border-radius-2 p-2 mt-2">
    <div class="title my-1">
        <?= $data['election']->Title ?><br>
        <?= $data['election']->OrganizationName ?>
    </div>
    <div class="d-flex border-primary border-1 border-radius-2 my-1 text-lg px-2 py-1 justify-content-center">
        Held on <?= $data['election']->EndDate?> at <?= $data['election']->EndTime?>
    </div>
    <div class="d-flex flex-column my-1">
        <div class="sub-title mb-1">Elected Candidates for positions</div>
        <div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Candidate</th>
                    <th scope="col">Position</th>
                    <th scope="col">Votes</th>
                    <th scope="col">Party</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($data['candidates'] as $candidate) { ?>
                    <tr>
                        <?php $id=$candidate->candidateId?>
                        <td><?= $candidate->candidateName?></td>

                        <?php
                        if($candidate->positionId==null){?>
                            <td>No Position</td>
                        <?php }
                        else{
                            $pos_id=$candidate->positionId;
                            $position = 'No position ';
                            foreach ($data['positions'] as $position) {
                                if ($position->ID == $pos_id) {
                                    $position = $position->positionName;
                                    break;
                                }
                            }?>
                            <td><?= $position?></td>
                        <?php }?>

                        <?php foreach ($data['votes'] as $x=>$vote) {
                            if ($x == $id) {
                                $voteCount = $vote;
                                break;
                            }
                        } ?>
                        <td><?= $voteCount?></td>

                        <?php
                        if ($candidate->partyId==null){?>
                            <td>No Party</td>
                        <?php }
                        else{
                            $party_id=$candidate->partyId;
                            $partyName= 'No party';
                            foreach ($data['parties'] as $party) {
                                if ($party->partyId == $party_id) {
                                    $partyName = $party->partyName;
                                    break;
                                }
                            }?>
                            <td><?= $partyName?></td>
                        <?php
                        }
                        ?>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
    <div class="d-flex justify-content-evenly my-1">
        <div class="d-flex mx-1">
            <canvas id="results" width="400" height="400"></canvas>
        </div>
        <?php
        $candiVote=array();
        $voteC=[];
        $candiNames=[];
        $candiVotes=[];
        foreach ($data['candidates'] as $candidate) {
            $id=$candidate->candidateId;
            foreach ($data['votes'] as $x=>$vote) {
                if ($x == $id) {
                    $candiNames[]=$candidate->candidateName;
                    $candiVotes[]=$vote;
                    break;
                }
            }
        }
        ?>
<!--        <div id="candidateVotes" class="hidden">-->
<!--            --><?php //$bar_data=json_encode($candiVote);?>
<!--        </div>-->
        <div class="d-flex mx-1">
            <canvas id="voters"></canvas>
        </div>
        <?php
        $keys = array_keys($data['votes']);
        $votersCount = 0;
        $votedCount = 0;
        foreach ($data['voters'] as $voter) {
            $votersCount++;
            if ($voter->cast == 1) {
                $votedCount++;
            }
        }
        ?>
    </div>
    </div>
    <div class="d-flex justify-content-end my-2 mr-3 p-2 w-75">
        <button class="btn btn-primary w-20" type="button" onclick="printJS('printJS-report', 'html')">Print</button>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="print.js"></script>

<script>


    const ctx = document.getElementById('results');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($candiNames);?>,
            datasets: [{
                label: '# of Votes',
                data: <?php echo json_encode($candiVotes);?>,
                borderWidth: 1,
                backgroundColor:'#10558d'
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

    const ctx2 = document.getElementById('voters');
    new Chart(ctx2, {
        type: 'pie',
        data: {
            labels: ['Voted', 'Not Voted'],
            datasets: [{
                label: '# of Votes',
                data: [<?php echo json_encode($votedCount), json_encode($votersCount-$votedCount)?>],
                borderWidth: 1,
                backgroundColor:['#10558d','red']
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

