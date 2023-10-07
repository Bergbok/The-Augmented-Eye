<?php 
    // Purpose: Displays header.
    include_once 'Header.php'; 
?>


<html>
    <head>
        <title> Compose Article </title>
    </head>

    <body>
        <div class='centered-column centered-text pixel-text'>
            <form method='POST'>
                <?php         
                    // Purpose: Used to check if the user is logged in.
                    include_once('PHP Scripts/Login-Handler.php');

                    if (!is_logged_in()){
                        echo '<p> Login to be able to post. </p>';
                        echo '<a class=\'dark-text\' href=\'/The Augmented Eye/Login\'> LOGIN </a>';
                    } else {
                        echo '<label for=\'name\'>Title:</label>';
                        echo '<input type=\'text\' id=\'titleInput\' name=\'article_Title\'></input>';
                        echo '<h3> Content: </h1>';
                        echo '<textarea name=\'article_Content\' placeholder=\'Please ensure your article is at least 50 characters\'></textarea>';
                        echo '<br><br>';
                        echo '<input class=\'submit-button\' type=\'submit\' value=\'Submit\'></input>';

                        // Purpose: Used to check if the article is valid.
                        include_once('PHP Scripts/Form-Validation.php');

                        if (validate_article()) {
                            // Purpose: Used to insert article into database.
                            include_once('PHP Scripts/Database-Inserts.php');

                            if (insert_article()) {
                                echo '<p> Successfully submitted article. </p>';
                            } else {
                                echo '<p> Couldn\'t submit article. </p>';
                            }
                        }
                    }
                ?>
            </form>
        </div>
    </body>
</html>