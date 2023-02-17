<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/ManagerNavbar.php'; ?>
<?php require approot . '/View/inc/manager_sidebar.php'; ?>

<!-- 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width , initial-scale=1.0">
    <title>sysmanager_announcemets</title>
    <link rel="stylesheet" href="<?php echo urlroot; ?>/public/css/sysmanager_announcements.css">
</head> -->

<!-- <body> -->

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

<!-- <div class="justify-content-center">
    <label style="font-weight: 700;">Attachments</label>
</div> -->

<br>
<div class="send">
    <h3>Send to</h3>
</div>
<div class="body-div">
    <div>
        <input type="radio" id="user" name="user" style="width: 19px; height: 19px;">
        <label for="user" style="margin-left: 10px;">All users</label>
    </div>

    <div>
        <input type="radio" id="user" name="user" style="width: 19px; height: 19px;">
        <label for="user"  style="margin-left: 10px;">Specific users</label>
    </div>
</div>
<br>
<div class="user">
    <h3>User roles</h3>
</div>

<div class="body-div2">
    <div>
        <input type="checkbox" id="user1" name="user1">
        <label for="user1" style="word-wrap: break-word;">Supervisors</label>
    </div>
    <div>
        <input type="checkbox" id="user2" name="user2">
        <label for="user2" style="word-wrap: break-word;">Voters</label>
    </div>
    <div>
        <input type="checkbox" id="user3" name="user3">
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
        <button class="btn btn-primary gap-4" type="button" class="button" id="cancel" >Cancel</button>
        </a>
        </div>
    
    </form>
    </div>
    
</div>
</div>

<?php require approot . '/View/inc/footer.php'; ?>
<!-- </body>
</html> -->
