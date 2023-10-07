<?php 
    header( "refresh:3;url=Home" );
    include_once('Header.php'); 
    include_once('PHP Scripts/Login-Handler.php');
    logOut();
    // include_once('PHP Scripts/Alert-Handler.php') ;
?>

<html>
    <head>
        <title> Logged Out! </title>
    </head> 

    <body>
        <h1 class="centered-text pixel-text bright-text"> You've been logged out, cya</h1>
        
        <div class="bottom-left">
            <img src="/The Augmented Eye/Images/Wave.gif" alt="Bye :)"></img>
        </div>
    </body>

</html>