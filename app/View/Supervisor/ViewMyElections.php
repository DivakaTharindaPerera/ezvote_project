<?php require approot.'/View/inc/VoterHeader.php';?>
<?php require approot.'/View/inc/AuthNavbar.php';?>
<?php require approot.'/View/inc/sidebar-new.php'?>

<div class="main-container">
    <div class="d-flex justify-content-center align-items-center title">Created Elections</div>
    <div class="d-flex mt-1 justify-content-end  ">
        <div id="search" class="d-flex justify-content-end mx-1 justify-content-end">
            <input type="text" id="searchInput" placeholder="Search for elections" onkeyup="searchElection()">
        </div>

        <div id="sort" class="d-flex mx-1 ">

<!--                Sort Elections-->
                <div class="d-flex justify-content-center">
                    <form action="<?php echo urlroot; ?>/Pages/sortByTitle" method="post" class="d-flex justify-content-evenly">
                        <div>
                            <label for="sortMethod">Sortings:</label>
                            <select name="sortMethod" class="bg-secondary border border-1 border-radius-1 w-25 text-center">
                                <option value="asc">A-Z</option>
                                <option value="desc">Z-A</option>
                                <option value="Dasc">Date Ascending</option>
                                <option value="Ddesc">Date Descending</option>
                            </select>
                        </div>
                        <div>
                            <button type="submit" value="Sort" class="btn btn-primary">Sort</button>
                        </div>
                    </form>
                </div>
        </div>
    </div>
    <div id="elections" class="d-flex flex-wrap mr-1 ml-3 my-1 min-h-100">
    <?php
        foreach($data as $row):
        ?>
            <div class='card electionCard' id='<?=$row->ElectionId?>' >
            <div class='d-flex flex-column'>
                <div class="sub-title"><h4><?=$row->Title?></h4></div>
                <div class="text-xl"><h5> <?=$row->OrganizationName?></h5></div>
                <div> from: <?=$row->StartDate?> to: <?=$row->EndDate?></div>
                <a href='<?=urlroot?>/Pages/ViewMyElection/<?=$row->ElectionId?>'>
                    <span class='btn btn-primary'>View</span></a>
            </div>
            </div>
        <?php
        endforeach;
    ?>
    </div>
</div>


<script>
    function searchElection(){
        var input = document.getElementById("searchInput").value;
        var filter = input.toUpperCase();
        console.log(filter);
        var elections = document.getElementById("elections");
        var electionCards = elections.getElementsByClassName("electionCard");
        for(var i =0; i < electionCards.length; i++){
            var electionCard = electionCards[i];
            console.log(electionCard);
            var electionTitle = electionCard.getElementsByTagName("h4")[0];
            var electionOrg = electionCard.getElementsByTagName("h5")[0];

            var title = electionTitle.innerText;
            var org = electionOrg.innerText;
            
            if(title.toUpperCase().indexOf(filter) > -1 || filter == "" || org.toUpperCase().indexOf(filter) > -1){
                electionCard.style.display = "";
            }else{
                electionCard.style.display = "none";
            }

        }


    }

</script>

<?php require approot . '/View/inc/footer.php'; ?>