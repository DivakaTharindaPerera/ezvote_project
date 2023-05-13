<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/ManagerNavbar.php'; ?>
<?php require approot . '/View/inc/manager_sidebar.php'; ?>

<script>

window.onload = function(){
    var element = document.getElementById("dashboard");
    element.classList.remove("active");

    var element = document.getElementById("announcement");
    element.classList.add("active");
}
</script>

<div class="main-container">
    <div class="d-flex flex-column w-80 h-50 mt-2 mb-2 overflow-y">

<div class="sysmanager">
    <div class="title text-uppercase mt-1">Announcements</div>
</div><br>
<div class="min-w-85 min-h-85 border border-primary border-radius-2 border-3 px-1 py-1 overflow-y">
<form action="./announcements" method="POST">
<div class="d-flex flex-column min-w-40">
    <div>
    <label class="font-semibold leading-loose text-xl">Head</label>
    </div>
    <div class="d-flex mr-5">
    <input class="border border-primary bg-primary min-w-40" type="text" name="head" id="head" placeholder="Enter email head here..." required>

    </div>
</div>
<br>
<div class="d-flex flex-column min-w-40 ">
    <div class="mt-1">
    <label class="font-semibold leading-loose text-xl">Body</label>   
    </div>

    <div class="d-flex mr-5 h-20">
    <input class="border border-primary h-20" type="long-text" name="body" id="body" placeholder="Enter email body here..." required>
    </div>
</div>


<br>
<div class="send mt-1">
    <label class="font-semibold leading-loose text-xl">Send to</label>
</div>
<div class="body-div leading-relaxed">
    <div class="text-lg">
        <input type="radio" id="user1" name="user" value="alluser" style="width: 19px; height: 19px;" onchange=radiocheck()>
        <label for="user" style="margin-left: 10px;">All users</label>
    </div>

    <div class="text-lg">
        <input type="radio" id="user2" name="user" value="specificuser" style="width: 19px; height: 19px;" onchange=radiocheck()>
        <label for="user"  style="margin-left: 10px;">Specific users</label>
    </div>

    <script>
        function radiocheck(){
            var radio = document.getElementById("user1");
            var radioch = radio.checked;
            console.log(radioch);
            if (radio.checked == true) {
                document.getElementById("user3").checked = true;
                document.getElementById("user4").checked = true;
                document.getElementById("user5").checked = true;
            } else {
                document.getElementById("user3").checked = false;
                document.getElementById("user4").checked = false;
                document.getElementById("user5").checked = false;
               
            } 
        }
    </script>
</div>
<br>
<div class="user mt-1">
    <label class="font-semibold leading-loose text-xl">User roles</label>
</div>

<div class="body-div2 leading-relaxed">
    <div class="text-lg">
        <input type="checkbox" id="user3" name="Supervisors" value="Supervisors">
        <label for="user3" style="word-wrap: break-word;">Supervisors</label>
    </div>
    <div class="text-lg">
        <input type="checkbox" id="user4" name="Voters" value="Voters">
        <label for="user4" style="word-wrap: break-word;">Voters</label>
    </div>
    <div class="text-lg">
        <input type="checkbox" id="user5" name="Candidates" value="Candidates">
        <label for="user5" style="word-wrap: break-word;">Candidates</label>
    </div>
</div>

<br>

<div class="d-flex justify-content-evenly">
    <div class="d-flex w-100 justify-content-evenly">
        <div class="d-flex justify-content-start">
        <a href="/ezvote/System_manager/dashboard">
            <button class="btn btn-primary" type="button" class="button" id="cancel">CANCEL</button>
        </a>
        </div>
        <div class="d-flex justify-content-end">
        <a href="#">
        <button class="btn btn-primary gap-3" type="submit" class="button" id="send" onclick="success()">SEND</button>

        </a>
        </div>
    
    </div>
</div>
</form> 
</div> 
</div>
</div>

<?php require approot . '/View/inc/footer.php'; ?>

