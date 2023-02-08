<?php require approot.'/View/inc/header.php'; ?>
<?php
require approot.'/View/sysmanager_topnavbar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width , initial-scale=1.0">
    <title>sysmanager_announcemets</title>
    <link rel="stylesheet" href="<?php echo urlroot; ?>/public/css/sysmanager_announcements.css">
</head>

<body>

<div class="sysmanager">
    <h2>Announcements</h2>
</div><br>

<div class="head">
    <h3>Head</h3>
    <input type="text" id="bodytext" placeholder="HOT offer! grab quick">
</div>
<div class="body">
    <h3>Body</h3>
    <input type="text" id="bodytext" placeholder="20% off on Annual subscription plan">
</div>

<div class="attachment">
    <img id="add" src="<?php echo urlroot; ?>/public/img/add.png" style="top: 500px; position: absolute; left:700px;"  />
    <label>Attachments</label>
    <img id="pin" src="<?php echo urlroot; ?>/public/img/pin.png " style="top: 490px; position: absolute; left: 878px; height: 40px;" />
</div>

<div class="send">
    <h3>Send to</h3>
</div>
<div class="body-div">
    <div>
        <input type="radio" id="allusers" name="alluser" style="position: absolute; width: 19px; height: 19px; left: 30px;">
        <label for="allusers" style="margin-left: 65px;">All users</label>
    </div><br>

    <div>
        <input type="radio" id="specificusers" name="specificuser" style="position: absolute; width: 19px; height: 19px; left: 30px;">
        <label for="specificusers"  style="margin-left: 65px;">Specific users</label>
    </div>
</div>

<div class="user">
    <h3>User roles</h3>
</div>

<div class="body-div2">
    <div>
        <input type="checkbox" id="user1" name="user1">
        <label for="user1" style="word-wrap: break-word; position: absolute; top: 46px; left: 100px;">Supervisors</label>
    </div>
    <div>
        <input type="checkbox" id="user2" name="user2">
        <label for="user2" style="word-wrap: break-word; position: absolute; top: 46px; left: 252px;">Voters</label>
    </div>
    <div>
        <input type="checkbox" id="user3" name="user3">
        <label for="user3" style="word-wrap: break-word; position: absolute; top: 46px; left: 372px;">Candidates</label>
    </div>
</div>

<div class="subscription">
    <label>Subscriptions</label>
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

    <form action="" method="POST">
    <a href="/ezvote/System_manager/announcements">
        <div>
            <button type="button" class="send" id="send">SEND</button>
    </a>

    <a href="/ezvote/System_manager/dashboard">
        <button type="button" class="cancel" id="cancel" >Cancel</button>
    </a>
    </form>
</div>
</body>
</html
