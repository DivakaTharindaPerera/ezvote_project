<?php require approot . '/View/inc/VoterHeader.php'; ?>
<?php require approot . '/View/inc/ManagerNavbar.php'; ?>
<?php require approot . '/View/inc/manager_sidebar.php'; ?>

<script>

window.onload = function(){
    var element = document.getElementById("home");
    element.classList.remove("active");

    var element = document.getElementById("plan");
    element.classList.add("active");
}
</script>

<div class="main-container max-h-85">
    <div class="w-75 justify-content-center align-items-center">
    <div class="d-flex flex-column min-w-95"> 
    <h2 class="title text-center">Subscription Plans</h2>
    <div class="d-flex justify-content-center align-items-center my-1">
    <a href="/ezvote/Subscription_plan/create_subscription">
        <button class="btn btn-primary justify-content-center align-items-center" type="button">
            CREATE NEW PLAN
        </button>
    </a>
    </div>



<div class="w-100">
    <div class="d-flex flex-column">
    <div class="d-flex justify-content-evenly ">
        <div class="justify-content-center border border-primary my-3 mr-1 min-w-50">
        <input type="text" id="searchInput" onchange="myFunction(this.value)" placeholder="Search Plan......" class="w-100 h-100">
        </div>
        <div class="my-3 d-flex mr-5">
        <a href="#">
            <button class="btn btn-primary">SEARCH</button></a>
            <div class="d-flex text-center align-items-center text-md ml-3">FILTER
            </div>
        </div>
    </div>
    </div>
    

    <div class="w-100 h-50 overflow-scroll">
        <table id="myTable" class="table border border-primary w-100 h-35">
                <tbody>

                <?php

                $i = 1;

                $arrlength = count($data, COUNT_RECURSIVE);

                for($x = 0; $x < $arrlength-1; $x++) {
                    echo '<tr>
                            <td class="td-1">'.$data[0][$x]->PlanName.'</td>
                            <td class="td-2">
                                    <label class="switch">
                                    <input type="checkbox" id="toggle-'.$i.'" onclick="myFunction'.$i.'()">
                                        <span class="slider round"></span>
                                    </label>
                                    <span id="myDIV-'.$i.'" class="ml-1 enabled">Disabled</span>
                                </td>
                                <td class="td-3"><a href="edit_subscription/'.$data[0][$x]->PlanID.'"> 

                                    <button class="btn btn-info ml-5">DETAILS</button>
                                    </td></a>
                                    <td class="td-4"><a href="delete_subscription/'.$data[0][$x]->PlanID.'">
                                    <button class="btn btn-danger mr-1">DELETE</button>
                                    </td></a>
                            </tr>
                            
                            <script>
                                function myFunction'.$i.'() {
                                    var checkBox = document.getElementById("toggle-'.$i.'");
                                    var text = document.getElementById("myDIV-'.$i.'");
                                    if (checkBox.checked == false) {
                                        text.innerHTML = "Disabled";
                                    }else{
                                        text.innerHTML = "Enabled";
                                    }
                                }
                            </script>
                            ';
                    $i++;
                } ?>

                <!-- <script>
                    function toggleText() {
                        var x = document.getElementById("myDIV");
                        if (x.innerHTML === "Disabled") {
                            x.innerHTML = "Enabled";
                        } else {
                            x.innerHTML = "Disabled";
                        }
                    }
                </script> -->
                </tbody>
        </table>
    </div>
    </div>
</div>
</div>
</div>

</script><script src="/ezvote/public/js/search.js"></script>
<?php require approot . '/View/inc/footer.php'; ?>

