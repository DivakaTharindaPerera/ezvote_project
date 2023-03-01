<?php
require approot.'/View/inc/VoterHeader.php';
require approot.'/View/inc/AuthNavbar.php';
require approot.'/View/inc/sidebar-new.php';
?>
<!--<style>-->
<!--    #bg{-->
<!--        background: url("/ezvote/public/img/election.jpg");-->
<!--        object-fit: cover;-->
<!--        background-size: cover;-->
<!--        background-repeat: no-repeat;-->
<!--        background-position: center;-->
<!--        opacity: ;-->
<!---->
<!--    }-->
<!--</style>-->
<div class="main-container">
    <div id="Elections" class="w-95 d-flex flex-column" style="z-index: 2">
        <div id="ongoingElections" class="d-flex " style="justify-content: center;align-items: center">
            <div class="sub-title dark-title max-w-8">Ongoing Elections</div>
            <div class="d-flex mx-auto">
                <div class="d-flex flex-column bg-secondary p-1 border-radius-3 card" style="align-items: center">
                    <div id="election-title" class="title">Welfare Board Election</div>
                    <div class="d-flex flex-column justify-center align-center">
                        <div id="time" class="mx-1 text-info text-lg blink">2hr 30min</div>
                        <button class="btn btn-primary" onclick="vote()">Vote</button>
                    </div>
                </div>
                <div class="d-flex bg-secondary min-w-20 p-1 border-radius-3 mt-1 card" style="align-items: center">
                    <div id="" class="title">Welfare Board Election</div>
                    <div class="d-flex flex-column justify-center align-center">
                        <div id="time" class="mx-1 text-info text-lg blink">2hr 30min</div>
                        <button class="btn btn-primary" onclick="vote()">Vote</button>
                    </div>
                </div>
            </div>

        </div>
        <div id="ongoingElections" class="d-flex " style="justify-content: center;align-items: center">
            <div class="sub-title dark-title max-w-8">Upcoming Elections</div>
            <div class="d-flex mx-auto">
                <div class="d-flex bg-secondary min-w-20 p-1 border-radius-3 card" style="align-items: center">
                    <div id="election-title" class="title">Welfare Board Election</div>
                    <div class="d-flex flex-column justify-center align-center">
                        <div id="time" class="mx-1 text-info">2hr 30min</div>
                        <a class="btn btn-primary" href="<?php echo urlroot; ?>/Voters/election">View</a>
                    </div>
                </div>
                <div class="d-flex bg-secondary min-w-20 p-1 border-radius-3 mt-1 card" style="align-items: center">
                    <div id="election-title" class="title">Welfare Board Election</div>
                    <div class="d-flex flex-column justify-center align-center">
                        <div id="time" class="mx-1 text-info">2hr 30min</div>
                        <a class="btn btn-primary">View</a>
                    </div>
                </div>
            </div>
        </div>
        <div id="ongoingElections" class="d-flex " style="justify-content: center;align-items: center">
            <div class="sub-title dark-title max-w-8">Recent Elections</div>
            <div class="d-flex mx-auto">
                <div class="d-flex bg-secondary min-w-20 p-1 border-radius-3 card" style="align-items: center">
                    <div id="election-title" class="title">Welfare Board Election</div>
                    <div class="d-flex flex-column justify-center align-center">
                        <div id="time" class="mx-1 text-info">2hr 30min</div>
                        <a class="btn btn-primary">View</a>
                    </div>
                </div>
                <div class="d-flex bg-secondary min-w-20 p-1 border-radius-3 mt-1 card" style="align-items: center">
                    <div id="election-title" class="title">Welfare Board Election</div>
                    <div class="d-flex flex-column justify-center align-center">
                        <div id="time" class="mx-1 text-info">2hr 30min</div>
                        <a class="btn btn-primary">View</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require approot.'/View/inc/footer.php';?>
