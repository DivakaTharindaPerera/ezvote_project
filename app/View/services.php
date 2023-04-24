<?php require approot . '/View/inc/VoterHeader.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?php echo urlroot; ?>/css/home.css">

    <title>ezVote</title>
</head>
<body>
<div class="nav-bar">
    <div class="logo"><img id="logo" src="<?php echo urlroot; ?>/img/welcome/ezvotelogo.png" alt="logo"></div>
    <div class="links">
        <a href="/ezvote/Pages/home">Home</a>
        <a href="/ezvote/Pages/services">Services</a>
        <a href="/ezvote/Pages/pricing">Pricing</a>
        <a href="/ezvote/Pages/targetUsers">Target users</a>
        <a href="/ezvote/Pages/aboutUs">About Us</a>
        <a href="/ezvote/Pages/contactUs">Contact</a>
    </div>
    <div class="nav-end">
        <!-- <a href="<?php echo urlroot; ?>/View/Login"><button type="button">Login</button></a>
            <a href="<?php echo urlroot; ?>/View/Register"><button id="trial">Register</button></a> -->

        <div class="dropdown">
            <button class="dropbtn">Login</button>
            <div class="dropdown-content">
                <a href="#">Administrator</a>
                <a href="<?php echo urlroot; ?>/View/Login">Other Users</a>
            </div>
        </div>
        <a href="<?php echo urlroot; ?>/View/Register"><button class="dropbtn" style="margin-top: -6px;">Register</button></a>

    </div>
</div>
<div class="d-flex flex-column overflow-y">
<div class="bg_services min-w-100">
    <div class="">
        <h1 class="text-center text-white" style="padding-top:10rem; font-size:120px;">SERVICES</h1>
    </div>
</div>
<div class="flex-container">
    <br>
    <h1 class="be_confident">Services wished to provide you</h1>
    <br>
    <div class="accessibility">
        <!-- <h2>Web app-based voting platform</h2> -->
        <br>
        <div class="column1">
            <h2>Web app-based voting platform</h2>
            <br>
            <p class="features">Send eligible voters to a personalized voting website,
                no online voting app download required.</p>
            <img src="<?php echo urlroot; ?>/img/welcome/browser.webp" alt="accessibility" class="feat">

        </div>

        <div class="column1">
            <h2>A pleasant way to cast votes</h2>
            <br>
            <p class="features">Your voters deserve a fair and easy to use voting website,
                accessible from any device.</p>
            <img src="<?php echo urlroot; ?>/img/welcome/vote.jpg" alt="accessibility" class="feat">

        </div>

    </div>

    <!-- ****************************************************************** -->
    <div class="accessibility">
        <!-- <h2>Web app-based voting platform</h2> -->
        <br>
        <div class="column1">
            <h2>Conference Platform</h2>
            <br>
            <p class="features">Supervisors is able to schedule online meeting with candidates of each election</p>
            <img src="<?php echo urlroot; ?>/img/welcome/conference.jpeg" alt="accessibility" class="feat">

        </div>

        <div class="column1">
            <h2>Generating reports as summary of election</h2>
            <br>
            <p class="features">Supervisors,candidates and voters can take completed election's summary as pdf.</p>
            <img src="<?php echo urlroot; ?>/img/welcome/report.png" alt="accessibility" class="feat">

        </div>

    </div>
    <div class="accessibility">
        <!-- <h2>Web app-based voting platform</h2> -->
        <br>
        <div class="column1">
            <h2>Key electronic voting features</h2>
            <br>
            <p class="features">Never again worry about vote
                manipulation.Get results instantly. Dive deeper into vote statistics.</p>
            <img src="<?php echo urlroot; ?>/img/welcome/key.jpg" alt="accessibility" class="feat">

        </div>

        <div class="column1">
            <h2>A reliable online voting tool for your group</h2>
            <br>
            <p class="features">Run online elections among your group for important event.
                Or manage recurring votes.</p>
            <img src="<?php echo urlroot; ?>/img/welcome/reliability.webp" alt="accessibility" class="feat">

        </div>
    </div>

</body>