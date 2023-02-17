<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>
<?php require approot . '/View/inc/side_bar.php'; ?>

<div class="d-flex">

    <!-- Ongoing, upcoming and recent elections -->
    <div class="px-5" style="margin-left:200px;">
            <h2>Ongoing Elections</h2>
            <div class="m-1 text-dark w-100 border-1 border-dark border-radius-5 " style="box-shadow: 5px 5px;" >
                <p class="px-1" style="width:500px;">Welfare board election 2022 
                <button type="submit" class="btn bg-primary text-white" style="margin-bottom:10px; margin-left:500px;">Vote</button>
                </p>
            </div>

            <h2>Upcoming Elections</h2>
            <div class="m-1 text-dark w-100 border-1 border-dark border-radius-5" style="box-shadow: 5px 5px;">
                <p class="px-1" >UCSC Union election 2022
                <button type="submit" class="btn bg-primary text-white " style="margin:10px;  margin-left:300px;" onclick="openPopup()">Details</button>
                </p>
                <div class="dialog-box-outer" id="popup">
                                    <div class="popup mx-1 my-1 px-1 py-1 min-w-40 min-h-50" >
                                        <div class="title">UCSC Union Election 2023</div>
                                        <!-- <form action="/ezvote/Voters/submitObjections" method="POST" class="d-flex flex-column my-1 px-1 align-items-flex-start"> -->
                                           
                                            <div class="d-flex flex-column my-1 w-100">
                                                <label for="Description" class="mr-1 text-center text-md font-bold">Meeting Details</label>
                                                <textarea id="Description" class="border-1" name="Description" style="height: 260px;width: 100%; resize:none;">As the time for Happy Home Insurance’s annual general meeting approaches, we’d like to thank you for your ongoing support. We hope you will attend this year’s meeting, which we have scheduled for September 25, 2023, at 11 a.m. on Zoom. You’ll find the link on particular day. 

We’ve attached a meeting agenda to this email so you know what to expect. The meeting will cover the following key topics:

Elections to fill this year’s board openings
* Votes on shareholder proposals
* Annual financial reports
* New developments
We expect the meeting will last about 2.5 hours. 
                                            </textarea>
                                            </div>
                                            <div class="d-flex justify-content-between my-1 w-100">
                                                <div><button class="btn btn-danger px-1" onclick="closePopup()" style="margin-left:500px;">Cancel</div>
                                                <!-- <div ><button class="btn btn-primary px-1" type="submit">Submit</div> -->
                                            </div>
                                        <!-- </form> -->
                                    </div>
                                </div>
            </div>
            <div class="m-1 text-dark w-100 border-1 border-dark border-radius-5" style="box-shadow: 5px 5px;">
                <p class="px-1">Monthly stock preferences 2022
                <button type="submit" class="btn bg-primary text-white" style="margin:10px; margin-left:265px;" onclick="openPopup()">Details</button>
                </p>
            </div>

            <h2>Recent Elections</h2>
            <div class="m-1 text-dark w-100 border-1 border-dark border-radius-5" style="box-shadow: 5px 5px;">
                <p class="px-1">UCSC Union election 2021
                    <button type="submit" class="btn bg-primary text-white" style="margin:10px; margin-left:300px;">Results</button></p>
            </div>
            <div class="m-1 text-dark w-100 border-1 border-dark border-radius-5" style="box-shadow: 5px 5px;">
                <p class="px-1">Welfare board election 2021
                <button type="submit" class="btn bg-primary text-white" style="margin:10px; margin-left:295px;">Results</button>
                </p>
            </div>
            <div class="m-1 text-dark w-100 border-1 border-dark border-radius-5" style="box-shadow: 5px 5px;">
                <p class="px-1">Welfare board election 2021
                <button type="submit" class="btn bg-primary text-white" style="margin:10px; margin-left:295px;">Results</button>
                </p>
            </div>
        </div>
    </div>
    <?php require approot.'/View/inc/footer.php';?>