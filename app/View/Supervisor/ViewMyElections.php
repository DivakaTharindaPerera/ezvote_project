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
    
    <div id="elections" class="electionsContainer">
    <?php
        foreach($data as $row){
            echo "<div class='electionCard'>";
            echo "<div class='electionCardContainer'>";
            echo "<h4>".$row->Title."</h4><h5>by ".$row->OrganizationName."<h5>";
            echo "<a href='".urlroot."/Pages/ViewMyElection/".$row->ElectionId."'><div class='viewBtn'>View</div></a>";
            echo "</div></div>";
        }
    ?>
    </div>
    </div>
</div>
<?php require approot . '/View/inc/footer.php'; ?>