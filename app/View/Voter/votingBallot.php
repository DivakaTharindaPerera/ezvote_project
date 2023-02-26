<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>
<?php require approot . '/View/inc/sidebar-new.php'; ?>

<div class="main-container">
    <div class="title justify-content-center mt-1"><?php echo $data->Title?><br><?php echo $data->OrganizationName?></div>
        <div class="d-flex flex-column min-h-80">
<!--            <div class="title">Candidates</div>-->
            <div class="">
                <div class="title">Presidents</div>
                <div class="d-flex justify-content-center">
                    <div class="card" id="card-1">
                        <div class="d-flex flex-column">
                            <div class="sub-title">Sandun Jayasanka</div>
                            <div><img src="/ezvote/public/img/profile.jpg" style="max-height:50px;max-width: 50px" alt="profile photo"></div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="text-lg">BraveIo</div>
                        </div>
                        <div class="d-flex justify-content-center mb-1">
                            <button class="btn btn-primary min-w-50" id="1" onclick="marked(1)">Vote</button>
                        </div>
                    </div>
                    <div class="card" id="card-2">
                        <div class="d-flex flex-column">
                            <div class="sub-title">Sandun Jayasanka</div>
                            <div><img src="/ezvote/public/img/profile.jpg" style="max-height:50px;max-width: 50px" alt="profile photo"></div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="text-lg">BraveIo</div>
                        </div>
                        <div class="d-flex justify-content-center mb-1">
                            <button class="btn btn-primary min-w-50" id="2">Vote</button>
                        </div>
                    </div>
                    <div class="card" id="card-3">
                        <div class="d-flex flex-column">
                            <div class="sub-title">Sandun Jayasanka</div>
                            <div><img src="/ezvote/public/img/profile.jpg" style="max-height:50px;max-width: 50px" alt="profile photo"></div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="text-lg">BraveIo</div>
                        </div>
                        <div class="d-flex justify-content-center mb-1">
                            <button class="btn btn-primary min-w-50" id="3">Vote</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="title">Secretary</div>
                <div class="d-flex justify-content-center">
                    <div class="card" id="card-4">
                        <div class="d-flex flex-column">
                            <div class="sub-title">Sandun Jayasanka</div>
                            <div><img src="/ezvote/public/img/profile.jpg" style="max-height:50px;max-width: 50px" alt="profile photo"></div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="text-lg">BraveIo</div>
                        </div>
                        <div class="d-flex justify-content-center mb-1">
                            <button class="btn btn-primary min-w-50" id="4" onclick="marked(4)">Vote</button>
                        </div>
                    </div>
                    <div class="card" id="card-5">
                        <div class="d-flex flex-column">
                            <div class="sub-title">Sandun Jayasanka</div>
                            <div><img src="/ezvote/public/img/profile.jpg" style="max-height:50px;max-width: 50px" alt="profile photo"></div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="text-lg">BraveIo</div>
                        </div>
                        <div class="d-flex justify-content-center mb-1">
                            <button class="btn btn-primary min-w-50" id="5" onclick="marked(5)">Vote</button>
                        </div>
                    </div>
                    <div class="card" id="card-6">
                        <div class="d-flex flex-column">
                            <div class="sub-title">Sandun Jayasanka</div>
                            <div><img src="/ezvote/public/img/profile.jpg" style="max-height:50px;max-width: 50px" alt="profile photo"></div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="text-lg">BraveIo</div>
                        </div>
                        <div class="d-flex justify-content-center mb-1">
                            <button class="btn btn-primary min-w-50" id="6" onclick="marked(6)">Vote</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="title">Treasurer</div>
                <div class="d-flex justify-content-center">
                    <div class="card" id="card-7">
                        <div class="d-flex flex-column">
                            <div class="sub-title">Sandun Jayasanka</div>
                            <div><img src="/ezvote/public/img/profile.jpg" style="max-height:50px;max-width: 50px" alt="profile photo"></div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="text-lg">BraveIo</div>
                        </div>
                        <div class="d-flex justify-content-center mb-1">
                            <button class="btn btn-primary min-w-50" id="7" onclick="marked(7)">Vote</button>
                        </div>
                    </div>
                    <div class="card" id="card-8">
                        <div class="d-flex flex-column">
                            <div class="sub-title">Sandun Jayasanka</div>
                            <div><img src="/ezvote/public/img/profile.jpg" style="max-height:50px;max-width: 50px" alt="profile photo"></div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="text-lg">BraveIo</div>
                        </div>
                        <div class="d-flex justify-content-center mb-1">
                            <button class="btn btn-primary min-w-50" id="8" onclick="marked(8)">Vote</button>
                        </div>
                    </div>
                    <div class="card" id="card-9">
                        <div class="d-flex flex-column">
                            <div class="sub-title">Sandun Jayasanka</div>
                            <div><img src="/ezvote/public/img/profile.jpg" style="max-height:50px;max-width: 50px" alt="profile photo"></div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="text-lg">BraveIo</div>
                        </div>
                        <div class="d-flex justify-content-center mb-1">
                            <button class="btn btn-primary min-w-50" id="9" onclick="marked(9)">Vote</button>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center min-h-40 mb-2">
<!--                    <button class="btn btn-primary mb-3 mx-2">Cancel</button>-->
                    <button class="btn btn-primary min-w-20 mb-3 mx-2 my-1" onclick="openPopup()">Submit</button>
                    <div class="dialog-box-outer" id="popup">
                        <div class="dialog-box d-flex flex-column justify-content-center">
                            <div class="dialog-box-content 1border-primary border-1 border-radius-1 w-75 mb-1">
                                <div class="text-lg">President</div>
                                <div class="bg-info text-lg px-1">Sandun Jayasanka</div>
                            </div>
                            <div class="dialog-box-content border-primary border-1 border-radius-1 w-75 mb-1">
                                <div class="text-lg">Secretary</div>
                                <div class="bg-info text-lg px-1">Sandun Jayasanka</div>
                            </div>
                            <div class="dialog-box-content border-primary border-1 border-radius-1 w-75 mb-1">
                                <div class="text-lg">Treasurer</div>
                                <div class="bg-info text-lg px-1">Sandun Jayasanka</div>
                            </div>
                            <div class="d-flex flex-column dialog-box-content">
                                <div class="text-lg text-danger">Confirm Votes?</div>
                                <div class="text-lg text-danger">You cant undo once you confirmed.</div>
                            <div class="dialog-box-content justify-content-evenly">
                                <div>
                                    <button class="btn btn-danger justify-content-start" onclick="cancelBallot()">Cancel</button>
                                </div>
                                <div>
                                    <button class="btn btn-primary justify-content-end" onclick="confirmBallot()">Confirm</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require approot . '/View/inc/footer.php'; ?>
