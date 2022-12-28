<?php require approot.'/View/inc/header.php'; ?>

<h1 class="center txt-clr">
    <?php
    echo $data['title'];
    ?>
</h1>
<a href="<?php echo urlroot; ?>/View/Register"><button>REGISTER</button></a>
<a href="<?php echo urlroot; ?>/View/Login"><button>LOGIN</button></a>

<?php require approot.'/View/inc/footer.php'; ?>
