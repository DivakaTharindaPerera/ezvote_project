<?php //require approot . '/View/inc/header.php'; ?>
<?php require approot.'/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/AuthNavbar.php'; ?>
<?php require approot . '/View/inc/sidebar-new.php'; ?>
<!--</head>-->
<!--<body>-->
<!---->
<!--    <div class="top_nav_bar">-->
<!--        --><?php
//            require_once(approot."/View/topnavbar.php");
//        ?>
<!--    </div>-->
<div class="main-container">
    <div class="title">Adding Positions</div>
    <div class="d-flex flex-column border-primary border-radius-2 border-2 my-4">
        <div class="position mx-1 my-1">
            <div><?php echo $data['electionId'];?></div>
            <div class="positionName mx-1 my-1" id="position1">
                <label for="positionName">Position Name: </label>
                <input type="text" name="positionName" id="positionName">
                <span id="nameerror" style="color: red;"></span>
            </div>
            <div class="positiondesc mx-1 my-1">
                <label for="positionDesc">Position Description: </label><br>
                <textarea name="positionDesc" id="positionDesc" class="border-primary border-1 w-100" cols="30" rows="10"></textarea>
            </div>
            <div class="noOfOptions mx-1 my-1" id="position2">
                <label for="noOfOptions">No of options per position: </label>
                <input type="number" name="noOfOptions" id="noOfOptions" value="1" min="1">
            </div>
            <div class="addposition mx-1 my-1" id="position3">
                <button id="addposition" class="btn btn-primary" onclick="addPosition()">ADD</button>
            </div>
            <div class="allpositions mx-1 my-1 table" id="allPositions" style="display: none;">
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
                </table>
                Total No of positions: <span id="count"></span>
            </div>
        </div>

        <div class="finalForm mx-2 my-1">
            <form action="<?php echo urlroot; ?>/Elections/insertPositions" id="form" method="POST" class="align-items-center justify-content-center">
                <input type="hidden" name="electionId" value="<?php echo $data['electionId']; ?>">
                <button type="submit" class="btn btn-primary" >ADD POSITIONS</button>
            </form>
        </div>
    </div>

</div>


<script src="<?php echo urlroot; ?>/js/addPositions.js"></script>
<?php require approot . '/View/inc/footer.php'; ?>