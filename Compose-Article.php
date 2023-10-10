<!-- 
    Filename: Compose-Article.php
    Author: Albertus Cilliers   
    Description: Lets a logged in user post an article.
 -->

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
                        echo '<input class=\'submit-button\' type=\'submit\' value=\'Submit\' name=\'Submit\'></input>';

                        if (isset($_REQUEST['Submit'])) {
                            // Purpose: Used to check if the article is valid.
                            include_once('PHP Scripts/Form-Validation.php');

                            if (validate_article()) {
                                // Purpose: Used to insert article into database.
                                include_once('PHP Scripts/Database-Inserts.php');

                                $column_names = 'articleAuthorID, articleTitle, articleContent, articlePublishDate';

                                $values_clause = ':articleAuthorID, :articleTitle, :articleContent, :articlePublishDate';
                                
                                $data = [
                                    'articleAuthorID' => $_SESSION['userID'],
                                    'articleTitle' => $_POST['article_Title'],
                                    'articleContent' => nl2br($_POST['article_Content']),
                                    'articlePublishDate' => date('Y-m-d H:i:s')
                                ];

                                if (insert('Articles', $column_names, $values_clause, $data)) {
                                    echo '<p> Successfully submitted article. </p>';
                                } else {
                                    echo '<p> Couldn\'t submit article. </p>';
                                }
                            }
                        }
                    }
                ?>
            </form>
        </div>
    </body>
</html>