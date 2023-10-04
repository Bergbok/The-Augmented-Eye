<?php
    include_once('Header.php'); 
?>

<html>

    <head>

        <title> Login </title>
        <link rel="stylesheet" href="styles.css">

    </head>

    <body>
        <div class="center pixel-text">
            <form method="POST">
                <fieldset>

                    <legend align="center">
                        <strong>Login</strong>
                    </legend>

                    <label for="email">Email:</label>
                    <input type="text" id="email" name="user_Email"></input>

                    <br/><br/>

                    <label for="password">Password:</label>
                    <input type="password" id="password" name="user_Password"></input>

                    <br/><br/>

                    <input class="submit-button" type="submit" value="Login"></input>

                </fieldset>

                <?php 
                    include_once("PHP Scripts/Form-Validation.php"); 
                    if (validateLogin()) {
                        include_once("PHP Scripts/Login-Handler.php");
                        if (logIn()) {
                            echo "<p> Successfully logged in! </p> <br>";
                            header("Location: Home.php");
                        } else {
                            echo "<p class='error-message'> No accounts found for given email/password combination. </p> <br>";
                        }
                    }
                ?>

                <br></br>
                <form>
                    <fieldset>

                        <legend align="center">
                            <strong>Don't have an account?</strong>
                        </legend>

                        <button class="submit-button" onclick="location.href='/The Augmented Eye/Registration.php'" type="button">Register</button>

                    </fieldset>
                </form>
            </form>
        </div>
    </body>
</html>