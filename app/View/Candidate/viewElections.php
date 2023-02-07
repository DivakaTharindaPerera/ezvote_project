<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>
<?php require approot . '/View/inc/side_bar.php'; ?>

<div class="d-flex">

    <!-- Ongoing, upcoming and recent elections -->
    <div class="px-5" style="margin-left:200px;">
            <h2>Ongoing Elections</h2>
            <div class="m-1 text-dark w-100 border-1 border-dark border-radius-5 " style="box-shadow: 5px 10px;" >
                <p class="px-1" style="width:500px;">Welfare board election 2022 
                <button type="submit" class="btn bg-primary text-white w-5 " style="margin:10px">Vote</button>
                </p>
            </div>

            <h2>Upcoming Elections</h2>
            <div class="m-1 text-dark w-100 border-1 border-dark border-radius-5" style="box-shadow: 5px 10px;">
                <p class="px-1" >UCSC Union election 2022
                <button type="submit" class="btn bg-primary text-white " style="margin:10px">Details</button>
                </p>
            </div>
            <div class="m-1 text-dark w-100 border-1 border-dark border-radius-5" style="box-shadow: 5px 10px;">
                <p class="px-1">Monthly stock preferences 2022
                <button type="submit" class="btn bg-primary text-white" style="margin:10px">Details</button>
                </p>
            </div>

            <h2>Recent Elections</h2>
            <div class="m-1 text-dark w-100 border-1 border-dark border-radius-5" style="box-shadow: 5px 10px;">
                <p class="px-1">UCSC Union election 2021
                    <button type="submit" class="btn bg-primary text-white" style="margin:10px">Results</button></p>
            </div>
            <div class="m-1 text-dark w-100 border-1 border-dark border-radius-5" style="box-shadow: 5px 10px;">
                <p class="px-1">Welfare board election 2021
                <button type="submit" class="btn bg-primary text-white" style="margin:10px">Results</button>
                </p>
            </div>
            <div class="m-1 text-dark w-100 border-1 border-dark border-radius-5" style="box-shadow: 5px 10px;">
                <p class="px-1">Welfare board election 2021
                <button type="submit" class="btn bg-primary text-white" style="margin:10px">Results</button>
                </p>
            </div>

        </div>

        <!-- <div class="px-5">
            <form action="#" method="post">
                <div class="m-5"></div>
            <button type="submit" class="btn bg-primary text-white m-1 text-lg w-100">Elections</button><br><br>
            <button type="submit" class="btn bg-primary text-white m-1 text-lg w-100">My Elections</button><br><br>
            <button type="submit" class="btn bg-primary text-white m-1 text-lg w-100">Conferences</button><br><br>
            <button type="submit" class="btn bg-primary text-white m-1 text-lg w-100" name="apply_nominations"><a href="<?php echo urlroot; ?>/Candidates/applyNomination" class="text-white">Apply Nomination</a></button><br><br>
            <button type="submit" class="btn bg-primary text-white m-1 text-lg w-100" id="s" name="my_nominations"><a href="<?php echo urlroot; ?>/Candidates/candidateProfile" class="text-white">Candidate Profile</a></button><br><br>
            <button type="submit" class="btn bg-primary text-white m-1 text-lg w-100">Objection</button><br><br><br>
            </div>
            </form>
        </div> -->
    </div>
    <?php require approot.'/View/inc/footer.php';?>