<?php
    session_start();
?>

<html>
    <head>

        <link rel="stylesheet" href="styles.css">
        <link rel="icon" href="Images/favicon.ico">

    </head>

    <?php include_once('Profile-Preview.php'); ?>

    <body>
        <div class="header center pixel-text">
            <img src="Images/logo.png" alt="The Augemented Eye Logo"></img>
            <ul class="header-tabs">
                <li><a href="Home.php">Home</a></li>
                <li><a href="News.php">News</a></li>
                <li><a href="Contact-Us.php">Contact</a></li>
                <li><a href="About.php">About</a></li>
            </ul> 
            <?php 
                include_once('PHP Scripts/Login-Handler.php'); 
                if (isAdmin()){
                    echo "<ul class='header-tabs'>
                            <li><a href='Send-Newsletter.php'>Newsletter</a></li>
                            <li><a href='User-Stats.php'>User Stats</a></li>
                            <li><a href='Article-Stats.php'>Article Stats</a></li>
                          </ul>";
                }
            ?>
        </div>  
    </body>
</html>