<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot.'/View/inc/AuthNavbar.php'; ?>
<?php require approot.'/View/inc/sidebar-new.php'; ?>

<div class="main-container">
    <div class="min-w-85 min-h-85">
        <div class="w-100 h-50 overflow-y">
            <div class="title text-center text-uppercase">Payment Details</div>
            <form method="post" action="../Controller/Payment">
            <div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Charge <?php echo '$'.$planPrice; ?> with Stripe</h3>
        
        <!-- Product Info -->
        <p><b>plan Name:</b> <?php echo $planName; ?></p>
        <p><b>Price:</b> <?php echo '$'.$planPrice.' '.$currency; ?></p>
    </div>
    <div class="panel-body">
        <!-- Display status message -->
        <div id="paymentResponse" class="hidden"></div>
        
        <!-- Display a payment form -->
        <form id="paymentFrm" class="hidden">
            <div class="form-group">
                <label>NAME</label>
                <input type="text" id="name" class="field" placeholder="Enter name" required="" autofocus="">
            </div>
            <div class="form-group">
                <label>EMAIL</label>
                <input type="email" id="email" class="field" placeholder="Enter email" required="">
            </div>
            
            <div id="paymentElement">
                <!--Stripe.js injects the Payment Element-->
            </div>
            
            <!-- Form submit button -->
            <button id="submitBtn" class="btn btn-success">
                <div class="spinner hidden" id="spinner"></div>
                <span id="buttonText">Pay Now</span>
            </button>
        </form>
        
        <!-- Display processing notification -->
        <div id="frmProcess" class="hidden">
            <span class="ring"></span> Processing...
        </div>
        
        <!-- Display re-initiate button -->
        <div id="payReinit" class="hidden">
            <button class="btn btn-primary" onClick="window.location.href=window.location.href.split('?')[0]"><i class="rload"></i>Re-initiate Payment</button>
        </div>
    </div>
</div>
            </form>
        </div>
    </div>
</div>

<script src="js/checkout.js" STRIPE_PUBLISHABLE_KEY="<?php echo STRIPE_PUBLISHABLE_KEY;?>" defer></script>