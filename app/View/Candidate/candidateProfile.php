<?php
require approot.'/View/inc/VoterHeader.php';
require approot. '/View/inc/AuthNavbar.php'; 
require approot.'/View/inc/side_bar.php';

?>
      
<div class="w-100 text-lg px-2" style="margin-left:850px;">
<?php 
// foreach ($students as $student): 
?>

        <h2 class="my-2" style="margin-left:300px;">My candidate profile</h2>

        <div class="">

        <!-- <div class="pic1">       
        <img src="./uploads/<?php echo $field6name; ?>" alt="Profile image" class="picture"  />
        </div>  -->

        <!-- <div class="pic2">     -->
        <!-- <p><button class="can_no">Candidate No: CN<?php echo $field1name ?></button></p> -->
        <!-- </div> -->
    </div>

    
        <label for="full name">Full Name:</label> 
        <textarea name="full-name" id="full-name"  readonly class=" bg-light text-dark w-50 border-1 border-dark border-radius-3" style="overflow:hidden; resize: none; box-shadow: 5px 5px; margin-left:15px;"> Kavindya Nimeshi</textarea><br><br>
        <?php 
        // echo $student['firstname']." ".$student['lastname']; 
        ?>
        
        <label for="tre">Election:</label> 
        <textarea name="tre" id="tre"  readonly class="bg-light text-dark w-50 border-1 border-dark border-radius-3" style="overflow:hidden; resize: none; box-shadow: 5px 5px ; margin-left:30px;"> Welfare Election 2023</textarea><br><br>
        <?php 
        // echo $student['election_name']; 
        ?>

        <label for="party">Party:</label> 
        <textarea name="party" id="party"  readonly class="bg-light text-dark w-50 border-1 border-dark border-radius-3" style="overflow:hidden; resize: none; box-shadow: 5px 5px ; margin-left:50px;"> Fiestro</textarea><br><br>
        <?php 
        // echo $student['party_name']; 
        ?>

        <label for="position">Position:</label> 
        <textarea name="position" id="position" readonly class="bg-light text-dark w-50 border-1 border-dark border-radius-3" style="overflow:hidden; resize: none; box-shadow: 5px 5px ; margin-left:30px;"> President</textarea><br><br>
        <?php 
        // echo $student['position']; 
        ?>

        <label for="about">About: 
        <textarea name="about" id="about" readonly  class="bg-light text-dark w-50 border-1 border-dark border-radius-3" style="overflow:hidden; resize: none; box-shadow: 5px 5px ; margin-left:40px;"> I am an undergraduate at ucsc.</textarea><br><br>
        <?php 
        // echo $student['candidateDescription']; 
        ?>

        <label for="vision">Vision:</label>    
        <textarea name="vision" id="vision" readonly class="bg-light text-dark w-50 border-1 border-dark border-radius-3" style="overflow:hidden; resize: none; box-shadow: 5px 5px ; margin-left:40px;"> My vision is to help poor people.</textarea><br><br>
        <?php 
        // echo $student['msg']; 
        ?>

        <!-- <button class="btn bg-primary text-white text-lg" type="submit" style="margin-left:400px;">Withdraw</button> -->
    </div>

    <?php require approot.'/View/inc/footer.php';?>