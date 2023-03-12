<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/ManagerNavbar.php'; ?>
<?php require approot . '/View/inc/manager_sidebar.php'; ?>

    <div class="main-container">
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
        <input type="text" id="searchPlan" style="height:100%;" onkeyup="myFunction()" placeholder="Search Plan......" class="w-100 h-100">
        </div>
        <div class="my-3 d-flex mr-5">
        <a href="#">
            <button class="btn btn-primary ml-2">SEARCH</button></a>
            <div class="d-flex text-center align-items-center text-md ml-2">FILTER
            </div>
        </div>
    </div>
    </div>

<!-- <div class="d-flex">
    <input class="border-primary max-w-50" type="text" placeholder="Search plan......"> -->
    <!-- <div class="ml-2 mt-1">
    <p>Sort by</p>
    </div> -->
    <!-- <button class="btn btn-primary ml-3">Search</button>
    </div> -->
    <!-- <img src="<?php echo urlroot; ?>/public/img/sort.png" /> -->
<!-- </div> -->


<table class="table border border-primary w-95">
    <tbody>
            <tr class="min-w-75">
            <tr>
                <th>Plan Name</th>
                <th>Price ($)</th>
                <th>Purchsed Users</th>
                <th>Plan Income ($)</th>
                <th>Discount Details</th>
                </tr>
                <td class="td-1 w-25">Annual Plan</td>
                <div class="d-flex flex-column">
                <td class="td-2">69</td>  
                <td class="td-3">40</td>
                <td class="td-4">2760</td>
                </div>
                <td class="td-5"><div class="d-flex flex-column">
                    <div class="d-flex flex-row text-black">
                         Discount: 30%
                    </div>
                    <button class="btn btn-info my-1" onclick="openPopup()">EDIT</button>
                    <div class="dialog-box-outer" id="popup">
                    <div class="popup mx-1 my-1 px-1 py-1 min-w-40 min-h-50">
                    <div class="border border-primary w-10 d-flex justify-content-center align-items-center">
                        <div class="text-black">Discount 
                    <input class="w-10 bg-primary" type="number" id="discount">
                    </div>
                    </div>
                    <div class="d-flex align-items-flex-end justify-content-end" onclick="closePopup()">
                    <div class="d-flex flex-row justify-content-center align-items-center">
                        <div class="btn btn-primary">Save</div>
                        <div class="btn btn-primary">cancel</div>
                    </div>
                    
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>

        </div></td>
       </tr>

       <tr class="min-w-25">
        <td class="td-1 w-30">Starter Plan</td>
        <div class="d-flex flex-column">
        <td class="td-2">90</td>
        <td class="td-3">45</td>
        <td class="td-4">4050</td>
            <!-- <div class="my-1 d-flex flex-column">
                <button class="btn btn-dark" >Promote Site</button>
            </div>
            <div class="d-flex flex-column">
                <button class="btn btn-dark">Email Promote</button>
            </div> -->
        </div>
        <td class="td-4"><div class="d-flex flex-column">
            <div class="d-flex flex-row text-black">
                Discount: 10%
            </div>
            <button class="btn btn-info my-1">EDIT</button>
        </div></td>
       </tr>
    </tbody>
</table>

<!-- <div class="d-flex flex-row mb-2">
    <label> : </label>
    
        
        
    </div>
         -->
</div>
</div>
</div>
<script src="../../public/js/main.js"></script>
<?php require approot . '/View/inc/footer.php'; ?>



<!-- </body>

</html> -->
