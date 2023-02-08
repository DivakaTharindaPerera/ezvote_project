
<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>
<?php require approot.'/View/inc/sidebar-new.php';?>


<!--    <div class="top_nav_bar">-->
<!--            --><?php
//                require_once(approot."/View/topnavbar.php");
//            ?>
<!--    </div>-->
    <div class="main-container">
        <?php
        echo $data['electionRow']->ElectionId."<br>".$data['electionRow']->Title."<br>";

        foreach($data['positionRow'] as $row){
            echo $row->positionName."<br>";
            echo $row->description."<br>";
            echo $row->NoofOptions."-".$row->ID."<br>";
            echo $row->ElectionID."<br><br>"."Candidates: "."<br>";
            $i = 0;
            foreach($data['candidateRow'] as $row1){
                $i++;
                if($row->ID == $row1->positionId){
                    echo "$i. ".$row1->candidateName."<br>"; 
                } 
            }
        }
        ?>

    </div>
<?php require approot . '/View/inc/footer.php'; ?>