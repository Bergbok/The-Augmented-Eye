<?php
    include_once('Header.php'); 
?>

<html>

    <head>

        <title> Compose Article </title>
        <link rel="stylesheet" href="styles.css">

    </head>

    <body>
        <div class="center pixel-text">
            <form method="POST">
                <label for="name">Title:</label>
                <input type="text" id="titleInput" name="article_Title"></input>

                <h3><strong> Content: </strong></h1>

                <textarea name="article_Content"></textarea>

                <br><br>

                <input class="submit-button" type="submit" value="Submit"></input>

                <?php         
                    include_once('PHP Scripts/Login-Handler.php');
                    if (!isLoggedIn()){
                        echo "<p> Login to be able to post. </p>";
                        echo "<a class='dark-text' href='Login.php'> LOGIN </a>";
                    } else {
                        include_once("PHP Scripts/Form-Validation.php");
                        //Inserting user into database
                        if (validateArticle() == true) {
                            include_once("PHP Scripts/Database-Inserts.php");
                            if (insertArticle()) {
                                echo "<p> Successfully submitted article. </p>";
                            } else {
                                echo "<p> Couldn't submit article. </p>";
                            }
                        }
                    }
                    
                ?>
            </form>
        </div>
    </body>

</html>