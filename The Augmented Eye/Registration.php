<?php 
    // Purpose: Displays header.
    include_once 'Header.php'; 
?>

<html>
    <head>
        <title> Registration </title>
    </head>

    <body>
        <div class='centered-column pixel-text'>
             <form method='POST'>
                <fieldset>

                    <legend class='center'>
                        <strong>Registration</strong>
                    </legend>

                    <label for='name'>Name:</label>
                    <input type='text' id='name' name='newuser_Name'></input>

                    <br/><br/>

                    <label for='surname'>Surname:</label>
                    <input type='text' id='surname' name='newuser_Surname'></input>

                    <br/><br/>

                    <label for='gender'>Gender:</label>
                    <select id='gender' name='newuser_Gender'>
                        <option>Male</option>
                        <option>Female</option>
                        <option>Other</option>
                    </select>      
                    
                    <br/><br/>

                    <label for='birthday'>Birthday:</label>
                    <input type='date' id='birthday' name='newuser_Birthday'></input>

                    <br/><br/>

                    <label for='email'>Email:</label>
                    <input type='text' id='email' name='newuser_Email'></input>

                    <br/><br/>

                    <label for='contact'>Contact Number:</label>
                    <input type='number' id='contact' name='newuser_Contact'></input>

                    <br/><br/>

                    <!-- Sets newuser_ReceiveNewsletter to No by default -->
                    <?php
                        // $_POST['newuser_ReceiveNewsletter'] = 'No';
                    ?>

                    <label for='newsletter' id='newsletter'>Receive newsletters via e-mail? </label>
                    <input type='checkbox' id='newsletter_checkbox' name='newuser_ReceiveNewsletter' value='Yes'></input>

                    <br/><br/>

                    <input class='submit-button' type='submit' value='Register'></input>

                </fieldset>
                    
                <?php         
                    // Purpose: Used to validate registration information.
                    include_once 'PHP Scripts/Form-Validation.php';

                    if (validateRegistration()) {
                        // Purpose: Used to insert new user into database.
                        include_once 'PHP Scripts/Database-Inserts.php';

                        if (insertUser()) {
                            // Purpose: Used to email password to user upon successful registration.
                            include_once 'PHP Scripts/Email-Handler.php';

                            if (sendPassword()) {
                                echo '<div class=\'centered-text\'>';
                                echo '  <p> Successfully created account, check your email for your password. </p>';
                                echo '  <a class=\'dark-text\' href=\'/The Augmented Eye/Login\'> LOGIN </a>';
                                echo '</div>';
                            } else {
                                echo '<div class=\'centered-text\'>';
                                echo '  <p> Successfully created account, couldn\'t send you your password via email though :( </p>';
                                echo '  <a class=\'dark-text\' href=\'/The Augmented Eye/Login\'> LOGIN </a>';
                                echo '</div>';
                            }
                        } else {
                            echo '<p> Couldn\'t create account </p>';
                        }
                    }
                ?>
            </form>      
        </div>
    </body>
</html>