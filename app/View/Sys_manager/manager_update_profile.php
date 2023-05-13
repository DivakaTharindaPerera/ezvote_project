<?php 

require approot.'/View/inc/VoterHeader.php';
require approot . '/View/inc/ManagerNavbar.php'; ?>
<?php require approot . '/View/inc/manager_sidebar.php'; ?>
?>

<div class="main-container">
    <div class="title">MANAGER PROFILE</div>
    <div class="d-flex flex-column justify-content-center align-items-center bg-white-0-7 border-radius-2 shadow mb-2 w-50 h-100 mx-2">
        
            <form action="../updateProfileProcess/<?php echo $data[0]->ManagerID?>" method="post" class="border border-3 border-radius-2 w-100 h-50" >
                <div class="d-flex align-items-center justify-content-center mt-1 img-container">

                <img id="profileimg"  src="<?php echo urlroot; ?>/public/img/<?php echo $data[0]->Profile_image?>" alt="profile_picture" class="max-h-20 max-w-20" style="width:130px; height:130px; border-radius: 50%">

                <input type="text" id="profile" name="profile" accept="image/*" hidden>
            </div> 
            <div class="d-flex flex-column font-bold mt-2 mx-2">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="<?php echo $data[0]->Name?>" placeholder="<?php echo $data[0]->Name?>" class="border border-primary border-1 border-radius-1" >
            </div>
            
            <div class="d-flex flex-column font-bold mt-2 mx-2 mb-1">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo $data[0]->Email?>" placeholder="<?php echo $data[0]->Email?>" class="border border-primary border-1 border-radius-1">
                <br>
            </div>

            <div class="d-flex flex-column font-bold mt-2 mx-2 mb-1">
                <label for="email">Current Password</label>
                <input type="email" id="email" name="email"  placeholder="Enter Current Password" class="border border-primary border-1 border-radius-1" required>
                <br>
            </div>

            <div class="d-flex flex-column font-bold mt-2 mx-2 mb-1">
                <label for="email">New Password</label>
                <input type="email" id="email" name="email" placeholder="Enter New Password" class="border border-primary border-1 border-radius-1" required>
                <br>
            </div>

            <div class="d-flex flex-column font-bold mt-2 mx-2 mb-1">
                <label for="email">Confirm Password</label>
                <input type="email" id="email" name="email" placeholder="Enter New Password again to Confirm" class="border border-primary border-1 border-radius-1" required>
                <br>
            </div>
    
            <div class="d-flex flex-row justify-content-evenly my-1">
                <a href="/ezvote/System_manager/dashboard">
                    <button class="btn btn-primary mr-1" type="button">CANCEL</button></a>
                <a href="/ezvote/System_manager/updateProfile">
                    <button type="button" class="btn btn-primary">SAVE</button>
                </a>
            </div>
        </form>
    </div>
</div>


<?php require approot.'/View/inc/footer.php';?>