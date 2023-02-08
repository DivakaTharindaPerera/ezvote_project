<?php require approot.'/View/inc/header.php'; ?>
<?php
require approot.'/View/sysmanager_topnavbar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sysmanager login</title>
    <link rel="stylesheet" href="<?php echo urlroot; ?>/public/css/sysmanager_login.css">
</head>

<body>
<!-- <div class="navbar">
    <img src="../IMAGES/ezvotelogo.png" />
    <a href="#">
        <div class="about link">ABOUT</div>
    </a>
    <a href="sysmanager_register.php">
        <button type="button" class="register-btn">REGISTER</button>
    </a>
</div> -->

<div class="container">
    <div class="enter">
        <h2>System manager login here</h2>
        <h3>Enter email and password to login</h3>
    </div>

    <form action="./dashboard" method="POST">
        <input type="email" class="email-box" placeholder="Email" name="email" required>
        <input type="password" class="password-box" placeholder="Password" name="pwd" required>
        <button type="submit" class="login-btn">LOGIN</button>
    </form>

    <div class="forgot">
            <h3>Forgotten password</h3>
        </a>
    </div>
</div>
</body>

</html>
