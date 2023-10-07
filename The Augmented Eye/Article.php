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
        ?>
    </body>
</html>