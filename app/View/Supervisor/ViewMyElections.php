<?php require approot . '/View/inc/header.php'; ?>
</head>
<body>
    <div id="elections" class="electionsContainer">
    <?php
        foreach($data as $row){
            echo "<div id='id".$row->ElectionId."' class='singleElection'>";
            echo $row->ElectionId." - ".$row->Title." - ".$row->OrganizationName."<div class='viewBtn'>";
            echo "<a href='".urlroot."/Pages/ViewMyElection/".$row->ElectionId."'>View</a></div>";
            echo "</div>";
        }
    ?>
    </div>

<?php require approot . '/View/inc/footer.php'; ?>