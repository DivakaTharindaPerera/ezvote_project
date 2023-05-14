<?php
//echo '<pre>';
//var_dump($data['user']);
//exit();
require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>
<?php require approot . '/View/inc/sidebar-new.php'; ?>

<div class="main-container">
    <div class="d-flex flex-column align-items-center min-h-100">
        <?php if(empty($data['objections'])){ ?>
            <div class="d-flex justify-content-center">
                <div class="title">No Objections made by you</div>
            </div>
        <?php }
        else{?>
            <div class="title">Objections made by you</div>
        <div class="d-flex flex-wrap shadow bg-light min-w-100 max-w-100">
        <?php foreach ($data['objections'] as $value){?>
            <div class="card" style="min-width: 250px;min-height: 250px">
                    <div class="text-md"><?php echo $data['candidate']->candidateName?></div>
                    <div class=""><img src="<?= $data['user']->ProfilePicture?>" style="max-height: 100px;max-width: 100px" alt="" id="profile-pic"></div>
                    <div class="d-flex flex-column">
                        <div class="d-flex flex-column">
                            <label for="Election" id="election"></label>
<!--                            <div class="align-items-center">Subject:--><?php //echo $value->Subject?><!--</div>-->
                            <button class="btn btn-primary" onclick="openPopup()">View Objection</button>
                            <div class="dialog-box-outer" id="popup">
                                <div class="popup mx-1 my-1 px-1 py-1 min-w-40 min-h-50 " >
                                    <div class="d-flex flex-column border-2 border-primary border-radius-2 min-h-100">
                                        <div class="d-flex align-items-flex-end justify-content-end" onclick="closePopup()"><img src="/ezvote/public/img/clear.png" alt="" style="max-height: 8vh"></div>
                                        <div class="d-flex flex-column my-1 w-100">
                                            <div class="align-items-center">Subject:<?php echo $value->Subject?></div>
<!--                                            <label for="Description" class="mr-1 text-left text-md">Description</label>-->
                                            <div class="align-items-center">Description:<?php echo $value->Description?></div>
                                            <div class="align-items-center">Respond:<?php
                                            if(empty($value->Respond)){?>
                                                <div class=" text-lg text-primary">No respond yet</div>
                                                <?php } else{
                                                    echo $value->Respond;
                                                }?>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                        <form action="" method="post">
                            <input name="id" value="<?=$value->ObjectionID?>" hidden>
                            <input class="btn btn-info px-1 mt-1"  type="submit" value="Remove"/>
                        </form>
                </div>
        <?php }?>
        </div>
    </div>
    <?php } ?>
    <?php require approot . '/View/inc/footer.php'; ?>

