<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>
<?php require approot . '/View/inc/sidebar-new.php'; ?>

<div class="main-container">
    <div class="mt-2 text-center">
        <div class="title">
            <?php 
                echo $data['electionRow']->Title;
            ?>
        </div>
        <div class="title">
            By
        </div>
        <div class="title">
            <?php 
                echo $data['electionRow']->OrganizationName;
            ?>
        </div>
        <div class="sub-title">
            Election logs
        </div>
    </div>
    <div class="w-90 mt-2">
        <table>
            <tr>
                <th>Date</th>
                <th>Time</th>
                <th>Action</th>
            </tr>

            <?php
            foreach ($data['logs'] as $log) {
            ?>
                <tr>
                    <td><?php echo $log->Date; ?></td>
                    <td><?php echo $log->Time; ?></td>
                    <td><?php echo $log->description; ?></td>
                </tr>
            <?php
            }
            ?>

        </table>
    </div>
</div>

<?php require approot . '/View/inc/footer.php'; ?>