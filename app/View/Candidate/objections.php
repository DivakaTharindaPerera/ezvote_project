<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>
<?php require approot . '/View/inc/side_bar.php'; ?>

<p class="text-3xl font-bold" style="margin-left:200px; margin-top:50px;">Objections against you</p>

<div class="border-2 border-dark border-radius-5 w-45 p-3 bg-light" style="margin-left:200px; ">

<div class="card w-100" style="box-shadow: 5px 5px #888888">
<h3 class="" style="margin-top:20px;">Lack of experience or qualifications</h3>
<p class="">Some voters may object to a candidate's lack of experience, education, or expertise in the area they are running for.</p>
<button class="btn bg-primary text-white text-1xl w-25 " style="margin-left:200px; "  onclick="openPopup()">Respond</button>

</div>

<div class="card w-100" style="box-shadow: 5px 5px #888888">
<h3 class="" style="margin-top:20px;">Personal behavior and reputation</h3>
<p class="">Some voters may object to a candidate's personal behavior or reputation, such as allegations of unethical or criminal behavior.</p>
<button class="btn bg-primary text-white text-1xl w-25" style="margin-left:200px;"  onclick="openPopup()">Respond</button>
</div>

<div class="dialog-box-outer" id="popup">
                                    <div class="popup mx-1 my-1 px-1 py-1 min-w-40 min-h-50" >
                                        <div class="title">My respond</div>
                                        <form action="#" method="POST" class="d-flex flex-column my-1 px-1 align-items-flex-start">
                                           
                                            <div class="d-flex flex-column my-1 w-100">
                                                <label for="Description" class="mr-1 text-left text-md">Description</label>
                                                <textarea id="Description" class="border-1" name="Description" style="height: 150px;width: 100%"></textarea>
                                            </div>
                                            <div class="d-flex justify-content-between my-1 w-100">
                                                <div><button class="btn btn-danger px-1" onclick="closePopup()">Cancel</div>
                                                <div ><button class="btn btn-primary px-1" type="submit">Submit</div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
</div>

<!-- <div class="card w-100">
<h3 class="" style="margin-top:-100px;">Lack of transparency</h3>
<p class="text-left">Some voters may object to a candidate's lack of transparency in their campaign or in their past actions and decisions.</p>
<button class="btn bg-primary text-white text-1xl w-25" style="margin-left:200px;">Respond</button>
</div> -->


<?php require approot.'/View/inc/footer.php';?>