<?php require approot.'/View/inc/VoterHeader.php'; ?>
<?php //require approot.'/View/inc/AuthNavbar.php'; ?>
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
        echo "<div class='d-flex justify-content-center text-center text-xl mx-1'> Verification code has been sent to the email <br> <em style='color: red'>" .$data['email']." </em> </div>";
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
                <div class="my-1 d-flex justify-content-center">
                    <input type="submit" name="verify" class="verify btn btn-primary" value="Verify Email">
                </div>
            </form>
        </div>

        
<?php require approot.'/View/inc/footer.php'; ?>
