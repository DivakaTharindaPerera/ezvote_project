<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>

<div class="overflow-y">

    <div class="form border-1 border-dark p-2 text-1xl bg-light" style=" margin-top:60px; ">
        <form action="/ezvote/Candidates/nomination_apply" method="POST" enctype='multipart/form-data' >
        <!-- enctype="multipart/form-data" -->
        
    <h2 class="text-center">Apply Nominations</h2>
    <br>
    <div class="p-2 bg-blue-10 text-white">
        <p class="rules">Rules and regulations entered by the supervisor when 
            creating the election are displayed here.

        <br><br>Required documents:</p>
        <ul>
            <li>NIC</li><br>
            <li>Self Declaration</li><br>
            <li>Membership card</li>
        </ul>
    </div>
    <br><br>

<label for="fullname">Name:</label>
<div class="d-flex">

<!-- first Name -->
<input type="text" name="firstname" id="firstname" placeholder="First Name...">
<!-- <div class="error" id="firstname_err"><?php echo isset($errors['firstname']) ? $errors['firstname'] : ''; ?></div> -->

<!-- last Name -->
<input type="text" name="lastname" id="lastname" placeholder="Last Name...">
<!-- <div class="error" id="lastname_err"><?php echo isset($errors['lastname']) ? $errors['lastname'] : ''; ?></div> -->

</div>
<br>

<!-- Election Name -->
<label for="election">Election:</label>
<input type="text" name="election_name" id="election_name" placeholder="Election you wish to contest...">
<div class="error" id="election_name_err"><?php echo isset($errors['election_name']) ? $errors['election_name'] : ''; ?></div>

<br><br>

<!-- Position -->
<label for="positions">Select position :</label>

<select name="position" id="position" class="border-1 border-dark w-25">
  <option value="">Select...</option>
  <option value="president">President</option>
  <option value="wise president">Wise President</option>
  <option value="secretary">Secretary</option>
  <option value="tresurer">Tresurer</option>
</select>
<!-- <div class="error" id="position_err"><?php echo isset($errors['position']) ? $errors['position'] : ''; ?></div> -->

<br><br>

<!-- check if the party is existing party -->

<!-- <div class="error" id="checkbox_err"><?php echo isset($errors['checkbox']) ? $errors['checkbox'] : ''; ?></div> -->
<div class="check">


<!-- Create new party -->

<label for="party-names">Party Name:</label>


<!-- new party name -->
    <input type="text" class="new_party" name="party_name" id="party_name" placeholder="Party Name..."><br><br>
    <!-- <div class="error" id="party_name_err"><?php echo isset($errors['new_party']) ? $errors['new_party'] : ''; ?></div> -->

<!-- new party description -->

    </div>
    <br>
<div class="d-flex">

<!-- profile picture -->
    <div class="column">
        <p>Upload Profile Picture:
          <input type="file" id="imgfile" style="color: transparent;"name="imgfile"/></p>
          
    </div>

<!-- upload identity proof -->
    <div class="column">
        <p>Upload Identity Proof:
        <input type="file" name="file" id="files" style="color: transparent;" multiple></p>

    </div>
</div>
<br>

<!-- candidate description -->
    <label for="candidateDescription">Candidate Description:
    <input type="text" name="candidateDescription" id="candidateDescription" placeholder="Candidate description...">
    <!-- <div class="error" id="candidateDescription_err"><?php echo isset($errors['candidateDescription']) ? $errors['candidateDescription'] : ''; ?></div> -->
<br><br>

    </label>
<!-- msg to the voters -->
    <label for="candidate vision">Candidate Vision:    
    <input type="text" name="msg" id="msg" placeholder="Message to the voters...">
    <!-- <div class="error" id="msg_err"><?php echo isset($errors['msg']) ? $errors['msg'] : ''; ?></div> -->

<br><br></label>

<!-- cancel -->
    <button type="submit" id="btn" name="cancel" class="btn bg-primary m-1 w-10"><a href="<?php echo urlroot; ?>/Candidates/viewAllElections" class="text-white">Cancel</a></button>

<!-- save -->
    <button type="submit" id="btn" name="save" class="btn bg-primary text-white m-1 w-10">Save</button>
    <br><br>
    <!-- <a href="<?php echo urlroot; ?>/Candidates/nominationSuccessful" class="text-white"> -->
</form>
</div>
</div>
<!-- <?php require approot.'/View/inc/footer.php';?> -->