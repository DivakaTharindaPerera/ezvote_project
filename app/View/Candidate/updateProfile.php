<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>
<?php require approot.'/View/inc/side_bar.php'; ?>

<div class="overflow-y">

    <div class="form border-1 border-dark p-1 text-1xl bg-light" style="margin-top:60px; margin-left:15rem;">
        <form action="/ezvote/Candidates/update_candidate_profile" method="POST" enctype='multipart/form-data' >
        <!-- enctype="multipart/form-data" -->
        <h3 class="text-center">Update Profile</h3>


<label for="fullname">Name:</label>
<input type="text" name="candidateName" placeholder="Name...">

<br><br>

<!-- Election Name -->
<label for="email">Email:</label>
<input type="text" name="candidateEmail" placeholder="Email address...">

<!-- Position -->
<!-- <label for="positions">Select position :</label>
<input type="text" name="position" id="position" placeholder="Position you wish to contest..."> -->

<br><br>

<!-- <label for="party-names">Party Name:</label> -->

<!-- new party name -->
    <!-- <input type="text" class="new_party" name="party_name" id="party_name" placeholder="Party Name..."><br><br> -->
    <!-- <div class="error" id="party_name_err"><?php echo isset($errors['new_party']) ? $errors['new_party'] : ''; ?></div> -->
    <br>

<div class="d-flex">
<!-- profile picture -->
    <div class="column">
        <p>Upload Profile Picture:
          <input type="file" id="imgfile" style="color: transparent;" name="imgfile"/></p>
          
    </div>

<!-- upload identity proof -->
    <div class="column">
        <p>Upload Identity Proof:
        <input type="file" name="file" id="files" style="color: transparent;" multiple></p>

    </div>
</div>
<br><br>

<!-- candidate description -->
    <label for="candidateDescription">Candidate Description:
    <input type="text" name="description" placeholder="Candidate description...">
    <!-- <div class="error" id="candidateDescription_err"><?php echo isset($errors['candidateDescription']) ? $errors['candidateDescription'] : ''; ?></div> -->
<br><br>

    </label>
<!-- msg to the voters -->
    <label for="candidate vision">Candidate Vision:    
    <input type="text" name="vision" placeholder="Message to the voters...">
    <!-- <div class="error" id="msg_err"><?php echo isset($errors['msg']) ? $errors['msg'] : ''; ?></div> -->

<br><br></label>

<!-- cancel -->
    <button type="submit" id="btn" name="cancel" class="btn bg-primary m-1 w-10"><a href="<?php echo urlroot; ?>/Candidates/candidateProfile" class="text-white">Cancel</a></button>

<!-- save -->
    <button type="submit" id="btn" name="update" class="btn bg-primary text-white m-1 w-10">Update</button>
    <br><br>
    <!-- <a href="<?php echo urlroot; ?>/Candidates/nominationSuccessful" class="text-white"> -->
</form>
</div>
</div>
<!-- <?php require approot.'/View/inc/footer.php';?> -->