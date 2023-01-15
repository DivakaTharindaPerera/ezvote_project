<?php require approot.'/View/inc/header.php'; ?>
</head>
<body>

<div class="top_nav_bar">
        <?php
            require_once("topnavbar.php");
        ?>
</div>
<h1 class="center txt-clr">
    <?php
    echo "Welcome ".$_SESSION["email"];
    ?>
</h1>


<?php require approot.'/View/inc/footer.php'; ?>
