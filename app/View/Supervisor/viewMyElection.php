<?php require approot . '/View/inc/header.php'; ?>
</head>
<body>
    <div class="top_nav_bar">
            <?php
                require_once(approot."/View/topnavbar.php");
            ?>
    </div>
    <div class="pagecontent">
        <div>
            <?php 
                require_once(approot."/View/inc/Sidebar.php");
            ?>
        </div>
        <div>
            <a href="<?php echo urlroot; ?>/Pages/electionCandidates/<?php echo $data['electionRow']->ElectionId; ?>">
                <div> Candidates </div>
            </a>
            <a href="<?php echo urlroot; ?>/Pages/electionNominations/<?php echo $data['electionRow']->ElectionId; ?>">
                <div> Nominations </div>
            </a>
            <?php
                echo $data['electionRow']->ElectionId."<br>".$data['electionRow']->Title."<br>";
            ?>
        </div>
    </div>
<?php require approot . '/View/inc/footer.php'; ?>