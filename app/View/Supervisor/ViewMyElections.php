<?php require approot.'/View/inc/VoterHeader.php';?>
<?php require approot.'/View/inc/AuthNavBar.php';?>
<?php require approot.'/View/inc/sideBar-new.php'?>

<div class="main-container">
    <div class="d-flex">
        <div id="search" class="d-flex justify-content-end w-45 mx-1">
            <input type="text" id="searchInput" placeholder="Search for elections" onkeyup="searchElection()">
        </div>

        <div id="sort" class="d-flex mx-1 ">
            <div class="d-flex">
<!--                Sort Elections-->
                <div class="d-flex">
                    <form action="<?php echo urlroot; ?>/Pages/sortByTitle" method="post">
                        <div>
                            <select name="sortMethod">
                                <option value="asc">A-Z</option>
                                <option value="desc">Z-A</option>
                                <option value="Dasc">Date Ascending</option>
                                <option value="Ddesc">Date Descending</option>
                            </select>
                        </div>

                    </form>
                </div>
                <div>
                    <button type="submit" value="Sort" class="btn btn-primary w-100">
                </div>
            </div>
        </div>
    </div>
    <div id="elections" class="d-flex">
    <?php
        foreach($data as $row){
            
            echo "<div class='card' id='".$row->ElectionId."' >";
            echo "<div class='electionCardContainer'>";
            echo "<h4>".$row->Title."</h4><h5>by ".$row->OrganizationName."<h5>";
            echo "from: ".$row->StartDate." to: ".$row->EndDate;
            echo "<br><br><a href='".urlroot."/Pages/ViewMyElection/".$row->ElectionId."'><div class='btn btn-primary'>View</div></a>";
            echo "</div></div>";
        }
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