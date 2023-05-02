<?php
require approot.'/View/inc/VoterHeader.php';
require approot. '/View/inc/AuthNavbar.php'; 
require approot.'/View/inc/side_bar.php';
?>

<!-- <h2 class="m-2" style="">My candidate profile</h2> -->
<br>

<div class="d-flex shadow border-radius-1 p-2 bg-light" style="margin-left:35vh; ">    

    <div class="py-4" style="">       
        <img src="<?php echo urlroot; ?>/img/welcome/boy.jpg" alt="" class="w-50 h-50" style="border-radius:10px;"  />        
    </div>

    <div class="w-75 p-2 text-dark" style="">

        <!-- Candidate Name -->
        <h1 name="first-name" id="full-name"  readonly class="w-50" style="overflow:hidden; resize: none; margin-left:15px; width:18rem;"><?php echo $res[0]->candidateName?></h1>
        <br><br>

        <!-- Election Name -->
        <label for="tre">Election:</label> 
        <textarea name="tre" id="tre"  readonly class="w-50 border-1" style="overflow:hidden; resize: none; margin-left:30px;"><?php echo $elect[0]->OrganizationName.''.$elect[0]->Title; ?></textarea><br><br>

        <!-- Party Name -->
        <label for="party">Party:</label> 
        <textarea name="party" id="party"  readonly class="w-50 border-1" style="overflow:hidden; resize: none; margin-left:50px;"><?php echo $party[0]->partyName; ?></textarea><br><br>

        <!-- Position Name -->
        <label for="position">Position:</label> 
        <textarea name="position" id="position" readonly class="w-50 border-1" style="overflow:hidden; resize: none; margin-left:30px;"><?php echo $position[0]->positionName; ?></textarea><br><br>

        <!-- Candidate Description -->
        <label for="about">About: 
        <textarea name="about" id="about" readonly  class="w-50 border-1" style="overflow:hidden; resize: none; margin-left:40px;"><?php echo $res[0]->description; ?></textarea><br><br>
       
        <!-- Candidate Vision -->
        <label for="vision">Vision:</label>    
        <textarea name="vision" id="vision" readonly class="w-50 border-1" style="overflow:hidden; resize: none; margin-left:40px;"><?php echo $res[0]->vision; ?></textarea><br><br>
    
    </div>
</div>

<?php require approot.'/View/inc/footer.php';?>