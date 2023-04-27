<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/ManagerNavbar.php'; ?>
<?php require approot . '/View/inc/manager_sidebar.php'; ?>

<script>

window.onload = function(){
    var element = document.getElementById("home");
    element.classList.remove("active");

    var element = document.getElementById("pricing");
    element.classList.add("active");
}
</script>

<div class="main-container">
    <div class="title text-center">Plan Pricing</div>
        <div class="min-w-85 min-h-85">
            <div class="w-100 h-50">
                <div class="card-pane justify-content-center align-items-center d-flex flex-wrap mt-1">
                    <div class="card">
                       <div class="header-title">starter plan</div>
                       <div class="card-body mt-1 d-flex flex-column">
                            price: 20$
                            <div class="btn btn-primary mt-1">Subscribe Now</div>
                       </div>
                    </div>
                    <div class="card">
                       <div class="header-title">Monthly plan</div>
                       <div class="card-body mt-1 d-flex flex-column">
                            price: 50$
                            <div class="btn btn-primary mt-1">Subscribe Now</div>
                       </div>
                    </div>
                    <div class="card">
                       <div class="header-title">Annual plan</div>
                       <div class="card-body mt-1 d-flex flex-column">
                            price: 100$
                            <div class="btn btn-primary mt-1">Subscribe Now</div>
                       </div>
                    </div>
                    <div class="card">
                       <div class="header-title">Premium plan</div>
                       <div class="card-body mt-1 d-flex flex-column">
                            price: 200$
                            <div class="btn btn-primary mt-1">Start Free Trial</div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
</div>

<?php require approot . '/View/inc/footer.php'; ?>