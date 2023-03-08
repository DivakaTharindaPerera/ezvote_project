<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>
<?php require approot . '/View/inc/sidebar-new.php'; ?>
<div class="main-container">
    <div id="objectionArea" class="d-flex flex-wrap w-100 bg-white overflow-scroll justify-content-center">
        <?php 
            foreach($data['objectionRow'] as $objectionRow){
        ?>
            <div class="card">
                <h4><?php echo $objectionRow->Subject; ?></h4>
                <p><?php echo $objectionRow->Description; ?></p>
            </div>
        <?php 
            }
        ?>
    </div>        
</div>
<?php require approot . '/View/inc/footer.php'; ?>
