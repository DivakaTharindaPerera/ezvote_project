<?php
require approot.'/View/inc/VoterHeader.php';
require approot.'/View/inc/AuthNavbar.php';
require approot.'/View/inc/sidebar-new.php';
?>

<div class="main-container">
    <div id="Election" class="w-95 align-center d-flex flex-column p-1 " style="min-height: 92%">
        <div class="d-flex flex-column w-75 justify-content-start align-items-center">
            <div class="title">Welfare Organizing Committee Election - 2022 / 2023 </div>
            <div id="desc-reg" class="w-50 d-flex flex-column px-1 align-items-center bg-white border-radius-2">
                <div class="sub-title">
                    Description & Regulation
                </div>
                <div id="regulations" class="mt-1">
                    <ol>
                        <li>Lorem ipsum dolor sit amet.</li>
                        <li>Lorem ipsum dolor sit amet.</li>
                        <li>Lorem ipsum dolor sit amet.</li>
                        <li>Lorem ipsum dolor sit amet.</li>
                    </ol>
                </div>
                <div class="d-flex mt-1">
                    <div><input type="checkbox" onchange="accepted()" id="rules"></div>
                    <div class="mx-1">
                        I agree for above rules and regulations.
                    </div>
                </div>
            </div>
        </div>
<!--        <hr class="w-100 mt-1">-->
        <div id="content" class="flex-column w-80 ">
            <div id="scheduled" class="mt-1 d-flex justify-content-evenly">
                <div id="from" class="card">
                    <div class="justify-content-center sub-title mb-1">Commencing</div>
                    <div class="mb-1">
                        Date:2023/03/03
                    </div>
                    <div class="justify-content-start mb-1">
                        &emsp14;Time: 10 A.M.
                    </div>
                    <!--                From : <span>01/02/2023   18.30 </span>-->
                </div>
                <div class="d-flex justify-content-center align-items-center"> <img src="<?php echo urlroot;?>/public/img/right-arrow.png" alt="" style="max-height: 100px; max-width: 100px"></div>
                <div id="to" class="card">
                    <div class="justify-content-center sub-title mb-1">Ending</div>
                    <div class=" mb-1">
                        Date:2023/03/03
                    </div>
                    <div class="justify-content-start mb-1">
                        &emsp14;Time: 12 P.M.
                    </div>
                    <!--                To : <span>01/02/2023   20.30 </span>-->
                </div>
            </div>
            <div id="data" class="d-flex flex-column justify-content-center align-items-center mt-1 border-primary border-2 border-radius-1 mx-5">
                <div id="self-nomination" class="d-flex text-lg text-center">
                    <div class="text-center">Self Nomination :</div>
                    <div class=""><img src="<?php echo urlroot;?>/public/img/on.png" alt="" style="max-width: 40px;max-height: 40px"></div>
                </div>
                <div id="self-nomination" class="d-flex text-lg ">
                    <div class="text-center">Multiple Cast of Votes : </div>
                    <div class=""><img src="<?php echo urlroot;?>/public/img/off.png" alt="" style="max-width: 40px;max-height: 40px"> </div>
                </div>
            </div>
            <div id="candidates" class="d-flex flex-column w-100">
                <div class="title">
                    Candidates
                </div>
                <div id="competitors" class="d-flex flex-column w-100">
                    <div id="positions" class="d-flex w-100 flex-wrap mb-2" style="gap: 2rem">
                        <div id="president" class="d-flex flex-column w-45" style="gap: 0.2rem">
                            <div class="sub-title">President</div>
                            <div id="candidate" class="d-flex align-center bg-white w-100 justify-content-between border-2" style="padding: 0.4rem;border-radius: 20px">
                                <div id="can-det" class="d-flex" style="gap: 0.5rem">
                                    <div id="can-ID" class="font-bold">C01</div>
                                    <div id="can-Name">Lorem ipsum dolor.</div>
                                </div>

                                <div id="btn-panel" class="mr-1">
                                    <button class=" btn btn-primary">Q & A</button>
                                    <button class=" btn btn-primary" onclick="openPopup()">Make Objection</button>

                                    <div class="dialog-box-outer" id="popup">
                                        <div class="popup mx-1 my-1 px-1 py-1 min-w-40 min-h-50" >
                                            <div class="title">Make Objection</div>
                                            <form action="/ezvote/Voters/election" method="POST" class="d-flex flex-column my-1 px-1 align-items-flex-start">
                                                <div class="d-flex flex-column justify-content-center my-1 w-100">
                                                    <label for="Subject" class="mr-1 text-left text-md">Subject</label>
                                                    <input id="Subject" type="text" class="border-1" style="width:100%" name="Subject">
                                                </div>
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
                                    <button class=" btn btn-primary">View</button>
                                </div>
                            </div>
                            <div id="candidate" class="d-flex align-center bg-white w-100 justify-content-between border-2" style="padding: 0.4rem;border-radius: 20px">
                                <div id="can-det" class="d-flex" style="gap: 0.5rem">
                                    <div id="can-ID" class="font-bold">C01</div>
                                    <div id="can-Name">Lorem ipsum dolor.</div>
                                </div>

                                <div id="btn-panel" class="mr-1">
                                    <button class=" btn btn-primary">Q & A</button>
                                    <button class=" btn btn-primary" onclick="openPopup()">Make Objection</button>

                                    <div class="dialog-box-outer" id="popup">
                                        <div class="popup mx-1 my-1 px-1 py-1 min-w-40 min-h-50" >
                                            <div class="title">Make Objection</div>
                                            <form action="/ezvote/Voters/submitObjections" method="POST" class="d-flex flex-column my-1 px-1 align-items-flex-start">
                                                <div class="d-flex flex-column justify-content-center my-1 w-100">
                                                    <label for="Subject" class="mr-1 text-left text-md">Subject</label>
                                                    <input id="Subject" type="text" class="border-1" style="width:100%" name="Subject">
                                                </div>
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
                                    <button class=" btn btn-primary">View</button>
                                </div>
                            </div>
                            <div id="candidate" class="d-flex align-center bg-white w-100 justify-content-between border-2" style="padding: 0.4rem;border-radius: 20px">
                                <div id="can-det" class="d-flex" style="gap: 0.5rem">
                                    <div id="can-ID" class="font-bold">C01</div>
                                    <div id="can-Name">Lorem ipsum dolor.</div>
                                </div>

                                <div id="btn-panel" class="mr-1">
                                    <button class=" btn btn-primary">Q & A</button>
                                    <button class=" btn btn-primary" onclick="openPopup()">Make Objection</button>

                                    <div class="dialog-box-outer" id="popup">
                                        <div class="popup mx-1 my-1 px-1 py-1 min-w-40 min-h-50" >
                                            <div class="title">Make Objection</div>
                                            <form action="/ezvote/Voters/submitObjections" method="POST" class="d-flex flex-column my-1 px-1 align-items-flex-start">
                                                <div class="d-flex flex-column justify-content-center my-1 w-100">
                                                    <label for="Subject" class="mr-1 text-left text-md">Subject</label>
                                                    <input id="Subject" type="text" class="border-1" style="width:100%" name="Subject">
                                                </div>
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
                                    <button class=" btn btn-primary">View</button>
                                </div>
                            </div>
                        </div>
                        <div id="president" class="d-flex flex-column w-45" style="gap: 0.2rem">
                            <div class="sub-title">Secretary</div>
                            <div id="candidate" class="d-flex align-center bg-white w-100 justify-content-between border-2" style="padding: 0.4rem;border-radius: 20px">
                                <div id="can-det" class="d-flex" style="gap: 0.5rem">
                                    <div id="can-ID" class="font-bold">C01</div>
                                    <div id="can-Name">Lorem ipsum dolor.</div>
                                </div>

                                <div id="btn-panel" class="mr-1">
                                    <button class=" btn btn-primary">Q & A</button>
                                    <button class=" btn btn-primary" onclick="openPopup()">Make Objection</button>

                                    <div class="dialog-box-outer" id="popup">
                                        <div class="popup mx-1 my-1 px-1 py-1 min-w-40 min-h-50" >
                                            <div class="title">Make Objection</div>
                                            <form action="/ezvote/Voters/submitObjections" method="POST" class="d-flex flex-column my-1 px-1 align-items-flex-start">
                                                <div class="d-flex flex-column justify-content-center my-1 w-100">
                                                    <label for="Subject" class="mr-1 text-left text-md">Subject</label>
                                                    <input id="Subject" type="text" class="border-1" style="width:100%" name="Subject">
                                                </div>
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
                                    <button class=" btn btn-primary">View</button>
                                </div>
                            </div>
                            <div id="candidate" class="d-flex align-center bg-white w-100 justify-content-between border-2" style="padding: 0.4rem;border-radius: 20px">
                                <div id="can-det" class="d-flex" style="gap: 0.5rem">
                                    <div id="can-ID" class="font-bold">C01</div>
                                    <div id="can-Name">Lorem ipsum dolor.</div>
                                </div>

                                <div id="btn-panel" class="mr-1">
                                    <button class=" btn btn-primary">Q & A</button>
                                    <button class=" btn btn-primary" onclick="openPopup()">Make Objection</button>

                                    <div class="dialog-box-outer" id="popup">
                                        <div class="popup mx-1 my-1 px-1 py-1 min-w-40 min-h-50" >
                                            <div class="title">Make Objection</div>
                                            <form action="/ezvote/Voters/submitObjections" method="POST" class="d-flex flex-column my-1 px-1 align-items-flex-start">
                                                <div class="d-flex flex-column justify-content-center my-1 w-100">
                                                    <label for="Subject" class="mr-1 text-left text-md">Subject</label>
                                                    <input id="Subject" type="text" class="border-1" style="width:100%" name="Subject">
                                                </div>
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
                                    <button class=" btn btn-primary">View</button>
                                </div>
                            </div>
                            <div id="candidate" class="d-flex align-center bg-white w-100 justify-content-between border-2" style="padding: 0.4rem;border-radius: 20px">
                                <div id="can-det" class="d-flex" style="gap: 0.5rem">
                                    <div id="can-ID" class="font-bold">C01</div>
                                    <div id="can-Name">Lorem ipsum dolor.</div>
                                </div>

                                <div id="btn-panel" class="mr-1">
                                    <button class=" btn btn-primary">Q & A</button>
                                    <button class=" btn btn-primary" onclick="openPopup()">Make Objection</button>

                                    <div class="dialog-box-outer" id="popup">
                                        <div class="popup mx-1 my-1 px-1 py-1 min-w-40 min-h-50" >
                                            <div class="title">Make Objection</div>
                                            <form action="/ezvote/Voters/submitObjections" method="POST" class="d-flex flex-column my-1 px-1 align-items-flex-start">
                                                <div class="d-flex flex-column justify-content-center my-1 w-100">
                                                    <label for="Subject" class="mr-1 text-left text-md">Subject</label>
                                                    <input id="Subject" type="text" class="border-1" style="width:100%" name="Subject">
                                                </div>
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
                                    <button class=" btn btn-primary">View</button>
                                </div>
                            </div>
                        </div>
                        <div id="president" class="d-flex flex-column w-45" style="gap: 0.2rem">
                            <div class="sub-title">Treasurer</div>
                            <div id="candidate" class="d-flex align-center bg-white w-100 justify-content-between border-2" style="padding: 0.4rem;border-radius: 20px">
                                <div id="can-det" class="d-flex" style="gap: 0.5rem">
                                    <div id="can-ID" class="font-bold">C01</div>
                                    <div id="can-Name">Lorem ipsum dolor.</div>
                                </div>
                                <div id="btn-panel" class="mr-1">
                                    <button class=" btn btn-primary">Q & A</button>
                                    <button class=" btn btn-primary">Make Objection</button>
                                    <button class=" btn btn-primary">View</button>
                                </div>
                            </div>
                            <div id="candidate" class="d-flex align-center bg-white w-100 justify-content-between border-2" style="padding: 0.4rem;border-radius: 20px">
                                <div id="can-det" class="d-flex" style="gap: 0.5rem">
                                    <div id="can-ID" class="font-bold">C01</div>
                                    <div id="can-Name">Lorem ipsum dolor.</div>
                                </div>

                                <div id="btn-panel" class="mr-1">
                                    <button class=" btn btn-primary">Q & A</button>
                                    <button class=" btn btn-primary">Make Objection</button>
                                    <button class=" btn btn-primary">View</button>
                                </div>
                            </div>
                            <div id="candidate" class="d-flex align-center bg-white w-100 justify-content-between border-2" style="padding: 0.4rem;border-radius: 20px">
                                <div id="can-det" class="d-flex" style="gap: 0.5rem">
                                    <div id="can-ID" class="font-bold" >C01</div>
                                    <div id="can-Name" >Lorem ipsum dolor.</div>
                                </div>

                                <div id="btn-panel" class="mr-1">
                                    <button class=" btn btn-primary">Q & A</button>
                                    <button class=" btn btn-primary">Make Objection</button>
                                    <button class=" btn btn-primary">View</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require approot.'/View/inc/footer.php';?>
