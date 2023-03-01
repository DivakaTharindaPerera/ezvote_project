<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>
<?php require approot.'/View/inc/sidebar-new.php';?>

<div class="main-container" >
    <div id="taskbar" class="d-flex w-90">
        <div id="buttons" class="m-1 mr-auto">
            <button class="btn btn-primary" id="addVoterBtn"><b>ADD VOTER</b></button>
        </div>
        <div id="searchBar" class="m-1">
            <input type="text" name="" id="searchInput" placeholder="search for voters...." class="border-1" style="border-radius: 20px;">
        </div>
    </div>
    <div>
        <input type="hidden" name="" id="electionId" value="<?php echo $data['ID']?>">
        
        <div id="insertNewVoter" class="d-flex flex-column border-1 p-1 border-radius-2 w-100" style="display: none;">
            <h3 class="text-center">Add new Voter</h3>
            <span class="text-danger mt-1"></span>
            <div class="mb-1 mt-1">
                <input type="text" name="" id="" placeholder="Email...." class="border-1">
            </div>
            <div class="mb-1">
                <input type="text" name="" id="" placeholder="Name....." class="border-1">
            </div>
            <div class="mb-1">
                Value of the vote: <input type="number" name="" id="" min="1" class="border-1 w-20" value="1">
            </div>
            <div class="text-center d-flex">
                <button class="btn btn-primary mr-auto" onclick="insertVoter()"><b>ADD</b></button>
                <button class="btn btn-danger ml-auto" onclick="closeDiv()"><b>CANCEL</b></button>
            </div>
        </div>
    </div>
    <div id="votersArea" class="p-1 h-80 overflow-scroll w-100 d-flex flex-wrap align-center justify-content-center mt-1 mb-1">
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

    document.getElementById("addVoterBtn").addEventListener("click", function(){
        document.getElementById("insertNewVoter").style.display = "block";
        document.getElementById("insertNewVoter").getElementsByTagName("input")[0].focus();
    });

    function insertVoter(){
        var id = document.getElementById("electionId").value;

        var email = document.getElementById("insertNewVoter").getElementsByTagName("input")[0].value;
        var name = document.getElementById("insertNewVoter").getElementsByTagName("input")[1].value;
        var value = document.getElementById("insertNewVoter").getElementsByTagName("input")[2].value;

        fetch('<?php echo urlroot; ?>/Elections/addSingleVoter',{
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                id: id,
                email: email,
                name: name,
                value: value
            })
        })
        .then(response => {
            if(response.ok){
                return response.json();
            }else{
                throw new Error('Something went wrong');
            }
        })
        .then(data => {
            if(data.msg == "success"){
                location.reload();
            }else{
                document.getElementById("insertNewVoter").getElementsByTagName("span")[0].innerHTML = data.msg;
                document.getElementById("insertNewVoter").getElementsByTagName("input")[0].focus();
            }
        })
        
    }
    function closeDiv(){
        var inputs = document.getElementById("insertNewVoter").getElementsByTagName("input");
        for(var i = 0; i < inputs.length -1; i++){
            inputs[i].value = "";
        }
        inputs[inputs.length - 1].value = 1;
        
        document.getElementById("insertNewVoter").style.display = "none";
        
    }
</script>

<?php require approot . '/View/inc/footer.php'; ?>