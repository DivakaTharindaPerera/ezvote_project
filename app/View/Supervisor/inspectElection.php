<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>
<?php require approot . '/View/inc/sidebar-new.php' ?>

<div class="main-container">
    <?php
    $keys = array_keys($data['votes']);
    $voterCount = 0;
    $votedCount = 0;
    ?>
    <div class="title" style="color: rgb(0, 0, 153);"><?php echo $election->Title; ?></div>
    <div class="title" style="color: rgb(0, 0, 153);">By <?php echo $election->OrganizationName; ?></div>
    <div class="w-100 d-flex justify-content-center flex-column">
        <div id="voterHeader" class="w-90 bg-blue-9 h-10 d-flex p-1 text-light border-radius-2 mx-auto flex-column">
            <div class="d-flex">
                <div class="my-auto ml-1 text-2xl"><b>VOTERS</b></div>
                <div class="ml-auto mr-1"><button id="voterExpandBtn" class="border-none text-2xl bg-blue-9 text-white" onclick="expandVoters()" style="cursor: pointer;"><b><i class="fa-solid fa-angle-left"></i></b></button></div>

            </div>
            <div id="voters" class="w-100 bg-primary border-radius-2 mx-auto p-1 mt-1 max-h-80 overflow-scroll" style="display: none;">
                <?php foreach ($data['voters'] as $voter) {
                    $voterCount++;
                ?>
                    <div class="w-100 mb-1 bg-blue-10 p-1 border-radius-1 d-flex">
                        <div class="text-xl mr-auto">[<?php echo $voter->voterId; ?>] <?php echo $voter->Name; ?></div>
                        <div class="text-xl mx-auto"><?php echo $voter->Email; ?></div>
                        <?php if ($voter->cast == 1) {
                            $votedCount++;
                        ?>
                            <div class="text-xl ml-auto">VOTED</i></div>
                        <?php } else { ?>
                            <div class="text-xl ml-auto" style="color: rgb(255, 51, 51);">NOT YET VOTED</i></div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <input type="hidden" name="" id="voterCnt" value="<?php echo $voterCount; ?>">
    <input type="hidden" name="" id="votedCnt" value="<?php echo $votedCount; ?>">
    <div id="voterChart" class="w-100 p-2 d-flex">
        <div class="ml-auto mr-5">
            <canvas id="VotedVSOthersChart" class="w-100 h-100 text-2xl"></canvas>
        </div>
        <div class="bg-primary mr-auto ml-5 d-flex flex-column text-white p-1 border-radius-2 my-auto w-30">
            <div class="d-flex mb-1">
                <div class="text-xl mr-auto">VOTED</div>
                <div class="text-xl ml-auto"><?php echo $votedCount;?></div>
            </div>
            <div class="d-flex mt-1">
                <div class="text-xl mr-auto">NOT VOTED</div>
                <div class="text-xl ml-auto"><?php echo $voterCount - $votedCount;?></div>
            </div>
        </div>
    </div>
    <div id="votes" class="w-100 p-1 d-flex flex-wrap justify-content-center">
        <?php foreach ($data['positions'] as $positon) { ?>

            <div class="w-45 bg-blue-9 border-radius-2 my-1 mx-1 p-1" style="color: white;">
                <div class="sub-title my-1 text-center"><?= $positon->positionName ?></div>
                <?php foreach ($data['candidates'] as $candidate) {
                    if ($candidate->positionId == $positon->ID) {
                ?>
                        <div class="w-100 mb-1 bg-blue-10 p-1 border-radius-1 d-flex">
                            <div class="text-xl">[<?php echo $candidate->candidateId; ?>] <?php echo $candidate->candidateName; ?></div>
                            <div id="<?php echo $candidate->candidateId; ?>" class="text-xl ml-auto">
                                <?php
                                foreach ($keys as $key) {
                                    if ($key == $candidate->candidateId) {
                                        echo $data['votes'][$key];
                                    }
                                }
                                ?>
                            </div>
                        </div>
                <?php }
                } ?>
            </div>

        <?php } ?>
    </div>
</div>

<script>
    var voterCnt = document.getElementById("voterCnt").value;

    var votedCnt = document.getElementById("votedCnt").value;
    console.log(voterCnt);
    console.log(votedCnt);
    var ctx = document.getElementById("VotedVSOthersChart").getContext('2d');

    var chartData = {
        labels: ["Voted", "Not Voted"],
        datasets: [{
            data: [votedCnt, voterCnt - votedCnt],
            backgroundColor: ["#10558d", "#ff0000"]
        }]
    };

    var options = {
        responsive: true,

        plugins: {
            datalabels: {
                color: 'white',
                formatter: (value, ctx) => {
                    let sum = 0;
                    let dataArr = ctx.chart.data.datasets[0].data;
                    dataArr.map(data => {
                        sum += data;
                    });
                    let percentage = (value * 100 / sum).toFixed(2) + "%";
                    return percentage;
                },
                font: {
                    size: '24'
                }
            }
        }
    };

    var pieChart = new Chart(ctx, {
        type: 'pie',
        data: chartData,
        options: options
    })


    function expandVoters() {
        if (document.getElementById("voterExpandBtn").getElementsByTagName("i")[0].classList.contains("fa-angle-left")) {
            document.getElementById("voterExpandBtn").getElementsByTagName("i")[0].classList.remove("fa-angle-left");
            document.getElementById("voterExpandBtn").getElementsByTagName("i")[0].classList.add("fa-angle-down");
            document.getElementById("voters").style.display = "block";
        } else {
            document.getElementById("voterExpandBtn").getElementsByTagName("i")[0].classList.remove("fa-angle-down");
            document.getElementById("voterExpandBtn").getElementsByTagName("i")[0].classList.add("fa-angle-left");
            document.getElementById("voters").style.display = "none";
        }
    }
</script>

<?php require approot . '/View/inc/footer.php'; ?>