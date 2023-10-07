<?php 
    // Purpose: Displays header.
    include_once 'Header.php'; 
?>


<html>
    <head>
        <title> Change Password </title>
    </head>

    <body>
        <div class="centered-column pixel-text">
            <form method="POST">
                <fieldset>
                    <legend class="center">
                        <strong>Change Password</strong>
                    </legend>
                    <?php
                        echo "<label for=changePassword> New Password </label>";
                        echo "<input type='text' name='new_Password'></input>";
                        echo "<br><br>";
                        echo "<input class='submit-button' type='submit' value='Change Password'></input>";
                        
                        // Purpose: Used to check if user is logged in.
                        include_once 'PHP Scripts/Login-Handler.php'; 

                        if (isLoggedIn()) {
                            // Purpose: Used to check if new password is valid.
                            include_once 'PHP Scripts/Form-Validation.php';

                            if (validatePasswordChange()) {
                                // Purpose: Used to update the password.
                                include_once 'PHP Scripts/Database-Updates.php';
                                
                                if (updateUserPassword()) {
                                    echo "<p> Successfully updated password! </p>";
                                } else {
                                    echo "<p class='error-message'> Couldn't update password </p>";
                                }
                            }
                        } else {
                            echo "<p class='error-message'> Not logged in! </p>";
                        }
                    ?>
                </fieldset>
            </form>
        </div>
    </body>
</html>                            