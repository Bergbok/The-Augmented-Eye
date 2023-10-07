<!-- 
    Filename: Login.php
    Author: Albertus Cilliers   
    Description: Lets the user login, and contains a redirect to Registration.php incase they don't have an account.
 -->

<?php 
    // Purpose: Displays header.
    include_once 'Header.php'; 
?>

<html>
    <head>
        <title> Login </title>
    </head>

    <body>
        <div class='centered-column pixel-text'>
            <form method='POST'>
                <fieldset>

                    <legend class='center'>
                        <strong>Login</strong>
                    </legend>

                    <label for='email'>Email:</label>
                    <input type='text' id='email' name='user_Email'></input>

                    <br/><br/>

                    <label for='password'>Password:</label>
                    <input type='password' id='password' name='user_Password'></input>

                    <br/><br/>

                    <input class='submit-button' type='submit' value='Login'></input>

                </fieldset>

                <?php 
                    // Purpose: Used to validate login information.
                    include_once 'PHP Scripts/Form-Validation.php'; 

                    if (validate_login()) {
                        // Purpose: Used to check if login is successful.
                        include_once('PHP Scripts/Login-Handler.php');

                        if (login()) {
                            echo '<p> Successfully logged in! </p> <br>';
                            header('Location: Home');
                        } else {
                            echo '<p class=\'centered-text error-message\'> No accounts found for given email/password combination. </p> <br>';
                        }
                    }
                ?>

                <br></br>
                <form>
                    <fieldset>

                        <legend class='center'>
                            <strong>Don't have an account?</strong>
                        </legend>

                        <button class='submit-button' onclick="location.href='/The Augmented Eye/Registration'" type='button'>Register</button>

                    </fieldset>
                </form>
            </form>
        </div>
    </body>
</html>