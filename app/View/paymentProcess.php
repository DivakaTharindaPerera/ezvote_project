<?php
// require '../vendor/payment_config.php' ?>

<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot.'/View/inc/AuthNavbar.php'; ?>
<?php require approot.'/View/inc/sidebar-new.php'; 
// var_dump($_GET['plan_id']);
// exit;?>

<div class="main-container">
  <div class="title text-center text-uppercase">Payment Form</div>
  <div class="w-50 h-50 mx-5 border border-primary border-radius-2 border-3 px-1 py-1 mt-1 overflow-y">
    <p class="mb-1 font-semibold text-lg text-center">You can simply pay with visa card and master card for Subscription Plans.</p>
    
    <img src="<?php echo urlroot;?>/public/img/card.png" style="width:400px; height:200px; margin-left:6rem;"/>
    <form  style="margin-top: 1rem; margin-left:15rem; width:35%" action="/ezvote/Payment/submit?plan_id=<?php echo $_GET['plan_id'] ?>" method="post" id="addform">
                    
    <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
        data-key="<?php echo $_SESSION['public_key'] ?>"
        data-amount="<?php echo $_SESSION['donating_amount'] ?>"
        data-name="ezVote"
        data-description="Subscription plan payment using Stripe" 
        data-currency="lkr"
        data-image="/ezvote/public/img/fav-icon.png" 
        data-email="<?php echo $_SESSION['email'] ?>">
    </script>

    <?php 
    include(approot . '/View/paymentSuccess.php');
    include(approot . '/View/paymentError.php');
      if(isset($_GET['success'])){ 
        if($_GET['success'] == 1){ ?>
          <script>
            document.getElementById('id-1').style.display='block';
          </script>
        <?php } elseif($_GET['success'] == 0){ ?>
          <script>
            document.getElementById('id-2').style.display='block';
          </script>
      <?php }
      }

    ?>
    </form>
      <!-- <button class="btn btn-primary mt-2" style="margin-left: 15rem;" type="submit">Submit Payment</button> -->
    
  </div>
</div>
    

