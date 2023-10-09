<!-- 
    Filename: Article.php
    Author: Albertus Cilliers   
    Description: Shows article information (title, author, publish date, viewcount, body & sharing options) 
 -->

<?php 
    // Purpose: Displays header.
    include_once 'Header.php'; 
?>

<html>
    <body>
        <?php
            // Purpose: Used to display article.
            include_once 'PHP Scripts/Article-Display-Handler.php'; 

            if (isset($_GET['viewArticle'])) {
                // Purpose: Used to get article info.
                include_once 'PHP Scripts/Database-Selects.php'; 

                $where_clause = 'articleID = :id';
                $where_values = [
                    'id' => $_GET['viewArticle']
                ];

                $article_info = select_article($where_clause, $where_values);

                !empty($article_info) ? $article_exists = true : $article_exists = false;

                if ($article_exists) {
                    show_article_info($article_info);
                    // Purpose: Used to increment the article view count.
                    include_once 'PHP Scripts/Database-Updates.php'; 
                    increment_article_viewcount($_GET['viewArticle']);
                } else {
                    show_article_not_found();
                } 
            } else {
                show_article_not_found();
            }

            if (isset($_REQUEST['post_comment'])) {
                include_once 'PHP Scripts/Form-Validation.php'; 
                if (validate_comment()) {
                    include_once 'PHP Scripts/Database-Inserts.php';
                    if (insert_comment()) {
                        sleep(1);
                        include_once 'PHP Scripts/Current-Page-Info.php';
                        header('Location: ' . get_current_page_info('url'));
                    }                   
                }
            }
        ?>
    </body>
</html>