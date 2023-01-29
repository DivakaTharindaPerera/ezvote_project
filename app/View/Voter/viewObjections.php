
<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>

<div class=" d-flex flex-column justify-content-center bottom-0 max-w-85 absolute right-0 min-w-85 overflow-x bg-secondary" style="max-height:90.5%;min-height:90.5%"">
    <?php require approot . '/View/inc/Sidebar.php'; ?>
    <div class="d-flex justify-content-center flex-column align-items-center ">
        <?php if(empty($r)){ ?>
            <div class="d-flex justify-content-center">
                <div class="title">No Objections made by you</div>
            </div>
        <?php }
        else{?>
            <div class="title">Objections made by you</div>
                <?php foreach ($r as $value){?>
                    <div class="card" style="min-width: 250px;min-height: 250px">
                        <div class="text-md">Sandun Jayasanka</div>
                        <div class=""><img src="/ezvote/public/img/profile.jpg" style="max-height: 100px;max-width: 100px" alt="" id="profile-pic"></div>
                        <div class="d-flex flex-column">
                        <div class="d-flex flex-column">
                            <label for="Election" id="election"></label>
                            <div class="align-items-center">Subject:<?php echo $value->Subject?></div>
                            <button class="btn btn-primary" onclick="openPopup()">View Description</button>
                            <div class="dialog-box-outer" id="popup">
                                <div class="popup mx-1 my-1 px-1 py-1 min-w-40 min-h-50" >
                                    <div class="d-flex align-items-flex-end justify-content-end" onclick="closePopup()"><img src="/ezvote/public/img/clear.png" alt="" style="max-height: 10vh"></div>
                                    <div class="d-flex flex-column my-1 w-100">
<!--                                    <label for="Description" class="mr-1 text-left text-md">Description</label>-->
                                        <?php echo $value->Description?>
                                    </div>
                                    </div>
                        </div>
                    </div>
                <div><button class="btn btn-danger px-1 mt-1" type="submit">Remove</div>
            </div>
        </div>
        <?php }?>
    </div>
    <?php } ?>
    <?php
        require approot . '/View/inc/footer.php'; ?>

