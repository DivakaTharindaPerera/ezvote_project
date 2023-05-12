<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>
<?php require approot.'/View/inc/sidebar-new.php'; ?>

<div class="overflow-y">

<div class="form border-1 border-dark p-1 text-1xl bg-light" style="margin-top:60px; margin-left:15rem;">

<form action="/ezvote/Candidates/update_profile" method="POST" enctype='multipart/form-data' >

<h3 class="text-center">Update Profile</h3>
<br>

<!-- candidate Id -->
    <input style="display:none;" type="number" name="candidateid" value="<?php echo $res[0]->candidateid ?>">

<!-- candidateName -->
    <label for="candidateName">Name:</label>
    <input type="text" name="candidateName" value="<?php echo $res[0]->candidateName?>">

<br><br>

<!-- Email -->
    <label for="email">Email:</label>
    <input type="text" name="candidateEmail" value="<?php echo $res[0]->candidateEmail?>" readonly><br><br>

<!-- Election Name -->
    <label for="election">Election:</label>
    <input type="text" id="position" value="<?php echo $elect[0]->OrganizationName.' '.$elect[0]->Title?>" readonly>
<br><br>

<label for="party">Party:</label>
<label for="position" style="padding-left:58vh;">Position:</label>

<div class="d-flex">
<!-- Party Name -->
    <input type="text" value="<?php echo $party[0]->partyName?>" readonly>

<!-- Position Name -->
    <input type="text" value="<?php echo $position[0]->positionName?>" readonly>
</div>
<br>
<div class="d-flex">
<!-- profile picture -->
    <div class="column">
        <p>Upload Profile Picture:
        <input type="file" id="imgfile" style="color: transparent;" name="imgfile"/></p> 
    </div>

<!-- Identity proof -->
    <div class="column">
        <p>Upload Identity Proof:
        <input type="file" name="file" id="files" style="color: transparent;" multiple></p>
    </div>
</div>
<br>

<!-- candidate description -->
    <label for="candidateDescription">Candidate Description:
    <input type="text" name="description" value="<?php echo $res[0]->description?>">
    <!-- <div class="error" id="candidateDescription_err"><?php echo isset($errors['candidateDescription']) ? $errors['candidateDescription'] : ''; ?></div> -->
<br><br>

    </label>
<!-- Candidate vision -->
    <label for="candidate vision">Candidate Vision:    
    <input type="text" name="vision" value="<?php echo $res[0]->vision?>">
    <!-- <div class="error" id="msg_err"><?php echo isset($errors['msg']) ? $errors['msg'] : ''; ?></div> -->

<br><br></label>

<!-- cancel -->
    <button type="submit" id="btn" name="cancel" class="btn bg-primary m-1 w-10"><a href="<?php echo urlroot; ?>/Candidates/candidateProfile" class="text-white">Cancel</a></button>

<!-- update -->
    <button type="submit" id="btn" name="update" class="btn bg-primary text-white m-1 w-10">Update</button>
    <br><br>

</form>
</div>
</div>
<?php require approot.'/View/inc/footer.php';?>