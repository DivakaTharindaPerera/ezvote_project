<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>
<?php require approot . '/View/inc/sidebar-new.php'; ?>

<div class="main-container">

<div class="bg-dark p-1 w-65" style="margin-top:5vh;">
<label class="text-white" for="search"><i class="fa-solid fa-magnifying-glass"></i> Search</label>
<input type="search" id="search" placeholder="Type to search..." class="border-success border-6 text-white">
</div>

<div class="w-100 p-4" style="scrollbar-width: none; z-index:1;">
<table id="table">

<thead class="border-2 border-dark">
    <tr>
        <th class="border-2 border-white" style="background: rgb(5, 68, 104);">RequestNo</th>
        <th class="border-2 border-white w-15">Election Name</th>
        <th class="border-2 border-white w-15">Candidate Name</th>
        <th class="border-2 border-white">Candidate Vision</th>
        <th class="border-2 border-white">Identity Proof</th>
        <th class="border-2 border-white w-25">Request Accept/Reject</th>
    </tr>
</thead>   

<?php 
    // var_dump($electName);
    // exit;
    $increment=1;
    foreach ($request as $value){
?>
<tbody class="">
    <tr class="comment table-row">
        <td><?php echo $increment?></td>
        <td class="text-left"><?php echo $electName[$value->request_id]?></td>
        <td class="text-left"><?php echo $value->candidate_name?></td>
        <td class="text-left"><?php echo $value->candidate_vision?></td>
        <td class="text-left"><a href="<?php echo urlroot; ?>/img/candidate/proofDocuments/<?php echo $value->identity_proof?>" download><?php echo $value->identity_proof?></a></td>

        <?php 
            if($value->status==0) {
        ?>
        <td>
        <button class="btn-success text-white border-radius-3 px-1" onclick="location.href='/ezvote/Candidates/acceptPartyRequest/<?php echo $value->request_id ?>/<?php echo $value->user_id ?>'">Accept</button> 
        <button class="btn-danger text-white border-radius-3 px-1" onclick="openPopupPassId()" data-request_id="<?php echo $value->request_id ?>" data-candidate_id="<?php echo $value->user_id ?>">Reject</button>
        </td>
        <?php 
            }elseif ($value->status==1) {
        ?>
        <td class="text-success">Accepted</td>
        <?php 
            }elseif ($value->status==2) {
        ?>
        <td class="text-danger">Rejected</td>
</tbody>
        <?php
            }
        ?>

        
    </tr> 
<?php 
    $increment++;
    } 
?>

<div class="dialog-box-outer" id="popup">
    <div class="popup mx-1 my-1 px-1 py-1 min-w-40 min-h-50">
        <div class="title">Rejecting Party Request</div>
            <form action="/ezvote/Candidates/partyRequests" method="POST" class="d-flex flex-column my-1 px-1 align-items-flex-start">
                <div class="d-flex flex-column my-1 w-100">
                    <label for="reason" class="mr-1 text-left text-md">Reason</label>
                    <textarea class="border-1" name="reason" style="height: 150px;width: 100%"></textarea>
                </div>

                <div><input type="number" style="display:none" name="request_id" value=""> </input></div>
                <div><input type="number" style="display:none" name="candidate_id" value=""> </input></div>

                <div class="d-flex justify-content-between my-1 w-100">
                    <div><button class="btn btn-danger px-1" onclick="closePopup()">Cancel</div>
                    <div><button class="btn btn-primary px-1" type="submit">Submit</div>
                </div>
            </form>
        </div>
</div>
</table>
</div>
</div>
<script src="<?php echo urlroot; ?>/js/partyRequest.js"></script>
<?php require approot.'/View/inc/footer.php';?>