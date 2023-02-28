<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>
<?php require approot.'/View/inc/sidebar-new.php';?>

<div class="main-container">
    <div id="taskbar" class="d-flex w-80">
        <div id="buttons" class="m-1 mr-auto">
            <button class="btn btn-primary">Add Voter</button>
        </div>
        <div id="searchBar" class="m-1">
            <input type="text" name="" id="searchInput" placeholder="search for voter....">
        </div>
    </div>
    <div id="votersArea" class="p-1 h-80 overflow-scroll w-100 d-flex flex-wrap align-center justify-content-center">
        <?php 
            foreach($data['unregVoterRow'] as $row){
        ?>
            <div class="card text-center">
                <div class="mb-1">
                    <h4><?php echo $row->name?></h4>
                </div>
                <div class="max-w-95 mb-1">
                    <label class="Email"><?php echo $row->Email?></label>
                </div>
                <div>
                    <div><img src='/ezvote/public/img/profile.jpg' style='max-height:50px;max-width: 50px' alt='profile photo'></div> 
                </div>
                <div>

                </div>
                <div class="buttons">
                    <!-- for the action butttons -->
                </div>
                <div>
                    <label class="text-danger">Not yet registered</label>
                </div>
            </div>
        <?php
            }
            foreach($data['regVoterRow'] as $voter){
                foreach($data['users'] as $user){
                    if($user->UserId == $voter->UserId){
        ?>

            <div class="card text-center">
                <div class="mb-1">
                    <h4><?php echo $user->Fname." ".$user->Lname ?></h4>
                </div>
                <div class="max-w-95 mb-1">
                    <label class="Email"><?php echo $user->Email?></label>
                </div>
                <div>
                    <div><img src='/ezvote/public/img/profile.jpg' style='max-height:50px;max-width: 50px' alt='profile photo'></div> 
                </div>
                <div>

                </div>
                <div class="buttons">
                    
                </div>
            </div>
        <?php
                    }
                }
            }
        ?>
    </div>
</div>

<script>
    // to set the variable font size according to the container width...
    var texts = document.getElementsByClassName("Email");
    for(var i = 0; i < texts.length; i++){
        var maxWidth = texts[i].parentNode.offsetWidth;
        var fontSize = parseInt(window.getComputedStyle(texts[i]).getPropertyValue('font-size'));
        while(texts[i].offsetWidth > maxWidth){
            fontSize--;
            texts[i].style.fontSize = fontSize + 'px';
        }
    }
    //end
</script>

<?php require approot . '/View/inc/footer.php'; ?>