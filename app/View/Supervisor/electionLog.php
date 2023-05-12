<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>
<?php require approot . '/View/inc/sidebar-new.php'; ?>

<div class="main-container">
<!--    <div>-->
<!--        -->
<!--    </div>-->
    <div class="title">
        Election logs
    </div>
    <div class="mt-1 text-center">
        <div class="sub-title">
            <?php 
                echo $data['electionRow']->OrganizationName;
            ?>
        </div>
        <div class="sub-title">
            By
            <?php
            echo $data['electionRow']->Title;
            ?>
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