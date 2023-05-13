<?php require approot . '/View/inc/VoterHeader.php';
    require approot.'/View/inc/AuthNavbar.php';
    require approot.'/View/inc/sidebar-new.php';?>
<div class="main-container">
<div class="w-100 d-flex h-100 flex-column mb-auto overflow-y" id="summary">

    <div class="d-flex flex-column overflow-scroll">
        <div class="title">
            <?php echo $data['election']->Title; ?>
        </div>
        <div class="sub-title text-center">
            <?php echo $data['election']->OrganizationName; ?>
        </div>
    <?php
    foreach ($data['position'] as $position) {
        echo "
        <div>
        <div id='pageWidth' class='text-xl text-center m-2 bg-primary text-white p-1 border-radius-14 page-break'>
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


</div>
    <div class="justify-content-center d-flex bg-light w-100 p-1 mb-auto" id="buttonContainer" style="border-top-left-radius: 20px; border-top-right-radius: 20px; box-shadow: 0px -2px 4px rgba(0, 0, 0, 0.4);">
        <!--        <a href="--><?php //echo urlroot;?><!--/Pages/dashboard" class="btn btn-danger mx-1 my-1"><b>HOME</b></a>-->
        <button class="btn btn-primary w-20" type="button" onclick="printJS('summary', 'html')">Print</button>
        <!--        <button class="btn btn-primary mx-1 my-1" onclick="printThis()"><b>PRINT</b></button>-->

    </div>

</div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    function printThis(){
       window.print();
    }
</script>

<?php require approot . '/View/inc/footer.php'; ?>