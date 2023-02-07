<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo urlroot?>/css/utils.css">
    <title>ezVote</title>
</head>
<body class="d-flex flex-column">

    <div class="d-flex">
        <?php include_once approot.'/View/inc/AuthNavbar.php'; ?>
    </div>
    <div class="d-flex">
        <div>
            <?php include_once approot.'/View/inc/Sidebar.php'; ?>
        </div>
        <div class="h-100" >
            <?php echo $data['electionRow']->ElectionId."<br>"; ?>
            <?php echo $data['electionRow']->Title."<br>"; ?>
            <?php 
                foreach($data['positionRow'] as $position){
                    echo "<div class='bg-blue-10 text-white'>
                        <div>
                            <h3>".$position->positionName."</h3>
                        </div>
                        <div>
                        <u class='text-underline p-1'>Candidates</u>";
                            $i =0;
                            foreach($data['candidateRow'] as $candidate){
                                $i++;
                                if($candidate->positionId == $position->ID){
                                    echo "<div class='bg-orange-10 m-1'>
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
</body>
</html>