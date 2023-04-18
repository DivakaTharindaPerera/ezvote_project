<?php
require approot.'/View/inc/VoterHeader.php';
require approot. '/View/inc/AuthNavbar.php'; 
require approot.'/View/inc/side_bar.php';

?>
      
<div class="w-100 text-lg px-2" style="margin-left:850px;">
<?php foreach ($r as $value){?>

        <h2 class="my-2" style="margin-left:300px;">My candidate profile</h2>

        <div class="">

        <div class="" style="padding-left:350px;">       
        <img src="<?php echo urlroot; ?>/img/welcome/boy.jpg" alt="" class="w-10 h-10" style="border-radius:10px;"  />
        <!-- <img src="<?php echo $value->profile_picture?>" alt="" class="w-10 h-10" style="border-radius:10px;"  /> -->
        
    
    </div> 

        <!-- <div class="pic2">     -->
        <!-- <p><button class="can_no">Candidate No: CN<?php echo $field1name ?></button></p> -->
        <!-- </div> -->
    </div>

    
        <!-- <label for="full name">Full Name:</label>  -->
        <div class="d-flex">
        <label for="full name">First Name:</label> 
        <textarea name="first-name" id="full-name"  readonly class=" bg-light text-dark border-1 border-dark border-radius-3 mx-2" style="overflow:hidden; resize: none; box-shadow: 5px 5px; margin-left:15px; width:18rem;"><?php echo $candidateData['firstName']?></textarea>
        
        <label for="full name">Last Name:</label> 
        <textarea name="last-name" id="full-name"  readonly class=" bg-light text-dark border-1 border-dark border-radius-3" style="overflow:hidden; resize: none; box-shadow: 5px 5px; margin-left:15px; width:18rem;"><?php echo $candidateData['lastName']; ?></textarea><br><br>
</div>
<br>
        <?php 
        // echo $student['firstname']." ".$student['lastname']; 
        ?>
        
        <label for="tre">Election:</label> 
        <textarea name="tre" id="tre"  readonly class="bg-light text-dark w-50 border-1 border-dark border-radius-3" style="overflow:hidden; resize: none; box-shadow: 5px 5px ; margin-left:30px;"><?php echo $candidateData['electionName']; ?></textarea><br><br>
        <?php 
        // echo $student['election_name']; 
        ?>

        <label for="party">Party:</label> 
        <textarea name="party" id="party"  readonly class="bg-light text-dark w-50 border-1 border-dark border-radius-3" style="overflow:hidden; resize: none; box-shadow: 5px 5px ; margin-left:50px;"><?php echo $candidateData['partyName']; ?></textarea><br><br>
        <?php 
        // echo $student['party_name']; 
        ?>

        <label for="position">Position:</label> 
        <textarea name="position" id="position" readonly class="bg-light text-dark w-50 border-1 border-dark border-radius-3" style="overflow:hidden; resize: none; box-shadow: 5px 5px ; margin-left:30px;"><?php echo $candidateData['position']; ?></textarea><br><br>
        <?php 
        // echo $student['position']; 
        ?>

        <label for="about">About: 
        <textarea name="about" id="about" readonly  class="bg-light text-dark w-50 border-1 border-dark border-radius-3" style="overflow:hidden; resize: none; box-shadow: 5px 5px ; margin-left:40px;"><?php echo $candidateData['candidateDescription']; ?></textarea><br><br>
        <?php 
        // echo $student['candidateDescription']; 
        ?>

        <label for="vision">Vision:</label>    
        <textarea name="vision" id="vision" readonly class="bg-light text-dark w-50 border-1 border-dark border-radius-3" style="overflow:hidden; resize: none; box-shadow: 5px 5px ; margin-left:40px;"><?php echo $candidateData['msg']; ?></textarea><br><br>
        <?php 
        // echo $student['msg']; 
        ?>

        <!-- <button class="btn bg-primary text-white text-lg" type="submit" style="margin-left:400px;">Withdraw</button> -->
    </div>
    
        <?php } ?>
    <?php require approot.'/View/inc/footer.php';?>