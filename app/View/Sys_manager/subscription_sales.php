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
       <tr class="min-w-30">
        <td class="td-1">Annual Plan [$99.99]</td>
        <div class="d-flex flex-column">
        <td class="td-2">Purchased Users : 78</td>
        <td class="td-3">Plan Income :  7792.2$</td>
            <!-- <div class="my-1 d-flex flex-column">
                <button class="btn btn-dark" >Promote Site</button>
            </div>
            <div class="d-flex flex-column">
                <button class="btn btn-dark">Email Promote</button>
            </div> -->
        </div>
        <td class="td-4"><div class="d-flex flex-column">
            <div class="d-flex flex-row text-info">
                Discount : 20%
            </div>
            <button class="btn btn-dark my-1">EDIT</button>
        </div></td>
       </tr>

       <tr class="min-w-30">
        <td class="td-1">Monthly Plan [$199.99]</td>
        <div class="d-flex flex-column">
        <td class="td-2">Purchased Users : 55</td>
        <td class="td-3">Plan Income :  10999.4$</td>
            <!-- <div class="my-1 d-flex flex-column">
                <button class="btn btn-dark" >Promote Site</button>
            </div>
            <div class="d-flex flex-column">
                <button class="btn btn-dark">Email Promote</button>
            </div> -->
        </div>
        <td class="td-4"><div class="d-flex flex-column">
            <div class="d-flex flex-row text-info">
                Discount : 15%
            </div>
            <button class="btn btn-dark my-1">EDIT</button>
        </div></td>
       </tr>

       <tr class="min-w-30">
        <td class="td-1">Starter Plan [$9.99]</td>
        <div class="d-flex flex-column">
        <td class="td-2">Purchased Users : 90</td>
        <td class="td-3">Plan Income :  899.1$</td>
            <!-- <div class="my-1 d-flex flex-column">
                <button class="btn btn-dark" >Promote Site</button>
            </div>
            <div class="d-flex flex-column">
                <button class="btn btn-dark">Email Promote</button>
            </div> -->
        </div>
        <td class="td-4"><div class="d-flex flex-column">
            <div class="d-flex flex-row text-info">
                Discount : 10%
            </div>
            <button class="btn btn-dark my-1">EDIT</button>
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
<?php require approot . '/View/inc/footer.php'; ?>


<!-- </body>

</html> -->
