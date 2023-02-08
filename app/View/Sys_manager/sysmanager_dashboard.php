<?php require approot.'/View/inc/header.php'; ?>
<?php
require approot.'/View/sysmanager_topnavbar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width , initial-scale=1.0">
    <title>sysmanager dashboard</title>
    <link rel="stylesheet" href="<?php echo urlroot; ?>/public/css/sysmanager_dashboard.css">

</head>

<body>

<div class="plans">
    <label>Activities</label><br>
    <p>
    <div class="plan-box1">
        <table>
            <div class="table-dash">
                <tbody>
                <?php
                $arrlength = count($data, COUNT_RECURSIVE);

                for($x = 0; $x < $arrlength-1; $x++) {
                    echo '<tr>
                        <td class="td-1">'.$data[0][$x]-> Description.'</td>
                        <td class="td-2">'.$data[0][$x]-> Date .'</td>
                        <td class="td-3">
                            <button>Details</button>
                        </td>
                    </tr>';
                    echo "<br>";
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
            </div>
        </table>
    </div>
    <div class="navbar2"></div>

    <a href="#">
        <button type="button" class="summary-btn">
            Summary of usage</button>
    </a>
    <a href="./../subscription_plan/index">
        <button type="button" class="subscription-btn">
            Subscription plans</button>
    </a>
    <a href="./../subscription_plan/sales_subscription">
        <button type="button" class="sale-btn">
            Subscription Sales</button>
    </a>
    <a href="./../System_manager/announcements">
        <button type="button" class="announcement-btn">
            Announcements</button>
    </a>
    </p>
</div>
</body>

</html>
