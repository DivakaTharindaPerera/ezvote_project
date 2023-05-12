<?php
require approot . '/View/inc/VoterHeader.php';
require approot . '/View/inc/AuthNavbar.php';
require approot . '/View/inc/sidebar-new.php';


?>
<div class="main-container">

<!-- <h2 class="m-2" style="">My candidate profile</h2> -->
<br>

<!-- <div class="d-flex shadow border-radius-1 bg-light" style="margin-left:15vh; margin-top:10vh;">     -->
<div class="shadow border-radius-5 bg-light w-75 py-3" style="overflow: hidden;">

    <div class="" style="width: 40%; float: left;">       
        <img src="<?php echo urlroot; ?>/img/candidate/profileImages/<?php echo $res2[0]->profile_picture?>" alt="" class="w-50" style="border-radius:55vh; height:25vh; "/>        
    </div>

    <div class="w-60" style="float: left;">

        <!-- Candidate Name -->
        <h1 name="first-name" id="full-name"  readonly class="w-75 overflow-auto" style="resize: none; margin-left:15px; width:18rem;"><?php echo $res[0]->candidateName?></h1>
        <br><br>

        <!-- Election Name -->
        <div class="d-flex p-1">
        <label for="tre">Election:</label> 
        <textarea name="tre" id="tre"  readonly class="w-75 overflow-auto" style="resize: none; margin-left:30px;"><?php echo $elect[0]->OrganizationName.''.$elect[0]->Title; ?></textarea><br><br>
        </div>

        <!-- Party Name -->
        <div class="d-flex p-1">
        <label for="party">Party:</label> 
        <textarea name="party" id="party"  readonly class="w-75 overflow-auto" style="resize: none; margin-left:50px;"><?php echo $party[0]->partyName; ?></textarea><br><br>
        </div>

        <!-- Position Name -->
        <div class="d-flex p-1">
        <label for="position">Position:</label> 
        <textarea name="position" id="position" readonly class="w-75 overflow-auto" style="resize: none; margin-left:30px;"><?php echo $position[0]->positionName; ?></textarea><br><br>
        </div>

        <!-- Candidate Description -->
        <div class="d-flex p-1">
        <label for="about">About:</label>  
        <textarea name="about" id="about" readonly  class="w-75 overflow-auto" style="resize: none; margin-left:44px;"><?php echo $res[0]->description; ?></textarea><br><br>
        </div>

        <!-- Candidate Vision -->
        <div class="d-flex p-1">
        <label for="vision">Vision:</label>    
        <textarea name="vision" id="vision" readonly class="w-75 overflow-auto" style="resize: none; margin-left:42px;"><?php echo $res[0]->vision; ?></textarea><br><br>
        </div>
    
        <?php 
        if(!empty($res2)){ 
        ?>
        <div class="d-flex">
        <button onclick="openPopup()" class="btn bg-primary text-white mx-1">Edit Profile</button>
        <?php } ?>

        <?php 
        if(!empty($res3)){ 
        ?>
        <button onclick="location.href='/ezvote/Candidates/objections/<?php echo $res[0]->candidateId?>/<?php echo $elect[0]->ElectionId?>'" class="btn bg-primary text-white mx-1">View Objections</button>
        <?php } ?>
        </div>
    </div>
</div>
    <div class="dialog-box-outer" id="popup">
    <div class="form border-1 border-dark p-1 text-1xl bg-light" style="margin-top:60px; margin-left:15rem;">

<form action="/ezvote/Candidates/update_profile/" method="POST" enctype='multipart/form-data' >

<h3 class="text-center">Update Profile</h3>
<br>

<!-- candidate Id -->
    <input style="display:none;" type="number" name="candidateid" value="<?php echo $res[0]->candidateId ?>">

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
<input type="text" name="profile" style="display:none;" value="<?php echo $res2[0]->profile_picture?>" readonly>
<input type="text" name="identity" style="display:none;" value="<?php echo $res2[0]->identity_proof?>" readonly>


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
    <button type="submit" id="btn" name="cancel" class="btn bg-primary text-white m-1 w-10" onclick="closePopup()">Cancel</button>

<!-- update -->
    <button type="submit" id="btn" name="update" class="btn bg-primary text-white m-1 w-10">Update</button>
    <br><br>

</form>
</div>
    </div>
</div>

<?php require approot.'/View/inc/footer.php';?>