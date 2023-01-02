<?php require approot.'/View/inc/header.php'; ?>

    <div class="top_nav_bar">
        <?php
            require_once(approot."/View/topnavbar.php");
        ?>
    </div>
    <br>
    <?php
        echo "id: ".$data['id'];
    ?>

    <br>
    
    <div class="nameinput">
        Name of the voter: <input type="text" name="name" id="name"><span id="nameerror" style="color: red;"></span>
    </div>
    <br>
    <div class="emailinput">
        Email of the voter: <input type="text" name="email" id="email"><span id="emailerror" style="color: red;"></span>
    </div>
    <br>
    <div class="valueinput">
        Value of the vote: <input type="text" name="value" id="value">
    </div>
    <div class="addsinglevoterbtn">
        <button id="addsinglevoter" onclick="addSingleVoter()">ADD VOTER</button>
    </div>
    <br>

    <input type="file" name="csvupload" id="csvupload" accept=".txt">
    <!-- format :'name'-'email'-'value of the vote' -->
    
    <br>

    <p id="output"></p>
 
    <div id="voterList" style="display: none;">
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
    Voters count: <span id="count"></span>
    <button id="delAllRows" onclick="delall()">REMOVE ALL</button>
    </div>
    <div class="duplicateentries" id="duplicateentries" style="color: red;">
        
    </div>
    <br>
    
    <form action="<?php echo urlroot; ?>/Elections/insertvoters" id="form" method="POST">
        <input type="hidden" name="electionId" value="<?php echo $data['id']; ?>"><br>
        <button type="submit">ADD VOTERS</button>
    </form>


    <script src="<?php echo urlroot; ?>/js/addVoters.js"></script>
<?php require approot.'/View/inc/footer.php'; ?>
