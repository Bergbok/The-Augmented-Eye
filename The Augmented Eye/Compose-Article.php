<?php
    include_once('Header.php'); 
?>

<html>

    <head>

        <title> Compose Article </title>
        <link rel='stylesheet' href='styles.css'>

    </head>

    <body>
        <div class='centered-column centered-text pixel-text'>
            <form method='POST'>
                <?php         
                    include_once('PHP Scripts/Login-Handler.php');
                    if (!isLoggedIn()){
                        echo "<p> Login to be able to post. </p>";
                        echo "<a class='dark-text' href='Login.php'> LOGIN </a>";
                    } else {
                        echo "<label for='name'>Title:</label>";
                        echo "<input type='text' id='titleInput' name='article_Title'></input>";
                        echo "<h3><strong> Content: </strong></h1>";
                        echo "<textarea name='article_Content' placeholder='Please ensure your article is at least 50 characters'></textarea>";
                        echo "<br><br>";
                        echo "<input class='submit-button' type='submit' value='Submit'></input>";

                        include_once('PHP Scripts/Form-Validation.php');
                        //Inserting user into database
                        if (validateArticle()) {
                            include_once('PHP Scripts/Database-Inserts.php');
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