<html>

    <head>

        <title> Login </title>
        <link rel="stylesheet" href="styles.css">

    </head>

    <?php include('Header.php'); ?>

    <body>
        <div class="center pixel-text">
            <form method="POST">
                <fieldset>

                    <legend align="center">
                        <strong>Login</strong>
                    </legend>

                    <label for="name">Name:</label>
                    <input type="text" id="name" name="newuser_Name"></input>

                    <br/><br/>

                    <label for="surname">Surname:</label>
                    <input type="text" id="surname" name="newuser_Surname"></input>

                    <br/><br/>

                    <input class="submit-button" type="submit" value="Register"></input>
                </fieldset>
            </form>
        </div>
    </body>

</html>