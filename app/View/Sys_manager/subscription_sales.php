<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/ManagerNavbar.php'; ?>
<?php require approot . '/View/inc/manager_sidebar.php'; ?>

<script>

window.onload = function(){
    var element = document.getElementById("dashboard");
    element.classList.remove("active");

    var element = document.getElementById("sale");
    element.classList.add("active");
}
</script>

    <div class="main-container max-h-85">
    <div class="min-w-85 min-h-90">
    <div class="w-100 h-50 d-flex flex-column justify-content-center align-items-center overflow-y overflow-x my-1">
        <div class="subscription">
            <div class="title text-center text-uppercase">Subscription Sales</div>
        </div>


<div class="d-flex flex-column">
    <div class="d-flex justify-content-evenly ">
        <div class="justify-content-center border border-primary my-3 mr-4 min-w-85">
        <input type="text" id="searchInput" value="" onchange="myFunction(this.value)" placeholder="Search Plan......" class="w-85 h-100">
        </div>
        <div class="my-3 d-flex mr-4">
        <a href="#">
            <div class="btn btn-primary mr-3" >SEARCH</div></a>
            <!-- <div class="d-flex text-center align-items-center text-md">FILTER
            </div> -->
        </div>
    </div>
    </div>
    

<div class="w-100 h-50">
<table id= "myTable" class="table border border-primary w-85 h-50 overflow-scroll ml-3 mb-2">
            <tr class="min-w-75">
            <thead>
            <tr>
                <th>Plan Name</th>
                <th>Price (Rs)</th>
                <th>Purchased Users</th>
                <th>Discount (%)</th>
                <th>Plan Income (Rs)</th>
                </tr>
            </thead>

    <tbody>

        <?php

            $arrlength = count($data);

            for($x = 0; $x < $arrlength; $x++) {
            echo '<tr>
                <td class="td-1 w-25 text-uppercase">'.$data[$x]->PlanName.'</td>
                <div class="d-flex flex-column">
                <td class="td-2">'.$data[$x]->Price.'</td>  
                <td class="td-3">'.$data[$x]->userCount.'</td>
                <td class="td-4"> '.$data[$x]->Discount.'%</div>
                <td class="td-5">'.($data[$x]->Price * $data[$x]->userCount) * (100 - $data[$x]->Discount) / (100).' </td>
                </div>
                 '; ?>

                    <!-- <button class="btn btn-info my-1" onclick="document.getElementById('discount-input').value = '<?php //echo $data[$x]->Discount ?>';document.getElementById('update').action='./edit_process/<?php //echo $data[$x]->planID; ?>'; openPopup();">EDIT</button> -->
                    <div class="dialog-box-outer" id="popup">
                    <div class="popup mx-1 my-1 px-1 py-1 min-w-20 min-h-25">
                    <div class="title text-center">Edit Discount</div>

                    <form id="update" action="./edit_process/" method="POST">
                    <div class="my-4 w-100 d-flex flex-row justify-content-center align-items-center">
                        <div class="text-black w-50">
                        <label>Discount (%) :</label>
                    <input name="Discount" id="discount-input" class="px-1 border border-black bg-primary w-30" style="border:1px solid black; margin-left:1rem; padding-left: 1rem;" type="number" min="0" max="100" id="discount" value="">
                    </div>
                    </div>          
                    <div class="d-flex flex-row mx-5 my-2">
                    <div class="justify-content-start" onclick="closePopup()">
                        <button type="button" class="btn btn-primary ml-2">CANCEL</button>
                    </div>
                    <div class="justify-content-end">
                        <button type="submit" class="btn btn-primary ml-5">SAVE</button>
                    </div>
                    </div>
                    </form>
                    </div>
                    </div>
                    </div>
                </td>
            </tr>
            <?php 
            }
        ?>

    </tbody>
</table>
</div>
</div>
</div>
</div>

<script src="/ezvote/public/js/main.js"></script>
<script src="/ezvote/public/js/search.js"></script>
<?php require approot . '/View/inc/footer.php'; ?>



