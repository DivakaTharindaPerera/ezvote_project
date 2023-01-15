<?php require approot . '/View/inc/header.php'; ?>

</head>
<body>

    <div class="top_nav_bar">
        <?php
            require_once(approot."/View/topnavbar.php");
        ?>
    </div>

<div class="position">
    <span><?php echo $data['electionId']; ?></span>
    
    <div class="positionName" id="position1">
        <label for="positionName">Position Name: </label>
        <input type="text" name="positionName" id="positionName">
        <span id="nameerror" style="color: red;"></span>
    </div><br>
    <div class="positiondesc">
        <label for="positionDesc">Position Description: </label>
        <textarea name="positionDesc" id="positionDesc" cols="30" rows="10"></textarea>
    </div><br>
    <div class="noOfOptions" id="position2">
        <label for="noOfOptions">No of options per position: </label>
        <input type="number" name="noOfOptions" id="noOfOptions" value="1" min="1">
    </div><br>
    <div class="addposition" id="position3">
        <button id="addposition" onclick="addPosition()">ADD</button>
    </div><br>
    <div class="allpositions" id="allPositions" style="display: none;">
        <table border="1">
            <thead>
                <tr>
                    <th>Position Name</th>
                    
                    <th>No of options</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody id="positionList">
                <!-- list of positions -->
            </tbody>
        </table><br>
        Total No of positions: <span id="count"></span>
    </div>
</div>

<div class="finalForm">
    <form action="<?php echo urlroot; ?>/Elections/insertPositions" id="form" method="POST">
        <input type="hidden" name="electionId" value="<?php echo $data['electionId']; ?>">
        <button type="submit" >ADD POSITIONS</button>
    </form>
</div>

<script src="<?php echo urlroot; ?>/js/addPositions.js"></script>
<?php require approot . '/View/inc/footer.php'; ?>