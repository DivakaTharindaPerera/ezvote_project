<?php require approot.'/View/inc/VoterHeader.php'; ?>
<?php require approot.'/View/inc/AuthNavbar.php'; ?>
<!--</head>-->
<!--<body>-->

<!--    <div class="top_nav_bar">-->
<!--        --><?php //
//            include_once("topnavbar.php");
//        ?>
<!--    </div>-->
    <div class="pagecontent d-flex flex-column border-primary border-3 bg-secondary">
    <div class="form">
    <?php
    //if the code is wrong
        echo "<div class='d-flex justify-content-center text-xl'> Verification code has been sent to the email ".$data['email']." </div>";
    ?>
        <div class="d-flex justify-content-center">
            <form action="<?php echo urlroot ?>/users/verifyEmail" method="POST" >
                <input type="hidden" name="email" value="<?php echo $data['email']; ?>" required>
                <input type="hidden" name="code" value="<?php echo $data['vCode']; ?>" required>
                <br>
                <?php
                if (isset($data['verifyError'])) {
                    echo "<em style='color:red;'> ".$data['verifyError']." </em>";
                }
                ?>
                <br>
                <div class="border-primary border-3">
                    <input type="text" name="verification_code" class="insert" placeholder="Enter your verification code..." required>
                </div>
                <div class="my-1 d-flex">
                    <input type="submit" name="verify" class="verify" value="Verify Email">
                </div>
            </form>
        </div>

        
<?php require approot.'/View/inc/footer.php'; ?>
