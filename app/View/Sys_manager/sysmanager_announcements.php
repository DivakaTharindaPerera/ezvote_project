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

<div class="main-container" >
    <div class="d-flex flex-column w-75 mb-2">

<div class="sysmanager">
    <h2 class="title">Announcements</h2>
</div><br>

<div class="d-flex flex-column min-w-40">
    <div>
    <h3>Head</h3>
    </div>
    <div class="d-flex mr-5">
    <input class="border border-primary min-w-40" type="text" id="bodytext" placeholder="HOT offer! grab quick">

    </div>
</div>
<br>
<div class="d-flex flex-column min-w-40">
    <div>
    <h3>Body</h3>
        
    </div>
    <div class="d-flex mr-5 h-20">
    <input class="border border-primary h-20" type="description" id="bodytext" placeholder="20% off on Annual subscription plan">

    </div>
</div>


<br>
<div class="send">
    <h3>Send to</h3>
</div>
<div class="body-div">
    <div>
        <input type="radio" id="user1" name="user" style="width: 19px; height: 19px;" onchange=radiocheck()>
        <label for="user" style="margin-left: 10px;">All users</label>
    </div>

    <div>
        <input type="radio" id="user2" name="user" style="width: 19px; height: 19px;" onchange=radiocheck()>
        <label for="user"  style="margin-left: 10px;">Specific users</label>
    </div>

    <script>
        function radiocheck(){
            var radio = document.getElementById("user1");
            var radioch = radio.checked;
            console.log(radioch);
            if (radio.checked == true) {
                document.getElementById("user3").disabled = true;
                document.getElementById("user4").disabled = true;
                document.getElementById("user5").disabled = true;
            } else {
                document.getElementById("user3").disabled = false;
                document.getElementById("user4").disabled = false;
                document.getElementById("user5").disabled = false;
            } 
        }
    </script>
</div>
<br>
<div class="user">
    <h3>User roles</h3>
</div>

<div class="body-div2">
    <div>
        <input type="checkbox" id="user3" name="user1">
        <label for="user1" style="word-wrap: break-word;">Supervisors</label>
    </div>
    <div>
        <input type="checkbox" id="user4" name="user2">
        <label for="user2" style="word-wrap: break-word;">Voters</label>
    </div>
    <div>
        <input type="checkbox" id="user5" name="user3">
        <label for="user3" style="word-wrap: break-word;">Candidates</label>
    </div>
</div>

<br>

<div class="subscription">
    <label style="font-weight: 700;">Subscriptions</label>
</div>

<div class="body-div3">
    <div>
        <input type="checkbox" id="plan1" name="plan1">
        <label for="plan1" style="word-wrap: break-word;">Annual Plan</label>
    </div>
    <div>
        <input type="checkbox" id="plan2" name="plan2">
        <label for="plan2" style="word-wrap: break-word;">Starter Plan</label>
    </div>
    <div>
        <input type="checkbox" id="plan3" name="plan3">
        <label for="plan3" style="word-wrap: break-word;">Extreme Plan</label>
    </div>
    <div>
        <input type="checkbox" id="plan4" name="plan4">
        <label for="plan4" style="word-wrap: break-word;">Monthly Plan</label>
    </div>

    </div>
<div class="d-flex justify-content-evenly">
    <form action="#" method="POST" class="d-flex w-100 justify-content-evenly">
        <div class="d-flex justify-content-start">
        <a href="/ezvote/System_manager/dashboard">
            <button class="btn btn-primary" type="button" class="button" id="send">SEND</button>
        </a>
        </div>
        <div class="d-flex justify-content-end">
        <a href="/ezvote/System_manager/dashboard">
        <button class="btn btn-primary gap-3" type="button" class="button" id="cancel" >CANCEL</button>
        </a>
        </div>
    
    </form>
    </div>
    
</div>
</div>

<?php require approot . '/View/inc/footer.php'; ?>

