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
    <title>subscription sales</title>
    <link rel="stylesheet" href="<?php echo urlroot; ?>/public/css/subscription_sales.css">
</head>

<body>
<a href="/ezvote/System_manager/dashboard">
    <div class="back-to">
        <img src="<?php echo urlroot; ?>/public/img/button.png" />
    </div>
</a>
<br>

<div class="select">
    <input type="text" placeholder="Search plan......">
    <p>Sort by</p>
    <button>Search</button>
    <img src="<?php echo urlroot; ?>/public/img/sort.png" />
</div>

<form action="#">
    <select name="price" id="prices">
        <option selected hidden class="input">Price</option>
        <option value="free">Free</option>
        <option value="ten">10$</option>
        <option value="hundred">100$</option>
        <option value="thousand">1000$</option>
    </select>
    <br><br>
</form>

<div selected hidden class="dropdown">
    <label>Annual Plan [$99.99]</label>
    <div class="dropdown-content">
        <label>
            Purchased :  78 users(78%)
            <br>
            Income from the plan :  7792.2$
        </label>
        <div class="promote">
            <button >Promote Site</button>
        </div>
        <div class="email-verify">
            <button>Email Promote</button>
        </div>
        <div class="box">
            <label>
                Discount : 20%
                <br>
                Duration :
                20/10/2022  -  01/01/2023
            </label>
            <button>EDIT</button>
        </div>
    </div>
</div>



</body>

</html>
