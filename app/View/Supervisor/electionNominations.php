<?php
require approot . '/View/inc/VoterHeader.php';
require approot . '/View/inc/AuthNavbar.php';
require approot . '/View/inc/sidebar-new.php';
?>

<div class="main-container">
    <div id="taskbar" class="d-flex flex-column w-100 bg-blue-1" style="border-bottom-left-radius: 20px; border-bottom-right-radius: 20px; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.4);">
        <div class="d-flex">
            <div id="buttons" class="m-1 mr-auto">
                <a href="<?php echo urlroot ?>/Pages/ViewMyElection/<?php echo $data['election']->ElectionId ?>" class="btn btn-danger card-hover min-h-90"><i class="fa-solid fa-angles-left"></i><span class="ml-1">Back</span></a>
            </div>
        </div>
    </div>
    <div class="text-3xl mt-2 text-primary">
       <b> Nominations for <?php echo $data['election']->Title; ?></b>
    </div>
    <div id="nominationList" class="d-flex flex-wrap w-100 mt-3 justify-content-center">
        <?php
        if ($data['nominations'] == null) {
        ?>
            <div class="mt-2 text-2xl text-danger">No nominations available</div>
        <?php
        }
        foreach ($data['nominations'] as $nomination) {
        ?>
            <div class="card">
                <div class="text-xl mt-auto mb-2"><b><?php echo $nomination->firstname . " " . $nomination->lastname; ?></b></div>
                <div class="mb-2"><button id="<?php echo $nomination->nominationID; ?>-" class="btn btn-primary card-hover text-xl" onclick="showNomi(this.id)"><i class="fa-solid fa-eye"></i></button></div>
            </div>
        <?php
        }
        ?>
    </div>
    <div id="nominationDetails">
        <?php
        foreach ($data['nominations'] as $nomination) {
        ?>
            <div id="<?php echo $nomination->nominationID; ?>-data" class="popup-window-1 bg-secondary text-center border-1 border-radius-2">
                <div class="popup-window-1-content bg-light border-radius-2 p-1 d-flex flex-column h-75 w-80 overflow-y">
                    <div id="exitBtn" class="w-100 mb-1 d-flex h-10">
                        <div class="text-3xl ml-auto" id="<?php echo $nomination->nominationID; ?>-" onclick="showNomi(this.id)" style="cursor: pointer;"><b><i class="fa-sharp fa-solid fa-circle-xmark" style="color: #cc0000;"></i></b></div>
                    </div>
                    <div class="d-flex">
                        <div id="proPic" class="w-45 mr-auto">
                            <?php if ($nomination->profile_picture == null) {
                                echo "<img src='/ezvote/public/img/profile.jpg' style='height: 250px; width: 250px;' alt='profile photo'>";
                            } else {
                                echo "<img src='/ezvote/public/img/profile.jpg' style='height: 250px; width: 250px;' alt='profile photo'>";
                            } ?>
                        </div>
                        <div class="d-flex flex-column w-50 ml-auto">
                            <div class="text-2xl mr-auto"><b><?php echo $nomination->firstname . " " . $nomination->lastname; ?></b></div>
                            <div class="text-xl mr-auto">
                                <?php
                                if ($nomination->email == null) {
                                    echo "<em style='color:red;'>No email provided</em>";
                                } else {
                                    echo $nomination->email;
                                }
                                ?>
                            </div>
                            <div class="mr-auto my-1 border-1 border-radius-5 p-1 border">
                                Identity Proof:
                                <?php
                                if ($nomination->identity_proof == null) {
                                    echo "<em style='color:red;'>No identity proof provided</em>";
                                } else {
                                ?>
                                    <a href="<?php echo urlroot; ?>/img/candidate/proofDocuments/<?php echo $nomination->identity_proof; ?>" download="">Download</a>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="mb-1 mr-auto d-flex border-1 border-radius-5 p-1">
                                <div class="my-auto mr-1">Election Position: </div>
                                <?php
                                foreach ($data['positions'] as $position) {
                                    if ($position->ID == $nomination->ID) {
                                ?>
                                        <div class=" my-auto text-primary"><?php echo $position->positionName; ?></div>
                                <?php
                                    }
                                }

                                ?>
                            </div>
                            <div class="mb-1 mr-auto d-flex border-1 border-radius-5 p-1">
                                <div class="my-auto mr-1">Election Party: </div>
                                <?php
                                if ($nomination->partyId == null) {
                                    echo "<div class=' my-auto text-primary'>Independent</div>";
                                } else {
                                    foreach ($data['parties'] as $party) {
                                        if ($party->partyId == $nomination->partyId) {
                                ?>
                                            <div class=" my-auto text-primary"><?php echo $party->partyName; ?></div>
                                <?php
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex w-100 justify-content-center mt-1">
                        <?php
                        if ($nomination->candidateDescription != null) {
                        ?>
                            <div class="border-1 border-radius-5 w-45 ml-auto mr-1 p-1">
                                <div class="text-xl"><b>Candidate Description</b></div>
                                <div class="text-x mt-1"><?php echo $nomination->candidateDescription; ?></div>
                            </div>
                        <?php
                        }
                        ?>
                        <?php
                        if ($nomination->msg != null) {
                        ?>
                            <div class="border-1 border-radius-5 w-45 mr-auto p-1">
                                <div class="text-xl"><b>Message from candidate</b></div>
                                <div class="text-x mt-1"><?php echo $nomination->msg; ?></div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="w-100 mt-1 d-flex mt-auto">
                        <button id="<?php echo $nomination->nominationID; ?>" class="btn btn-primary ml-auto mr-1 text-2xl card-hover" onclick="accept(this.id)"><b>Accept</b></button>
                        <button id="<?php echo $nomination->nominationID; ?>" class="btn btn-danger mr-auto ml-1 text-2xl card-hover" onclick="reject(this.id)"><b>Reject</b></button>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>

    <div id="confirmPopup" class="popup-window-1 bg-secondary text-center border-1 border-radius-2">
        <div class="popup-window-1-content bg-light border-radius-2 p-1 d-flex flex-column w-30">
            <div class="text-2xl text-center w-100">
                Following nomination has been accepted successfully..
            </div>
            <div id="nominationName" class="mt-1 text-primary text-2xl mb-1">

            </div>
            <div class="mt-auto">
                <button class="btn btn-primary text-2xl" onclick="location.reload()">Done</button>
            </div>
        </div>
    </div>
    <div id="rejectPopup" class="popup-window-1 bg-secondary text-center border-1 border-radius-2">
        <div class="popup-window-1-content bg-light border-radius-2 p-1 d-flex flex-column w-30">
            <div class="text-2xl text-center w-100">
                Following nomination has been Rejected successfully..
            </div>
            <div id="nominationNameR" class="mt-1 text-primary text-2xl mb-1">

            </div>
            <div class="mt-auto">
                <button class="btn btn-primary text-2xl" onclick="location.reload()">Done</button>
            </div>
        </div>
    </div>
    <div id="waiting" class="popup-window-1 bg-secondary text-center border-1 border-radius-2">
        <div class="popup-window-1-content bg-light border-radius-2 p-1 d-flex flex-column">
            <div class="m-1 text-2xl text-danger">
                Please wait......
            </div>
        </div>
    </div>

</div>

<script>
    function showNomi(id) {
        var x = document.getElementById(id + "data");
        if (x.style.display === "none") {
            x.style.display = "block";

        } else {
            x.style.display = "none";
        }
    }

    function popupThis() {
        document.getElementById('confirmPopup').style.display = "block";
    }

    function accept(id) {
        document.getElementById('waiting').style.display = "block";
        fetch('<?php echo urlroot ?>/Elections/acceptNomination', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                nominationId: id
            })
        }).then(response => {
            if (response.ok) {
                return response.json();
            } else {
                throw new Error('Something went wrong');
            }
        }).then(data => {
            if (data.msg == "success") {
                document.getElementById('waiting').style.display = "none";
                document.getElementById('confirmPopup').style.display = "block";
                document.getElementById('nominationName').innerHTML = data.name;
            } else {
                document.getElementById('waiting').style.display = "none";
                alert("Something went wrong");
            }
        })
    }

    function reject(id) {
        document.getElementById('waiting').style.display = "block";
        fetch('<?php echo urlroot ?>/Elections/rejectNomination', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                nominationId: id
            })
        }).then(response => {
            if (response.ok) {
                return response.json();
            } else {
                throw new Error('Something went wrong');
            }
        }).then(data => {
            if (data.msg == "success") {
                document.getElementById('waiting').style.display = "none";
                document.getElementById('rejectPopup').style.display = "block";
                document.getElementById('nominationNameR').innerHTML = data.name;
            } else {
                document.getElementById('waiting').style.display = "none";
                alert("Something went wrong");
            }
        })
    }
</script>

<?php require approot . '/View/inc/footer.php'; ?>