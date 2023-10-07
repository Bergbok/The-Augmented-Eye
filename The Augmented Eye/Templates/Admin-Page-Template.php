<?php 
    // Purpose: Displays header.
    include_once 'Header.php'; 
?>

<html>

    <head>

        <title> Newsletter </title>
        <link rel="stylesheet" href="styles.css">

    </head>

    <body>
        <div class="centered-column pixel-text centered-text">
            <?php         
                // Purpose: Used to check if the user is an admin.
                include_once 'PHP Scripts/Login-Handler.php';

                if (!isAdmin()){
                    echo "<div class='centered-text'>";
                    echo "  <h1> Access Forbidden </h1>";
                    echo "  <h2> Only admins may access this page. </h2>";
                    echo "</div>";
                } else {
                    echo "<fieldset>";
                    echo "</fieldset>";
                }
            ?>
        </div>
    </body>

</html>