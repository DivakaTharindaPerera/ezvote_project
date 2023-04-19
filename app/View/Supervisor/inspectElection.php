<?php require approot.'/View/inc/VoterHeader.php';?>
<?php require approot.'/View/inc/AuthNavbar.php';?>
<?php require approot.'/View/inc/sidebar-new.php'?>

<div class="main-container">
    <div class="title" style="color: rgb(0, 0, 153);"><?php echo $election->Title; ?></div>
    <div class="title" style="color: rgb(0, 0, 153);">By <?php echo $election->OrganizationName; ?></div>
    <div id="votes" class="w-100 p-1 d-flex flex-wrap justify-content-center">
        <?php foreach ($data['positions'] as $positon){?>

            <div class="w-45 bg-blue-9 border-radius-2 my-1 mx-1 p-1" style="color: white;">
                <div class="sub-title my-1 text-center"><?= $positon->positionName?></div>
                <?php foreach($data['candidates'] as $candidate){
                        if($candidate->positionId == $positon->ID){    
                ?>
                    <div class="w-100 mb-1 bg-blue-10 p-1 border-radius-1">
                        <div class="text-xl"><?php echo $candidate->candidateName; ?></div>
                        <div class="text-xl"></div>
                    </div>
                <?php }}?>
            </div>
            
        <?php }?>
    </div>
</div>

<?php require approot . '/View/inc/footer.php'; ?>