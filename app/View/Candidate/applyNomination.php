<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>

<!-- <div class="overflow-y"> -->

    <div class="overflow-y form border-1 border-dark p-2 text-1xl bg-light" style=" margin-top:60px; ">
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

<label for="fullname">Name<span class="text-danger">*</span> :</label>
<div class="d-flex">

<!-- first Name -->
<input type="text" name="firstname" id="firstname" placeholder="First Name...">
<em class="text-danger"><?php if(isset($data['fname_err'])){ echo $data['fname_err']; } ?></em>


<!-- last Name -->
<input type="text" name="lastname" id="lastname" placeholder="Last Name...">
<em class="text-danger"><?php if(isset($data['lname_err'])){ echo $data['lname_err']; } ?></em>

</div>
<br>

<!-- Election Name -->
<label for="election">Election<span class="text-danger">*</span> :</label>
<input type="text" name="election_name" id="election_name" placeholder="Election you wish to contest...">
<em class="text-danger"><?php if(isset($data['election_err'])){ echo $data['election_err']; } ?></em>

<br><br>

<!-- Position -->
<label for="positions">Select position<span class="text-danger">*</span> :</label>

<select name="position" id="position" class="border-1 border-dark w-25">
  <option value="">Select...</option>
  <option value="president">President</option>
  <option value="wise president">Wise President</option>
  <option value="secretary">Secretary</option>
  <option value="Treasurer">Treasurer</option>
</select>
<em class="text-danger"><?php if(isset($data['position_err'])){ echo $data['position_err']; } ?></em>

<br><br>

<label for="party-names">Party Name<span class="text-danger">*</span> :</label>


<!-- party name -->
    <input type="text" class="new_party" name="party_name" id="party_name" placeholder="Party Name..."><br><br>
    <em class="text-danger"><?php if(isset($data['party_err'])){ echo $data['party_err']; } ?></em>
    <br>
<div class="d-flex">

<!-- profile picture -->
    <div class="column">
        <p>Upload Profile Picture<span class="text-danger">*</span> :
          <input type="file" id="imgfile" style="color: transparent;"name="imgfile"/></p>
          <em class="text-danger"><?php if(isset($data['profilepic_err'])){ echo $data['profilepic_err']; } ?></em>
    </div>

<!-- upload identity proof -->
    <div class="column">
        <p>Upload Identity Proof<span class="text-danger">*</span> :
        <input type="file" name="file" id="files" style="color: transparent;" multiple></p>
        <em class="text-danger"><?php if(isset($data['identityproof_err'])){ echo $data['identityproof_err']; } ?></em>
    </div>
</div>
<br>

<!-- candidate description -->
    <label for="candidateDescription">Candidate Description<span class="text-danger">*</span> :
    <input type="text" name="candidateDescription" id="candidateDescription" placeholder="Candidate description...">
    <em class="text-danger"><?php if(isset($data['description_err'])){ echo $data['description_err']; } ?></em>
<br><br>

    </label>
<!-- msg to the voters -->
    <label for="candidate vision">Candidate Vision<span class="text-danger">*</span> :    
    <input type="text" name="msg" id="msg" placeholder="Message to the voters...">
    <em class="text-danger"><?php if(isset($data['msg_err'])){ echo $data['msg_err']; } ?></em>

<br><br></label>

<!-- cancel -->
    <button type="submit" id="btn" name="cancel" class="btn bg-primary m-1 w-10"><a href="<?php echo urlroot; ?>/Candidates/applyNomination" class="text-white">Cancel</a></button>

<!-- save -->
    <button type="submit" id="btn" name="save" class="btn bg-primary text-white m-1 w-10">Save</button>
    <br><br>
    
</form>
</div>
<!-- </div> -->
<?php require approot.'/View/inc/footer.php';?>