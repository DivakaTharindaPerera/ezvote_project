<?php
require approot.'/View/inc/VoterHeader.php';
require approot. '/View/inc/AuthNavbar.php'; 
require approot.'/View/inc/side_bar.php';

?>
<?php
// $query = "SELECT * FROM nomination";
// $result = db->query($query);

// // if $result is true then fetch a result row as an associative array:
// if ($result) {
//     while ($row = $result->fetch_assoc()) {
//         $field1name = $row["firstname"];
//         $field2name = $row["lastname"];
//         $field3name = $row["election_name"];
//         $field4name = $row["position"];
//         $field5name = $row["party_name"];
//         $field6name = $row["candidateDescription"];
//         $field7name = $row["msg"];

// }
// }
?>            


<div class="w-100 text-lg px-2" style="margin-left:850px;">
<?php foreach ($students as $student): ?>

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
        <textarea name="full-name" id="full-name"  readonly class="bg-white text-dark w-50 border-1 border-dark border-radius-3" style="overflow:hidden; resize: none; box-shadow: 5px 10px; margin-left:15px;"><?php echo $student['firstname']." ".$student['lastname']; ?></textarea><br><br>
        
        <label for="tre">Election:</label> 
        <textarea name="tre" id="tre"  readonly class="bg-white text-dark w-50 border-1 border-dark border-radius-3" style="overflow:hidden; resize: none; box-shadow: 5px 10px ; margin-left:30px;"><?php echo $student['election_name']; ?></textarea><br><br>
        
        <label for="party">Party:</label> 
        <textarea name="party" id="party"  readonly class="bg-white text-dark w-50 border-1 border-dark border-radius-3" style="overflow:hidden; resize: none; box-shadow: 5px 10px ; margin-left:50px;"><?php echo $student['party_name']; ?></textarea><br><br>

        <label for="position">Position:</label> 
        <textarea name="position" id="position" readonly class="bg-white text-dark w-50 border-1 border-dark border-radius-3" style="overflow:hidden; resize: none; box-shadow: 5px 10px ; margin-left:30px;"><?php echo $student['position']; ?></textarea><br><br>

        <label for="about">About: 
        <textarea name="about" id="about" readonly  class="bg-white text-dark w-50 border-1 border-dark border-radius-3" style="overflow:hidden; resize: none; box-shadow: 5px 10px ; margin-left:40px;"><?php echo $student['candidateDescription']; ?></textarea><br><br>

        <label for="vision">Vision:</label>    
        <textarea name="vision" id="vision" readonly class="bg-white text-dark w-50 border-1 border-dark border-radius-3" style="overflow:hidden; resize: none; box-shadow: 5px 10px ; margin-left:40px;"><?php echo $student['msg']; ?></textarea><br><br>

        <button class="btn bg-primary text-white text-lg" type="submit" style="margin-left:400px;">Withdraw</button>
        <?php endforeach; ?>
    </div>

    <?php require approot.'/View/inc/footer.php';?>