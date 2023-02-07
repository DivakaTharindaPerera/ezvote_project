<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>


<!-- <div class="overflow-y"> -->

<div class="bg_contact_us">

     </div>
     
   <!-- <div class="form"> -->
   <div class="form border-2 border-dark p-2 text-1xl bg-dark px-5 text-white">
        <form action="/ezvote/Candidates/nomination_apply" method="POST" >
        <!-- enctype="multipart/form-data" -->
        
    <h2 class="text-center">Lets Chat</h2>
<br>

<div class="d-flex">
<div class="flex-column px-1 ">
<span>First Name</span><br>
<input type="text" name="firstname" id="firstname" class="text-white bg-primary">
</div>
<div class="flex-column px-1">
<span>Last Name</span><br>
<input type="text" name="lastname" id="lastname" class="text-white">
</div>
</div>
<br>

<div class="d-flex">
<div class="flex-column px-1">
<span>Email</span><br>
<input type="text" name="email" id="email" class="text-white">
</div>
<div class="flex-column px-1">
<span>Phone number</span><br>
<input type="text" name="phone_number" id="phone_number" class="text-white">
</div>
</div>
<br>

<div class="px-1">
<span>Organization, Club or Union</span><br>
<input type="text" name="organization" id="organization" class="text-white">
</div>
<br>

<div class="d-flex">
<div class="flex-column px-1">
<span>Number of Eligible Voters</span><br>
<input type="text" name="no_of_voters" id="no_of_voters" class="text-white">
</div>
<div class="flex-column px-1">
<span>Estimated Vote Start Date</span><br>
<input type="text" name="start_date" id="start_date" class="text-white">
</div>
</div>
<br>

<div class="px-1">
<span>Provide additional details about your voting event</span><br>
<input type="text" name="details" id="details" class="text-white">
</div>
<br>

<!-- save     -->
    <button type="submit" id="btn" name="submit" class="btn bg-red-6 text-white" style="margin-left:200px;">Submit</button>
    <br><br>
    
</form>
<!-- </div> -->
   </div>           

<!-- </div> -->

<?php require approot.'/View/inc/footer.php';?>