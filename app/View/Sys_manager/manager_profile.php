<?php 

require approot.'/View/inc/VoterHeader.php';
require approot . '/View/inc/ManagerNavbar.php'; ?>
<?php require approot . '/View/inc/manager_sidebar.php'; ?>
?>

<script>

window.onload = function(){
    var element = document.getElementById("dashboard");
    element.classList.remove("active");

    var element = document.getElementById("profile");
    element.classList.add("active");
}
</script>

<div class="main-container">
    <div class="title mt-1">MANAGER PROFILE</div>
        <div class="d-flex flex-column justify-content-center align-items-center bg-white-0-7 border-radius-2 shadow mb-2 w-50 h-100 mt-1">
            <form action="/ezvote/System_manager/editManagerDetails/<?php echo $data[0]->ManagerID?>" method="post" class="border border-3 border-radius-2 w-100 h-50" >
                <div class="d-flex align-items-center justify-content-center mt-1 img-container">

                    <img id="profileimg"  src="<?php echo urlroot; ?>/public/img/<?php echo $data[0]->Profile_image?>" alt="profile_picture" class="max-h-20 max-w-20" style="width:130px; height:130px; border-radius: 50%">
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

    
                <div class="d-flex flex-row justify-content-evenly my-1">
                    <a href="/ezvote/System_manager/dashboard">
                        <button class="btn btn-primary mr-1" type="button">CANCEL</button>
                    </a>
                        <button type="submit" class="btn btn-primary">EDIT</button>
                </div>
            </form>
        </div>
</div>


<?php require approot.'/View/inc/footer.php';?>