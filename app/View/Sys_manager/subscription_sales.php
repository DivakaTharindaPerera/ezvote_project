<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/ManagerNavbar.php'; ?>
<?php require approot . '/View/inc/manager_sidebar.php'; ?>

<script>

window.onload = function(){
    var element = document.getElementById("home");
    element.classList.remove("active");

    var element = document.getElementById("sale");
    element.classList.add("active");
}
</script>

    <div class="main-container max-h-85">
    <div class="d-flex flex-column justify-content-center align-items-center ">
        <div class="subscription">
            <h2 class="title text-center">Subscription Sales</h2>
        </div>

    <!-- <a href="/ezvote/System_manager/dashboard">
    <div class="ml-1 mt-1">
        <img src="<?php echo urlroot; ?>/public/img/button.png" />
    </div>
</a> -->

<div class="d-flex flex-column">
    <div class="d-flex justify-content-evenly ">
        <div class="justify-content-center border border-primary my-3 mr-1 min-w-50">
        <input type="text" id="searchInput" value="" onchange="myFunction(this.value)" placeholder="Search Plan......" class="w-100 h-100">
        </div>
        <div class="my-3 d-flex mr-5">
        <a href="#">
            <button class="btn btn-primary ml-2" >SEARCH</button></a>
            <div class="d-flex text-center align-items-center text-md ml-2">FILTER
            </div>
        </div>
    </div>
    </div>

<div class="w-100 h-50" style="overflow:auto; height:50vh;">
<table id= "myTable" class="table border border-primary w-100 h-50">
            <tr class="min-w-75">
            <thead>
            <tr>
                <th>Plan Name</th>
                <th>Price ($)</th>
                <th>Purchsed Users</th>
                <th>Plan Income ($)</th>
                <th>Discount Details</th>
                </tr>
            </thead>

    <tbody>

        <?php

            $arrlength = count($data);

            for($x = 0; $x < $arrlength; $x++) {
            echo '<tr>
                <td class="td-1 w-25">'.$data[$x]->planName.'</td>
                <div class="d-flex flex-column">
                <td class="td-2">'.$data[$x]->Price.'</td>  
                <td class="td-3">'.$data[$x]->userCount.'</td>
                <td class="td-4">'.$data[$x]->Price * $data[$x]->userCount.'</td>
                </div>
                <td class="td-5"><div class="d-flex flex-column">
                    <div class="d-flex flex-row text-info">
                         Discount: '.$data[$x]->Discount.'%
                    </div> '; ?>

                    <button class="btn btn-info my-1" onclick="document.getElementById('discount-input').value = '<?php echo $data[$x]->Discount ?>';document.getElementById('update').action='./edit_process/<?php echo $data[$x]->planID; ?>'; openPopup();">EDIT</button>
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
                    <div class="justify-content-start">
                        <button type="submit" class="btn btn-primary ml-5">SAVE</button>
                    </div>
                    <div class="justify-content-end" onclick="closePopup()">
                        <div type="button" class="btn btn-primary ml-3">CANCEL</div>
                    </div></div>
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

<script src="/ezvote/public/js/main.js"></script>
<script src="/ezvote/public/js/search.js"></script>
<?php require approot . '/View/inc/footer.php'; ?>



