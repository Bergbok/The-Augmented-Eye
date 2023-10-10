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
            include_once 'PHP Scripts/Display Handlers/Article-Display-Handler.php'; 

            if (isset($_GET['viewArticle'])) {
                // Purpose: Used to get article info.
                include_once 'PHP Scripts/Database-Handler.php'; 

                $columns = '*';
                $table = 'articles';
                $where_clause = 'article_id = :article_id';
                $where_values = [
                    'article_id' => $_GET['viewArticle']
                ];
            
                $article_info = select($columns, $table, $where_clause, $where_values);

                !empty($article_info) ? $article_exists = true : $article_exists = false;

                if ($article_exists) {
                    show_article_info($article_info);
                    // Purpose: Used to increment the article view count.
                    include_once 'PHP Scripts/Database-Handler.php'; 
                    increment_article_view_count($_GET['viewArticle']);
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
                    include_once 'PHP Scripts/Database-Handler.php';

                    $column_names = 'article_id, comment_poster_id, comment_text, comment_post_datetime';

                    $prepared_statement = ':article_id, :comment_poster_id, :comment_text, :comment_post_datetime';
                    
                    $values = [
                        'article_id' => $_GET['viewArticle'],
                        'comment_poster_id' => $_SESSION['user_id'],
                        'comment_text' => nl2br($_POST['new_comment_text']),
                        'comment_post_datetime' => date('Y-m-d H:i:s')
                    ];
                    
                    if (insert('comments', $column_names, $prepared_statement, $values)) {
                        sleep(2);
                        include_once 'PHP Scripts/Current-Page-Info.php';
                        header('Location: ' . get_current_page_info('url'));
                    }                   
                }
            }
        ?>
    </body>
</html>