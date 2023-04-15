<?php require approot . '/View/inc/VoterHeader.php'; ?>

<div class="w-100 d-flex h-100 flex-column mb-auto p-2 overflow-y">
    <div class="title">
        <?php echo $data['election']->Title; ?>
    </div>
    <div class="title">
        By <?php echo $data['election']->Title; ?>
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
                <div class="card d-flex flex-column">
                    <div class="m-1">
                        <img src="/ezvote/public/img/profile.jpg" style="max-height:50px;max-width: 50px" alt="profile photo">
                    </div>
                    <div class="text-xl mb-1">
                        <?php echo $candidate->candidateName; ?>
                    </div>
                    <div class="text-xs mb-1">
                        <?php echo $candidate->candidateEmail; ?>
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