<style>
    *{
        margin: 0;
        padding: 0;
    }

    .container{
        width: 100vw;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background-image: linear-gradient(to right, #0f0c29, #302b63, #24243e);
    }

    .nav-bar{
        width: 100%;
        background: white;
        top: 0;
        position: absolute;
        min-height: 8vh;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top-color: white;
    }

    .navbar img{
        width: 15%;
        position:static;
    }

    #caption{
        font-size: 20px;
        font-family:cursive;
        color: #121fa7;
        text-align:start;
    }

    .links{
        display: flex;
        gap: 2rem;
        font-size: 1.5rem;
        text-decoration: solid;
        width: 65vw;
        margin-left: 5rem;
    }

    a{
        color: black;
        text-decoration: none;
    }

    .content{
        display: flex;
        justify-content: space-around;
        flex-direction: row;
        background-color: rgba(255,255,255,0.7);
        height: 60%;
        width: 50%;
        border-radius: 30px;
    }
</style>
<div class="nav-bar">
    <img src="<?php echo urlroot;?>img/ezvotelogo.png" width="150px"/>
    <h3 id="caption">Simple & Secure voting platform</h3>
    <a href="../html/voter_signup.php" class="login-button"> Sign Up</a>
</div>
