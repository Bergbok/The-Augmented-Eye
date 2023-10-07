<!-- 
    Filename: Header.php
    Author: Albertus Cilliers   
    Description: Header that gets displayed on every other page.
 -->

<?php
    session_start();
?>

<html>
    <head>

        <link rel='stylesheet' href='/The Augmented Eye/styles.css'>
        <link rel='icon' href='/The Augmented Eye/Images/favicon.ico'>

    </head>

    <?php 
        // Purpose: Displays profile widget at the top left of page.
        include_once 'Profile-Preview.php'; 
    ?>

    <body>
        <div class='header center pixel-text'>
            <img src='/The Augmented Eye/Images/logo.png' alt='The Augmented Eye Logo'></img>
            <ul class='header-tabs'>
                <li><a href='/The Augmented Eye/Home'>Home</a></li>
                <li><a href='/The Augmented Eye/News'>News</a></li>
                <li><a href='/The Augmented Eye/Contact-Us'>Contact</a></li>
                <li><a href='/The Augmented Eye/About'>About</a></li>
            </ul> 
            <?php 
                // Purpose: Used to check if the user is a admin.
                include_once 'PHP Scripts/Login-Handler.php'; 

                if (is_admin()){
                    echo '<ul class=\'header-tabs\'>';
                    echo '  <li><a href=\'/The Augmented Eye/Send-Newsletter\'>Newsletter</a></li>';
                    echo '  <li><a href=\'/The Augmented Eye/User-Stats\'>User Stats</a></li>';
                    echo '  <li><a href=\'/The Augmented Eye/Article-Stats\'>Article Stats</a></li>';
                    echo '</ul>';  
                }
            ?>
        </div>  
    </body>
</html>