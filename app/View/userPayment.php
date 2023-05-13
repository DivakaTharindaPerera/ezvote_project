<?php require '../vendor/payment_config.php' ?>

<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot.'/View/inc/AuthNavbar.php'; ?>
<?php require approot.'/View/inc/sidebar-new.php'; ?>

<div class="main-container">
  <div class="title text-center text-uppercase">Payment Details Form</div>
  <div class="w-50 h-50 mx-5 border border-primary border-radius-2 border-3 px-1 py-1 mt-1 overflow-y">
    <p class="mb-1 font-semibold text-lg text-center">Payment Submit form for Subscription Plans.</p>
    <form action="/ezvote/Payment?plan_id=<?php echo $_GET['plan_id']?>" method="POST">
      <label class="font-semibold mt-2" for="amount">Amount (Rs):</label>
      <div class="border border-primary" style="margin-top: 0.5rem; width:35%">
        <input style="padding-left: 0.5rem;" type="number" min="0" id="amount" name="amount" value="<?php echo $data[0]-> Price ?>">
      </div>
      
      <button class="btn btn-primary mt-2" style="margin-left: 15rem;" type="submit">Submit Payment</button>
    </form>
  </div>
</div>
   