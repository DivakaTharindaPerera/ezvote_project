<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>
<?php require approot . '/View/inc/sidebar-new.php'; ?>
<div class="main-container">
    <div class="title my-1">
        <?= $data['election']->Title ?><br>
        <?= $data['election']->OrganizationName ?>
    </div>
    <div class="d-flex border-primary border-1 border-radius-2 my-1 text-lg px-2 py-1">
        Held on <?= $data['election']->EndDate?> at <?= $data['election']->EndTime?>
    </div>
    <div class="d-flex flex-column my-1">
        <div class="sub-title ">Elected Candidates for positions</div>
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
<!--                --><?php //foreach ($data['winners'] as $winner) { ?>
                    <tr>
                        <td>Sandun</td>
                        <td>Secretary</td>
                        <td>50</td>
                        <td>Heros</td>
                    </tr>
<!--                --><?php //} ?>
                </tbody>
            </table>
        </div>

    </div>
    <div class="d-flex justify-content-evenly my-1">
        <div class="d-flex mx-1">
            <canvas id="results" width="400" height="400"></canvas>
        </div>
        <div class="d-flex mx-1">
            <canvas id="voters"></canvas>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('results');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Sandun', 'Asitha', 'Manel', 'James', 'Jenny', 'Mewan'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
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
                data: [12, 19],
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

