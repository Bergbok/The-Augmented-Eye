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

                $columns = '*';
                $table = 'articles';
                $where_clause = 'article_id = :id';
                $where_values = [
                    'id' => $_GET['viewArticle']
                ];
            
                $article_info = select($columns, $table, $where_clause, $where_values);

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
                    // Purpose: Used to insert comment into database.
                    include_once 'PHP Scripts/Database-Inserts.php';

                    $column_names = 'article_id, comment_poster_id, comment_text, comment_post_date';

                    $values_clause = ':article_id, :comment_poster_id, :comment_text, :comment_post_date';
                    
                    $data = [
                        'article_id' => $_GET['viewArticle'],
                        'comment_poster_id' => $_SESSION['user_id'],
                        'comment_text' => nl2br($_POST['new_comment_text']),
                        'comment_post_date' => date('Y-m-d H:i:s')
                    ];
                    
                    if (insert('comments', $column_names, $values_clause, $data)) {
                        sleep(2);
                        include_once 'PHP Scripts/Current-Page-Info.php';
                        header('Location: ' . get_current_page_info('url'));
                    }                   
                }
            }
        ?>
    </body>
</html>