<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/ManagerNavbar.php'; ?>
<?php require approot . '/View/inc/manager_sidebar.php'; ?>

<script>

window.onload = function(){
    var element = document.getElementById("home");
    element.classList.remove("active");

    var element = document.getElementById("announcement");
    element.classList.add("active");
}
</script>

<div class="main-container">
    <div class="d-flex flex-column w-80 h-50 mt-2 mb-2">

<div class="sysmanager">
    <div class="title text-uppercase mt-1">Announcements</div>
</div><br>
<form action="./announcements" method="POST">
<div class="d-flex flex-column min-w-40">
    <div>
    <label class="font-semibold leading-loose text-xl">Head</label>
    </div>
    <div class="d-flex mr-5">
    <input class="border border-primary min-w-40" type="text" name="head" id="head" placeholder="Enter email head here..." required>

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

<!-- <div class="subscription">
    <label class="font-bold">Subscriptions</label>
</div> -->

<!-- <div class="body-div3">
    <div>
        <input type="checkbox" id="plan1" name="plan1">
        <label for="plan1" style="word-wrap: break-word;">Extreme Plan</label>
    </div>
    <div>
        <input type="checkbox" id="plan2" name="plan2">
        <label for="plan2" style="word-wrap: break-word;">Annual Plan</label>
    </div>
    <div>
        <input type="checkbox" id="plan3" name="plan3">
        <label for="plan3" style="word-wrap: break-word;">Monthly Plan</label>
    </div>
    <div>
        <input type="checkbox" id="plan4" name="plan4">
        <label for="plan4" style="word-wrap: break-word;">Starter Plan</label>
    </div>
    <div>
        <input type="checkbox" id="plan5" name="plan5">
        <label for="plan5" style="word-wrap: break-word;">Free Plan</label>
    </div> -->

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

        <script>
            function success() {
                alert("Notification mail sent succesfully.");
            }
        
        </script>"


<?php require approot . '/View/inc/footer.php'; ?>

