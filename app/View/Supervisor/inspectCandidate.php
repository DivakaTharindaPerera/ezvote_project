<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>
<?php require approot . '/View/inc/sidebar-new.php'; ?>

<div class="main-container">
    <div id="taskbar" class="d-flex flex-column w-100 bg-blue-1" style="border-bottom-left-radius: 20px; border-bottom-right-radius: 20px; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.4);">
        <div class="d-flex">
            <div id="buttons" class="m-1 mr-auto">
                <a href="<?php echo urlroot ?>/Pages/viewObjections/<?php echo $data['election']->ElectionId; ?>" class="btn btn-danger card-hover min-h-90"><i class="fa-solid fa-angles-left"></i><span class="ml-1">Back</span></a>
            </div>
        </div>
    </div>
    <div id="cProfile" class="m-1 py-1 px-2 d-flex justify-content-center">

        <div id="profilePic" class="h-50 w-50">
            <?php
            if ($data['candidate']->profilePic == NULL) {
                echo "<img src='/ezvote/public/img/profile.jpg' class='h-100 w-100'>";
            } else {
                echo "<img src='/ezvote/public/img/candidate/$data[candidate]->profilePic' class='h-100 w-100'>";
            }
            ?>
        </div>
        <div id="details" class="w-50 my-2 d-flex flex-column justify-content-center">
            <div class="mb-auto">
                <div class="text-6xl text-center"><b><?php echo $data['candidate']->candidateName; ?></b></div>
                <div class="title text-center"><b><?php echo $data['candidate']->candidateEmail; ?></b></div>
            </div>

            <?php
            if ($data['candidate']->partyId != NULL) {
            ?>
                <div class="text-primary text-xl">
                    <?php echo $data['party']->partyName; ?>
                </div>
            <?php
            }
            ?>
            <div class="border-1 border-radius-3 w-95 mx-auto">
                <div class="text-2xl text-center w-100 p-1 bg-primary mb-1 text-white" style="border-top-left-radius: 0.75rem;border-top-right-radius: 0.75rem;">Positions</div>
                <div class="d-flex flex-wrap justify-content-center mb-1">

                    <?php
                    foreach ($data['duplicates'] as $duplicate) {
                        foreach ($data['positions'] as $position) {
                            if ($position->ID == $duplicate->positionId) {
                                echo "<div class='bg-primary p-1 text-white text-xl border-radius-5'>
                                    $position->positionName
                                    </div>";
                            }
                        }
                    }
                    ?>

                </div>
            </div>
            <div class="mx-auto my-2 text-xl">
                Identity Proof: <?php
                                if ($data['candidate']->identityProof == NULL) {
                                    echo "<span class='text-danger'>No identity proof provided..</span>";
                                } else {
                                ?>
                    <a href="<?php echo urlroot; ?>/public/img/<?php echo $data['candidate']->identityProof; ?>" download="<?php echo $data['candidate']->identityProof ?>">Download</a>
                <?php
                                }
                ?>
            </div>
        </div>
    </div>
    <div class="d-flex w-100 p-2">
        <div id="description" class="d-flex flex-column bg-blue-10 text-white p-1 w-45 h-50 ml-auto mr-1 text-center border-radius-3">
            <div class="text-2xl mb-1"><b>Description</b></div>
            <div class="text-xl my-auto">
                <?php
                if ($data['candidate']->description == NULL) {
                    echo "No description";
                } else {
                    echo $data['candidate']->description;
                }
                ?>
            </div>
        </div>
        <div id="vision" class="d-flex flex-column bg-blue-10 text-white p-1 w-45 h-50 mr-auto ml-1 text-center border-radius-3">
            <div class="text-2xl mb-1"><b>Vision</b></div>
            <div class="text-xl my-auto">
                <?php
                if ($data['candidate']->vision == NULL) {
                    echo "No vision";
                } else {
                    echo $data['candidate']->vision;
                }
                ?>
            </div>
        </div>

    </div>

</div>

<?php require approot . '/View/inc/footer.php'; ?>