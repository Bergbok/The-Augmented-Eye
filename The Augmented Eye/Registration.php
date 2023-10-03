<?php include('Header.php'); ?>

<html>

    <head>

        <title> Registration </title>
        <link rel="stylesheet" href="styles.css">

    </head>

    <body>
        <div class="center pixel-text">

            <!-- <h3> Registration </h3> -->

            <form method="POST">

                <fieldset>

                    <legend align="center">
                        <strong>Registration</strong>
                    </legend>

                    <label for="name">Name:</label>
                    <input type="text" id="name" name="newuser_Name"></input>

                    <br/><br/>

                    <label for="surname">Surname:</label>
                    <input type="text" id="surname" name="newuser_Surname"></input>

                    <br/><br/>

                    <label for="gender">Gender:</label>
                    <select id="gender" name="newuser_Gender">
                        <option>Male</option>
                        <option>Female</option>
                        <option>Other</option>
                    </select>      
                    
                    <br/><br/>

                    <label for="birthday">Birthday:</label>
                    <input type="date" id="birthday" name="newuser_Birthday"></input>

                    <br/><br/>

                    <label for="email">Email:</label>
                    <input type="text" id="email" name="newuser_Email"></input>

                    <br/><br/>

                    <label for="contact">Contact Number:</label>
                    <input type="number" id="contact" name="newuser_Contact"></input>

                    <br/><br/>

                    <!-- Sets newuser_ReceiveNewsletter to No by default -->
                    <?php
                        // $_POST["newuser_ReceiveNewsletter"] = "No";
                    ?>

                    <label for="newsletter" id="newsletter">Receive newsletters via e-mail? </label>
                    <!-- <input type="hidden" id="newsletter_checkbox_false" value="No" name="newuser_ReceiveNewsletter" checked></input> -->
                    <input type="checkbox" id="newsletter_checkbox" name="newuser_ReceiveNewsletter" value="Yes"></input>

                    <br/><br/>

                    <input class="submit-button" type="submit" value="Register"></input>

                </fieldset>
                    
                <?php         
                    include("PHP Scripts/Form-Validation.php");
                    //Inserting user into database
                    if (validateRegistration() == true) {
                        include("PHP Scripts/Database-Inserts.php");
                        insertUser();
                    }
                ?>
            </form>      
        </div>

    </body>

</html>