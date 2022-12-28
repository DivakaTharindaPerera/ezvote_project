<?php require approot.'/View/inc/header.php'; ?>


    <div class="top_nav_bar">
        <?php 
            include_once("topnavbar.php"); 
        ?>
    </div>
    <div class="pagecontent">
    <div class="form">
    <?php
    //if the code is wrong
        echo "<p> Verification code has been sent to the email ".$data['email']." </p>";
    ?>
    
    <form action="<?php echo urlroot ?>/users/verifyEmail" method="POST" >
        <h2> <?php echo "verification code:". $data['vCode']; ?> </h2>
        <input type="hidden" name="email" value="<?php echo $data['email']; ?>" required>
        <input type="hidden" name="code" value="<?php echo $data['vCode']; ?>" required>
        <br>
        <?php
            if (isset($data['verifyError'])) {
                echo "<em style='color:red;'> ".$data['verifyError']." </em>";
            }
        ?>
        <br>
        <input type="text" name="verification_code" class="insert" placeholder="Enter your verification code..." required>
        <br><input type="submit" name="verify" class="verify" value="Verify Email">
    </form>
        <!-- testing branch -->
<?php require approot.'/View/inc/footer.php'; ?>
