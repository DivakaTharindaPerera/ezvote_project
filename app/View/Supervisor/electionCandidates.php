<!--<!DOCTYPE html>-->
<!--<html lang="en">-->
<!--<head>-->
<!--    <meta charset="UTF-8">-->
<!--    <meta http-equiv="X-UA-Compatible" content="IE=edge">-->
<!--    <meta name="viewport" content="width=device-width, initial-scale=1.0">-->
<!--    <link rel="stylesheet" href="--><?php //echo urlroot?><!--/css/utils.css">-->
<!--    <title>ezVote</title>-->
<!--</head>-->
<!--<body class="d-flex flex-column">-->
<!---->
<!--    <div class="d-flex">-->
<!--        --><?php //include_once approot.'/View/inc/AuthNavbar.php'; ?>
<!--    </div>-->
<!--    <div class="d-flex">-->
<!--        <div>-->
<!--            --><?php //include_once approot.'/View/inc/Sidebar.php'; ?>
<!--        </div>-->
<?php require approot.'/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>
<?php require approot . '/View/inc/sidebar-new.php'; ?>
<div class="main-container">
    <div class="d-flex flex-column border-primary border-radius-2 border-2 my-4" >
<!--        --><?php //echo $data['electionRow']->ElectionId."<br>"; ?>
        <div class="title"><?php echo $data['electionRow']->Title."<br>"; ?></div>
        <?php
        foreach($data['positionRow'] as $position){
            echo "<div class='text-md mx-1 my-1'>
                        <div class='sub-title'>".$position->positionName."</div>
                        <div>
                        <u class='text-underline p-1'>Candidates</u>";
            $i =0;
            foreach($data['candidateRow'] as $candidate){
                $i++;
                if($candidate->positionId == $position->ID){
                    echo "<div class='mx-1 my-1'>
                                        <h4 class>".$i." ".$candidate->candidateName." - 
                                        ".$candidate->description."
                                        image</h4>
                                        </div>";
                }
            }

            echo "</div>
                    </div>";
        }
        ?>
    </div>
</div>

<!--    </div>-->
<!--</body>-->
<!--</html>-->