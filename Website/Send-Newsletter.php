<!-- 
    Filename: Send-Newsletter.php
    Author: Albertus Cilliers   
    Description: Lets admins send out newsletters to subscribers.
 -->

<?php 
    // Purpose: Displays header.
    include_once 'Header.php'; 
?>

<html>
    <head>
        <title> Newsletter </title>
    </head>

    <body>
        <div class='centered-column pixel-text centered-text'>
            <form method='POST'>
                <?php         
                    // Purpose: Used to check if the user is an admin.
                    include_once 'PHP Scripts/Login-Handler.php';

                    if (!is_admin()){
                        echo '<div class=\'centered-text\'>';
                        echo '  <h1> Access Forbidden </h1>';
                        echo '  <h2> Only admins may access this page. </h2>';
                        echo '</div>';
                    } else {
                        echo '<fieldset>';
                        echo '  <legend class=\'center\'>Send Newsletter</legend>';
                        echo '  <label class=\'required\' for=\'subject\'>Title:</label>';
                        echo '  <input required type=\'text\' id=\'subject\' name=\'newsletter_subject\'></input>';
                        echo '  <h3> Email Body: </h1>';
                        echo '  <textarea required name=\'newsletter_body\'></textarea>';
                        echo '  <br><br>';
                        echo '  <input class=\'submit-button\' type=\'submit\' value=\'Send\' name=\'Send\'></input>';
                        echo '</fieldset>';

                        if (isset($_REQUEST['Send'])) {
                            // Purpose: Used to validate newsletter information.
                        include_once 'PHP Scripts/Form-Validation.php';

                        if (validate_newsletter()) {
                            // Purpose: Used to send newsletter to subscribers.
                            include_once 'PHP Scripts/Email-Handler.php';

                            send_newsletter();
                        }
                        }
                    }
                ?>
            </form>
        </div>
    </body>
</html>