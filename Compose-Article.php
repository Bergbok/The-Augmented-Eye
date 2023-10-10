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
        <div class='centered-column pixel-text'>
            <form method='POST'>
                <?php         
                    // Purpose: Used to check if the user is logged in.
                    include_once('PHP Scripts/Login-Handler.php');

                    if (!is_logged_in()){
                        echo '<div class=\'centered-text\'';
                        echo '<p> Login to be able to post. </p>';
                        echo '<a class=\'dark-text\' href=\'/The Augmented Eye/Login\'> LOGIN </a>';
                        echo '</div>';
                    } else {
                        echo '<div class=\'centered-text\'';
                        echo '<label for=\'name\'>Title:</label>';
                        echo '<input type=\'text\' id=\'titleInput\' name=\'article_title\'></input>';
                        echo '<h3> Content: </h1>';
                        echo '<textarea name=\'article_text\' placeholder=\'Please ensure your article is at least 50 characters\'></textarea>';
                        echo '</div>';

                        echo '<p class=\'centered-text\'> Tags: </p>';
                        echo '<div class=\'multiselect-help centered-text\'';
                        echo '<p> for windows: hold down the control (ctrl) button to select multiple option</p>';
                        echo '<p> for mac: hold down the command button to select multiple options </p>';
                        echo '</div>';
                        echo '<select id=\'article_tags\' name=\'article_tags[]\' multiple style=\'width:100%;\'>';

                        include_once('PHP Scripts/Database-Handler.php');

                        $columns = 'tag_id, tag_name';
                        $table = 'tags';
                        $fetch_multiple_rows = true;
                        
                        $tags = select($columns, $table, '', [], $fetch_multiple_rows);

                        foreach ($tags as $rows) {
                            echo '<option value=\'' . $rows['tag_id'] . '\'>' . $rows['tag_name'] . '</option>';
                        }

                        echo '</select>';

                        echo '<br><br>';
                        echo '<input class=\'submit-button\' type=\'submit\' value=\'Submit\' name=\'submit_article\'></input>';

                        if (isset($_REQUEST['submit_article'])) {
                            // Purpose: Used to check if the article is valid.
                            include_once('PHP Scripts/Form-Validation.php');

                            if (validate_article()) {
                                // Purpose: Used to insert article into database.
                                include_once('PHP Scripts/Database-Handler.php');

                                $column_names = 'article_author_id, article_title, article_text, article_publish_datetime';

                                $values_clause = ':article_author_id, :article_title, :article_text, :article_publish_datetime';
                                
                                $data = [
                                    'article_author_id' => $_SESSION['user_id'],
                                    'article_title' => $_POST['article_title'],
                                    'article_text' => nl2br($_POST['article_text']),
                                    'article_publish_datetime' => date('Y-m-d H:i:s')
                                ];

                                if (insert('articles', $column_names, $values_clause, $data)) {
                                    echo '<p class=\'centered-text\'> Successfully submitted article. </p>';
                                    if (isset($_POST['article_tags'])) {
                                        // Will probably insert tags for the wrong article if the user has posted 2 identical articles.
                                        $column_names = 'article_id';
                                        $table = 'articles';
                                        $where_clause = 'article_author_id = :article_author_id AND article_title = :article_title AND article_text = :article_text';
                                        $where_values = [
                                            'article_author_id' => $_SESSION['user_id'],
                                            'article_title' => $_POST['article_title'],
                                            'article_text' => nl2br($_POST['article_text']),
                                        ];
                                        $fetch_multiple_rows = false;
                                        $order_by_column = 'article_publish_datetime';
                                        $order_by_direction = 'DESC';

                                        $article_id = select($column_names, $table, $where_clause, $where_values, $fetch_multiple_rows, $order_by_column, $order_by_direction);
                                        $column_names = 'article_id, tag_id';
                                        $values_clause = ':article_id, :tag_id';

                                        foreach ($_POST['article_tags'] as $tag_id) {
                                            $data = [
                                                'article_id' => $article_id['article_id'],
                                                'tag_id' => $tag_id,
                                            ];
    
                                            insert('article_tags', $column_names, $values_clause, $data);
                                        }
                                    }
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