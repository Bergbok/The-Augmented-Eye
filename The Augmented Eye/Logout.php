<?php 
    header( "refresh:3;url=Home.php" );
    include('Header.php'); 
    session_destroy();
    // include('PHP Scripts/Alert-Handler.php') ;
?>

<html>

    <head>

        <title> Logged Out! </title>
        <link rel="stylesheet" href="styles.css">

    </head> 

    <body>
        <p class="center pixel-text bright-text"> You've been logged out, cya</p>
        <div class="bottom-center">
            <img src="Images/Wave.gif" alt="Bye :)"></img>
        </div>
    </body>

</html>