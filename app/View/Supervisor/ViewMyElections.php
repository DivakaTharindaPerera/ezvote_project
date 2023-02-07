<?php require approot . '/View/inc/header.php'; ?>
    <link rel="stylesheet" href="<?php echo urlroot; ?>/css/myElections.css">
</head>
<body>
<div class="wholePage">
    <div class="top_nav_bar">
            <?php
                require_once(approot."/View/topnavbar.php");
            ?>
    </div>
    <div class="pagecontent">

    <div id="search" class="searchbar">
        <input type="text" id="searchInput" placeholder="Search for elections" onkeyup="searchElection()">
    </div>

    <div id="sort" class="sortElections">
        <div class="sortContainer">
            Sort Elections
            <div>
                <form action="<?php echo urlroot; ?>/Pages/sortByTitle" method="post">
                    <select name="sortMethod">
                        <option value="asc">A-Z</option>
                        <option value="desc">Z-A</option>
                        <option value="Dasc">Date Ascending</option>
                        <option value="Ddesc">Date Descending</option>
                    </select>
                    <input type="submit" value="Sort">
                </form>
            </div>
        </div>
    </div>
    
    <div id="elections" class="electionsContainer">
    <?php
        foreach($data as $row){
            
            echo "<div class='electionCard' id='".$row->ElectionId."' >";
            echo "<div class='electionCardContainer'>";
            echo "<h4>".$row->Title."</h4><h5>by ".$row->OrganizationName."<h5>";
            echo "from: ".$row->StartDate." to: ".$row->EndDate;
            echo "<br><br><a href='".urlroot."/Pages/ViewMyElection/".$row->ElectionId."'><div class='viewBtn'>View</div></a>";
            echo "</div></div>";
        }
    ?>
    </div>
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