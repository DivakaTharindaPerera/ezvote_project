<?php
//echo '<pre>';
//print_r($data);
//exit();
require approot . '/View/inc/VoterHeader.php';
require approot . '/View/inc/AuthNavbar.php';
require approot . '/View/inc/sidebar-new.php'; ?>
<div class="main-container" >
    <div id="printJS-report" class="d-flex flex-column border border-3 border-white border-radius-2 p-2 mt-2 min-w-80 max-w-80">
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
                <?php foreach ($data['candidates'] as $candidate) {?>
                    <tr>
                        <?php $id=$candidate->candidateId; ?>
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
        $positionName='No position';
        foreach ($data['candidates'] as $candidate) {
            $id=$candidate->candidateId;
            $positionid=$candidate->positionId;
            foreach ($data['positions'] as $position){
                if ($position->ID==$positionid){
                    $positionName=$position->positionName;
                    break;
                }
            }
            foreach ($data['votes'] as $x=>$vote) {
                if ($x == $id) {
                    $candiNames[]=$candidate->candidateName."-".$positionName;
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
<!--        --><?php //echo json_encode($votedCount);
//        echo json_encode($votersCount-$votedCount);
//        exit();?>
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
        type: 'pie',
        data: {
            labels: <?php echo json_encode($candiNames);?>,
            datasets: [{
                label: '# of Votes',
                data: <?php echo json_encode($candiVotes);?>,
                borderWidth: 1,
                backgroundColor:["#0074D9", "#7FDBFF", "#2ECC40", "#FF851B", "#FF4136", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]
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

    var votedCount = <?php echo json_encode($votedCount);?>;
    var votersCount = <?php echo json_encode($votersCount);?>;
    const ctx2 = document.getElementById('voters');
    new Chart(ctx2, {
        type: 'pie',
        data: {
            labels: ['Voted', 'Not Voted'],
            datasets: [{
                label: '# of Votes',
                data: [votedCount, votersCount-votedCount],
                borderWidth: 1,
                backgroundColor:['#10558d','#ec8a93']
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

