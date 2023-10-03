<html>

    <head>

        <title> Logged Out! </title>
        <link rel="stylesheet" href="styles.css">

    </head> 

    <?php 
        include('Header.php');
        // include('PHP Scripts/Alert-Handler.php') ;
        session_destroy();
        header( "refresh:3;url=Home.php" );
    ?>

    <body>
        <p class="center pixel-text bright-text"> You've been logged out, cya</p>
        <div class="bottom-center">
            <img src="Images/Wave.gif" alt="Bye :)"></img>
        </div>
    </body>

</html>