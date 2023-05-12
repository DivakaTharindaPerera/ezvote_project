<?php //require approot.'/View/inc/header.php'; ?>
<?php require approot.'/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>
<?php require approot . '/View/inc/sidebar-new.php'; ?>
   <div class="main-container">
       <div class="title">Adding Voters</div>
       <div class="d-flex flex-column border-primary border-radius-2 border-3 my-2 bg-white">
           <div class="nameinput mx-1 my-1">
               Name of the voter: <input type="text" name="name" id="name"><span id="nameerror" style="color: red;"></span>
           </div>
<!--           <br>-->
           <div class="emailinput mx-1 my-1">
               Email of the voter: <input type="text" name="email" id="email"><span id="emailerror" style="color: red;"></span>
           </div>
<!--           <br>-->
           <div class="valueinput mx-1 my-1">
               Value of the vote: <input type="text" name="value" id="value" value="1">
           </div>
           <div class="addsinglevoterbtn align-items-center justify-content-center my-1">
               <button id="addsinglevoter" class="mx-1 btn btn-primary" onclick="addSingleVoter()">ADD VOTER</button>
           </div>
<!--           <br>-->
           <div class="d-flex align-items-center justify-content-center mx-1 my-1 btn btn-info flex-column text-center">
                <div class="text-xl text-danger mb-1">
                    <i class="fas fa-info-circle"></i>
                    Very important
                    <p class="text-danger">
                        Please provide the voters list in a text file with the following format: <br>
                            * use the format 'name'-'email'-'value of the vote'<br>
                            * each voter in a new line <br>
                            * the file should be in .txt format <br>
                            * do not provide empty lines <br>
                    </p>
                    
                </div>
               <input type="file" name="csvupload" id="csvupload"  accept=".txt">
               <!-- format :'name'-'email'-'value of the vote' -->
           </div>
           <div>
               <p id="output"></p>
           </div>
           <div id="voterList" class="table mx-1 my-1" style="display: none;">
               <table border="1" >
                   <!-- table for the voters -->
                   <thead>
                   <tr>
                       <th>Name</th>
                       <th>Email</th>
                       <th>Value</th>
                       <th>Action</th>
                   </tr>
                   </thead>
                   <tbody id="list">
                   <!-- lost of voters going here -->
                   </tbody>

               </table>

               <br>
               <div class="d-flex justify-content-evenly align-items-center">
                   <div>Voters count: <span id="count"></span></div>
                   <div><button id="delAllRows" class="btn btn-danger" onclick="delall()">REMOVE ALL</button></div>
               </div>
           </div>
           <div class="duplicateentries" id="duplicateentries" style="color: red;">

           </div>
<!--           <br>-->
           <div class="d-flex my-1 mx-3 align-items-center justify-content-center">
               <form action="<?php echo urlroot; ?>/Elections/insertvoters" id="form" method="POST">
                   <input type="hidden" name="electionId" value="<?php echo $data; ?>"><br>
                   <button type="submit" class="btn btn-primary">ADD VOTERS</button>
               </form>
           </div>

       </div>


   </div>


    <script src="<?php echo urlroot; ?>/js/addVoters.js"></script>
<?php require approot.'/View/inc/footer.php'; ?>
