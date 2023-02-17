<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>
<?php require approot . '/View/inc/side_bar.php'; ?>


<div class="overflow-y" style="padding-left:200px;">

<h3 class="text-center">Ongoing meetings</h3>
<div class="d-flex">
<div class="bg-light p-2 border-2 border-radius-3 m-1 hover-effect" style="box-shadow: 5px 5px #888888">
<h3>Feb <br>10</h3>
</div>
<div class="w-100 bg-light p-2 border-2 border-radius-3 m-1 hover-effect-org text-1xl" style="box-shadow: 5px 5px #888888">
Welfare Bord Election 2023 - meeting - (2hrs 30mins left)
<button type="submit" class="btn bg-primary text-white" style="margin:10px">JOIN</button>
</div>
</div>

<br><br>
<h3 class="text-center">Upcoming meetings</h3>
<div class="d-flex">
<div class="bg-light p-2 border-2 border-radius-3 m-1 hover-effect" style="box-shadow: 5px 5px #888888" >
<h3>Sep <br>25</h3>
</div>
<div class="w-100 bg-light p-2 border-2 border-radius-3 m-1 hover-effect-org" style="box-shadow: 5px 5px #888888">
UCSC Union Election 2023 - meeting
<br>
<button type="submit" class="btn bg-primary text-white" style="margin:10px" onclick="openPopup()">DETAILS</button>

</div>

<div class="w-100 bg-light p-2 border-2 border-radius-3 m-1 hover-effect-org" style="box-shadow: 5px 5px #888888">
Welfare Community Election - meeting
<button type="submit" class="btn bg-primary text-white" style="margin:10px" onclick="openPopup()">DETAILS</button>
</div>
</div>

<div class="d-flex">
<div class="bg-light p-2 border-2 border-radius-3 m-1 hover-effect" style="box-shadow: 5px 5px #888888">
<h3>Nov<br>05</h3>
</div>
<div class="w-100 bg-light p-2 border-2 border-radius-3 m-1 hover-effect-org" style="box-shadow: 5px 5px #888888">
Humane Society Election - meeting
<br>
<button type="submit" class="btn bg-primary text-white" style="margin:10px" onclick="openPopup()">DETAILS</button>
</div>
<div class="w-100 bg-light p-2 border-2 border-radius-3 m-1 hover-effect-org" style="box-shadow: 5px 5px #888888">
Child Care Services Election - meeting
<br>
<button type="submit" class="btn bg-primary text-white" style="margin:10px" onclick="openPopup()">DETAILS</button>
</div>
</div>

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
                                                <div><button class="btn btn-primary px-1" onclick="closePopup()" style="margin-left:500px;">Cancel</div>
                                                <!-- <div ><button class="btn btn-primary px-1" type="submit">Submit</div> -->
                                            </div>
                                        <!-- </form> -->
                                    </div>
                                </div>

</div>

<?php require approot.'/View/inc/footer.php';?>