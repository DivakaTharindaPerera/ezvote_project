<?php require approot.'/View/inc/header.php'; ?>
    <?php
        require_once('topnavbar.php');
    ?>
    <div class='form1 center'>
    <form action='<?php echo urlroot; ?>/View/Signing' method='POST' >
    <div class='logoimg'><img src='<?php echo urlroot ?>/img/ezvotelogo.png' alt='ezVote_logo'></div>
    <h1>Login</h1>      
        <input type="email" name="email" id="email" value="<?= htmlspecialchars($_POST["email"] ?? "") ?>" placeholder="Email...." onclick="clickToclear()">
        <br>
        <br>
        <input type="password" name="password" id="password" placeholder="password....">
        <br>
        <em id="error"><?php if(isset($data)){ echo $data['error']; } ?></em>
        <br><br>
        <button type="submit">LOGIN</button>
        <br><br>
        <a href="<?php echo urlroot; ?>/View/Signing"><button>click me</button></a>
    </form>
    </div>
<?php require approot.'/View/inc/footer.php'; ?>