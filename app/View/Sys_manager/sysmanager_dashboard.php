<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/ManagerNavbar.php'; ?>
<?php require approot . '/View/inc/manager_sidebar.php'; ?>

<!-- <!DOCTYPE html>
<html lang="en"> -->

<!-- <body> -->

<div class="main-container">
    <div class="title">Activities</div>
    <div class="w-80">
        <table class="table border border-radius-2 border-primary w-95 mt-1">
            <tbody>
                <?php
                $arrlength = count($data, COUNT_RECURSIVE);

                for($x = 0; $x < $arrlength-1; $x++) {
                    echo '<tr>
                        <td class="td-1">'.$data[0][$x]-> Description.'</td>
                        <td class="td-2">'.$data[0][$x]-> Date .'</td>
                        <td class="td-3"><a href="/ezvote/subscription_plan/edit_subscription/'.$data[0][$x]->PlanID.'">
                            <button class="btn btn-info">Details</button>
                        </td></a>
                    </tr>';
                }
                // foreach($data as $row){
                //     print_r($row);
                //     echo '<tr>
                //     <td class="td-1">'.$row['Description'].'</td>
                //     <td class="td-2">'.$row['Date'].'</td>
                //     <td class="td-3">
                //         <button>Details</button>
                //     </td>
                // </tr>';
                // } ?>
                </tbody>
                </table>
            </div>
    </div>
    <!-- <div class="navbar2"></div> -->

    <!-- <a href="#">
        <button type="button" class="summary-btn">
            Summary of usage</button>
    </a>
    <a href="./../subscription_plan/index">
        <button type="button" class="subscription-btn">
            Subscription plans</button>
    </a>
    <a href="./../subscription_plan/sales_subscription">
        <button class="button" type="button" class="sale-btn">
            Subscription Sales</button>
    </a>
    <a href="./../System_manager/announcements">
        <button class="button" type="button" class="announcement-btn">
            Announcements</button>
    </a> -->
    </p>
</div>
<!-- </body>

</html> -->
<?php require approot . '/View/inc/footer.php'; ?>