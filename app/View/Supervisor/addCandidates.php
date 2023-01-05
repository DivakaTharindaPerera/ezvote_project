<?php require approot.'/View/inc/header.php'; ?>

<?php
    require_once(approot."/View/topnavbar.php");
?>

<?php
    echo "Election id: ".$data['electionId'];
?>

<div class="position">
    <div class="positionName" id="position1">
        <label for="positionName">Position Name</label>
        <input type="text" name="positionName" id="positionName">
    </div><br>
    <div class="noOfOptions" id="position2">
        <label for="noOfOptions">No of options</label>
        <input type="number" name="noOfOptions" id="noOfOptions">
    </div><br>
    <div class="addposition" id="position3">
        <button id="addposition" onclick="addPosition()">ADD</button>
    </div><br>
    <div class="allpositions">
        <table border="1">
            <thead>
                <tr>
                    <th>Position Name</th>
                    <th>No of options</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="positionList">
                <!-- list of positions -->
            </tbody>
        </table>
    </div>


</div>
<div class="candidate">

</div>

<?php require approot.'/View/inc/footer.php'; ?>
