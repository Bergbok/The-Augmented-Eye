<?php include_once('Header.php'); ?>

<html>
    <head>
        <title> Newsletter </title>
    </head>

    <body>
        <div class="centered-column pixel-text centered-text">
            <form method='POST'>
                <?php         
                    include_once('PHP Scripts/Login-Handler.php');
                    if (!isAdmin()){
                        echo "<div class='centered-text'>";
                        echo "  <h1> Access Forbidden </h1>";
                        echo "  <h2> Only admins may access this page. </h2>";
                        echo "</div>";
                    } else {
                        echo "<fieldset>";
                        echo "  <legend class='center'>Send Newsletter</legend>";
                        echo "  <label for='subject'>Title:</label>";
                        echo "  <input type='text' id='subject' name='newsletter_Subject'></input>";
                        echo "  <h3> Email Body: </h1>";
                        echo "  <textarea name='newsletter_Body'></textarea>";
                        echo "  <br><br>";
                        echo "  <input class='submit-button' type='submit' value='Send'></input>";
                        echo "</fieldset>";

                        include_once('PHP Scripts/Form-Validation.php');
                        if (validateNewsletter()) {
                            include_once('PHP Scripts/Email-Handler.php');
                            sendNewsletter();
                        }
                    }
                ?>
            </form>
        </div>
    </body>
</html>