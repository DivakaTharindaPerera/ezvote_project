<?php
//echo '<pre>';
//print_r($data['positions']);
//exit();
require approot . '/View/inc/VoterHeader.php'; ?>

    <div class="text-6xl text-danger">
        <b>FORBIDDEN ACCESS!</b>
    </div>
    <div class="text-xl">
        Returning back in.. <span id="countdown">5</span>s
    </div>

<script>
    setInterval(()=>{
        let countdown = document.getElementById('countdown');
        let count = parseInt(countdown.innerText);
        if(count == 0){
            history.back();
        }
        countdown.innerText = count - 1;
    },1000);
</script>
<?php require approot . '/View/inc/footer.php'; ?>