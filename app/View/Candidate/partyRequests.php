<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>
<?php require approot . '/View/inc/side_bar.php'; ?>

<div class="w-75 overflow-y p-4" style="padding-left:40vh; scrollbar-width: none; ">
<table>
    <tr>
        <th style="background: rgb(5, 68, 104);">RequestNo</th>
        <th>Candidate Name</th>
        <th>Candidate Vision</th>
        <th>Identity Proof</th>
        <th>Request Accept/Reject</th>
    </tr>   
<?php 
    foreach ($request as $value){
?>
    <tr class="comment">
        <td><?php echo $value->request_id?></td>
        <td><?php echo $value->candidate_name?></td>
        <td><?php echo $value->candidate_vision?></td>
        <td><?php echo $value->identity_proof?></td>

        <?php 
            if($value->status==0) {
        ?>
        <td>
        <button class="btn-success text-white border-radius-3 px-1" onclick="location.href='/ezvote/Candidates/acceptPartyRequest?id=<?php echo $value->request_id ?>'">Accept</button> 
        <button class="btn-danger text-white border-radius-3 px-1" onclick="openPopupPassId()" data-request_id="<?php echo $value->request_id ?>">Reject</button>
        </td>
        <?php 
            }elseif ($value->status==1) {
        ?>
        <td>Accepted</td>
        <?php 
            }elseif ($value->status==2) {
        ?>
        <td>Rejected</td>
        <?php
            }
        ?>

        
    </tr> 
<?php 
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
                                            
    
                                            <div><input type="number" style="display:none" name="request_id" value="2"> </input></div>
                                            <div class="d-flex justify-content-between my-1 w-100">
                                                <div><button class="btn btn-danger px-1" onclick="closePopup()">Cancel</div>
                                                <div><button class="btn btn-primary px-1" type="submit">Submit</div>
                                            </div>
                                        </form>
                                    </div>
</div>
</table>
</div>

<?php require approot.'/View/inc/footer.php';?>