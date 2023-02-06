<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo urlroot?>/css/utils.css">
    <title>ezVote</title>
</head>
<body>
    <div>
        <?php include_once approot.'/View/inc/AuthNavbar.php'; 
            $data = [
                    'names' => ['basic', 'premium', 'enterprise','basic', 'premium', 'enterprise','basic', 'premium', 'enterprise'],
                    'prices' => [100, 200, 300,100, 200, 300,100, 200, 300],
                    'desc' => ['This is the basic plan', 'This is the premium plan', 'This is the enterprise plan','This is the basic plan', 'This is the premium plan', 'This is the enterprise plan','This is the basic plan', 'This is the premium plan', 'This is the enterprise plan']
            
            ];
        ?>
    </div>
        
            
    <div>    
        <div class="text-center">
        <?php include_once approot.'/View/inc/Sidebar.php'; ?>
            <div class="m-2">
                <?php 
                    if(isset($_SESSION['plan'])) {
                        echo '<h3 class="text-center">You are currently subscribed to '.$_SESSION['plan'].' plan</h3>';
                    } else {
                        echo '<h3 class="text-center text-danger">You are currently not subscribed to any plan</h3>';
                    }
                ?>
                <h3 class="text-center">Choose a plan from below that suits you</h3>
            </div>
            <div id="plans" class="subsplans flex-wrap d-flex mb-2">
                <?php 
                    foreach($data['names'] as $key => $name) {
                        echo '<div class="plan m-2 bg-green-5 text-center border-radius-2">
                                <div class="planname m-2">
                                    <h3>'.$name.'</h3>
                                </div>
                                <div class="planprice m-2">
                                    <h3>$'.$data['prices'][$key].'</h3>
                                </div>
                                <div class="plandesc m-2">
                                    <p>'.$data['desc'][$key].'</p>
                                </div>
                                <div class="planbtn text-center m-2">
                                    <a href="#" class="btn btn-primary">Subscribe</a>
                                </div>
                            </div>';
                    }
                ?>
            </div>
            <div class="cancel text-center">
                <a href="#" class="btn btn-danger">Cancel</a>
            </div>
        </div>
    </div>
</body>
</html>