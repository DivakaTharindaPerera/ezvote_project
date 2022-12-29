<?php require approot.'/View/inc/header.php'; ?>

    <div class="top_nav_bar">
    <?php
        include_once("topnavbar.php");
    ?>
    </div>
    <div class="content">
    <div class="content_area">
    <?php
        if(!isset($_SESSION["UserId"])){
            header("Location: ".urlroot."/View/Login");
            exit;
        }  
        echo "<h3> Welcome ".htmlspecialchars($_SESSION["fname"])." ".htmlspecialchars($_SESSION["lname"])."</h3>";
    ?>
    
    </div>

    <div class="right_nav_bar">
    <br><a href="<?php echo urlroot; ?>/View/Createelection" class='a_nav_btn'><div class="nav_btn">Create new election</div></a><br>
    <br><a href="viewElections.php" class='a_nav_btn'><div class="nav_btn">View elections</div></a><br>
    <br><a href='../../../Control/sup_logout.php' class='a_nav_btn'><div class="nav_btn">Logout</div></a>
    
    </div>
    </div>
    <!-- <footer class="bottom_nav_bar">
        <?php 
            // include_once("bottomnavbar.php");
        ?>
    </footer> -->
    <!-- end -->
<?php require approot.'/View/inc/footer.php'; ?>