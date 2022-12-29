<?php require approot.'/View/inc/header.php'; ?>

    <div class="top_nav_bar">
        <?php
            require_once(approot."/View/topnavbar.php");
        ?>
    </div>

    <h1 class="center txt-clr">
    <?php
        echo $data['title'];
    ?>
    </h1>

<?php require approot.'/View/inc/footer.php'; ?>
