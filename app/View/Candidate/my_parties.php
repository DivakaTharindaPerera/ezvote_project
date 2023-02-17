<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>
<?php require approot . '/View/inc/side_bar.php'; ?>


<div class="d-flex">

    <!-- Ongoing, upcoming and recent elections -->
    <div class="px-5" style="margin-left:200px;">
            <!-- <h2>Ongoing Elections</h2> -->
            <div class="m-1 text-dark w-100 border-1 border-dark border-radius-5 " style="box-shadow: 5px 10px;" >
                <p class="px-1" style="width:500px;">UCSC Union Election (western party) 2023
                <button type="submit" class="btn bg-primary text-white w-5 " style="margin:10px">Visit</button>
                </p>
            </div>

            <!-- <h2>Upcoming Elections</h2> -->
            <div class="m-1 text-dark w-100 border-1 border-dark border-radius-5" style="box-shadow: 5px 10px;">
                <p class="px-1" >Nanocom 2022 (western party) MEMBER
                <button type="submit" class="btn bg-primary text-white " style="margin:10px" onclick="openPopup()">Visit</button>
            </p>
            </div>

            <!-- <h2>Recent Elections</h2> -->
            <div class="m-1 text-dark w-100 border-1 border-dark border-radius-5" style="box-shadow: 5px 10px;">
                <p class="px-1">Yuhan corp mid year board (HR managers) MEMBER
                    <button type="submit" class="btn bg-primary text-white" style="margin:10px">Visit</button></p>
            </div>
        </div>


        
    </div>
    <?php require approot.'/View/inc/footer.php';?>