<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>
<?php require approot.'/View/inc/sidebar.php';?>
<!--    <link rel="stylesheet" href="--><?php //echo urlroot; ?><!--/css/myElections.css">-->

<div class="d-flex flex-column bottom-0 absolute right-0 min-w-85 overflow-x bg-secondary align-items-center" style="max-height:90.5vh">
    <div class="justify-content-center align-items-center title mt-1">My Elections</div>
<!--    <div class="top_nav_bar">-->
<!--            --><?php
//                require_once(approot."/View/topnavbar.php");
//            ?>
<!--    </div>-->
    <div class="d-flex flex-column justify-content-center align-items-center w-80 " id="elections">
        <?php
        foreach($data as $row){
            echo "<div class='card'>";
            echo "<div class=''>";
            echo "<div class='title'>".$row->Title."</div><div>by ".$row->OrganizationName."</div>";
            echo "<a href='".urlroot."/Pages/ViewMyElection/".$row->ElectionId."'><div class='btn btn-primary'>View</div></a>";
            echo "</div></div>";
        }
        ?>
    </div>
</div>
<?php require approot . '/View/inc/footer.php'; ?>