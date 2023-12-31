<!-- 
    Filename: Logout.php
    Author: Albertus Cilliers   
    Description: Logs the user out and redirects them to the home page after 3 seconds.
 -->

<?php 
    // Redirects the user to the Home page in 3 seconds
    header('refresh:3;url=Home');
    // Purpose: Displays header.
    include_once 'Header.php'; 
    // Purpose: Used to log out user.
    include_once 'PHP Scripts/Login-Handler.php';
    logout();
    // Purpose: Used to display a alert informing the user that they have been logged out.
    include_once 'PHP Scripts/Display Handlers/Alert-Handler.php';
?>

<html>
    <head>
        <title> Logged Out! </title>
    </head> 

    <body>
        <h1 class='centered-text pixel-text bright-text'> You've been logged out, cya</h1>
        
        <div class='bottom-left'>
            <img src='/The Augmented Eye/Images/Wave.gif' alt='Bye :)'></img>
        </div>
    </body>

</html>