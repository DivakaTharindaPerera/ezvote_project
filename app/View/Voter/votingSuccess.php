<?php require approot . '/View/inc/VoterHeader.php'; ?>

<div class="w-100 d-flex h-100 flex-column mb-auto p-2 overflow-y">
    <div class="title">
        <?php echo $data['election']->Title; ?>
    </div>
    <div class="title">
        By <?php echo $data['election']->Title; ?>
    </div>
    <div class="text-xl">
        <?php echo $data['election']->Description; ?>
    </div>

    <?php
    foreach ($data['position'] as $position) {
        echo "
        <div>
        <div class='text-xl text-center m-2 bg-blue-10 text-white p-1 border-radius-14'>
            <b>$position->positionName</b>
        </div>
        <div class='d-flex p-1 justify-content-center'>";
        foreach ($data['candidates'] as $candidate) {
            if ($candidate->positionId == $position->ID) {
    ?>
                <div class="card">
                    <div class="text-xs">
                        <?php echo $candidate->candidateId; ?>
                    </div>
                </div>
    <?php
            }
        }
        echo "</div></div>";
    }
    ?>
</div>

<?php require approot . '/View/inc/footer.php'; ?>