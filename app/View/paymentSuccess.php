<?php require approot . '/View/inc/VoterHeader.php'; ?>


<div class="dialog-box-outer" id="popup">
    <div class="popup w-30 h-70 mx-1 my-1 px-1 py-1 min-w-20 min-h-25">
        <div class="my-2 text font-bold text-3xl text-center text-uppercase" id="plan2"></div>
        <div class="my-2 text text-center text-6xl font-bold" id="price"></div>
            <div class="my-2 text-center leading-normal text-xl" id="id-1">
                
                    <div class="text center font-bold">Payment Successful!</div>
                 
                <div class="d-flex flex-row mx-5 my-2">
                    <div class="justify-content-center align-items-center">
                        <a href="/ezvote/Pages/dashboard">
                            <button type="button" class="btn btn-primary mx-5" onclick="document.getElementById('id-1').style.display='none'">CANCEL</button>
                        </a>
                    </div>
                </div>
            </div>
    </div>
</div>