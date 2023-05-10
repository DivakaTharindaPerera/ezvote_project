<?php
require approot . '/View/inc/VoterHeader.php';
require approot . '/View/inc/AuthNavbar.php';
require approot . '/View/inc/sidebar-new.php';
?>

<div class="main-container">

    <div class="overflow-y form border-1 border-dark p-2 text-1xl bg-light">
        <form action="/ezvote/Candidates/party_apply" method="POST" enctype='multipart/form-data' >
        
    <h2 class="text-center">Apply Party</h2>
    <br>
    <div class="p-2 bg-blue-10 text-white">
        <p class="rules">Rules and regulations entered by the supervisor when 
            creating the election are displayed here.

        <br><br>Required documents:</p>
        <br>
        <ul>
            <li>NIC</li><br>
            <li>Self Declaration</li><br>
            <li>Membership card</li>
        </ul>
    </div>
    <br><br>
<input type="number" style="display:none;" value="<?=$elect_id?>" name="elect_id">

<label for="fullname">Name<span class="text-danger">*</span> :</label>
<div class="d-flex">

<!-- first Name -->
<input type="text" name="firstname" placeholder="First Name...">
<em class="text-danger"><?php if(isset($data['fname_err'])){ echo $data['fname_err']; } ?></em>


<!-- last Name -->
<input type="text" name="lastname" placeholder="Last Name...">
<em class="text-danger"><?php if(isset($data['lname_err'])){ echo $data['lname_err']; } ?></em>

</div>
<br>

<!-- party name --> 
<label for="party-names">Party Name<span class="text-danger">*</span> :</label>

<select name="party_name" class="w-50 selectName" style="margin-left:1.2rem;">
<option value="" disabled selected>Please select...</option>
        <?php foreach ($parties as $party){ ?>
<option value="<?php echo $party->partyName ?>"><?php echo $party->partyName ?></option>
        <?php } ?> 
</select>
<br><br><br>

<!-- upload identity proof -->
    <div class="column">
        <p>Upload Identity Proof<span class="text-danger">*</span> :
        <input type="file" name="file" style="color: transparent;" multiple></p>
        <em class="text-danger"><?php if(isset($data['identityproof_err'])){ echo $data['identityproof_err']; } ?></em>
    </div>
<br>

    </label>
<!-- msg to the voters -->
    <label for="candidate vision">Candidate Vision<span class="text-danger">*</span> :    
    <input type="text" name="msg" placeholder="Message to the voters...">
    <em class="text-danger"><?php if(isset($data['msg_err'])){ echo $data['msg_err']; } ?></em>

<br><br></label>

<!-- cancel -->
    <button type="submit" name="cancel" class="btn bg-primary m-1 w-10"><a href="<?php echo urlroot; ?>/Candidates/applyNomination" class="text-white">Cancel</a></button>

<!-- save -->
    <button type="submit" name="save" class="btn bg-primary text-white m-1 w-10">Save</button>
    <br><br>
    
</form>
</div>
</div>
<?php require approot.'/View/inc/footer.php';?>