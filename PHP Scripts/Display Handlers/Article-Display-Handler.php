<?php

/**
 * Filename: About.php
 * Author: Albertus Cilliers  
 * Description: Handles displaying article pages & links.
 */

// Purpose: Used to select articles.
include_once dirname(__DIR__) . '/Database-Handler.php'; 

/**
 * Displays article
 * @param array $article_info Array of article row selected from the database
 * 
 * @return void
 */
function show_article_info(array $article_info): void {
    $author_name = get_article_author_name($article_info['article_author_id'],'full');

    echo '<title> ' . $article_info['article_title'] . ' </title>';
    echo '<div class=\'centered-column pixel-text\'>';
    echo '  <article>';
    echo '      <div class=\'article-header\'>';
    echo '          <h1 align=left>' . $article_info['article_title'] . '</h1>';
    echo '          <h2 align=left> By: <a href=\'/The Augmented Eye/Profile?profileID=' . $article_info['article_author_id'] . '\'>' . $author_name . '</a></h2>';
    echo '          <h3 align=left> Published @ ' . $article_info['article_publish_datetime'] . '</h3>';
    echo '          <h4 align=left> Views: ' . $article_info['article_view_count'] . '</h4>';
    echo '      </div>';
    echo '      <p class=\'article-text\'>' . $article_info['article_text'] . '</p>';
    echo '  </article>';

    show_article_tags($article_info['article_id']);

    echo '<hr>';
    echo '<br>';

    show_article_sharing_options();

    echo '<br>';

    show_article_comment_section($article_info['article_id']);

    echo '</div>';
}

/**
 * Displays a message if no articles are found for provided article ID.
 * @return void
 */
function show_article_not_found(): void {
    echo '<h1 class=\'centered-text bright-text pixel-text\'> Article not found :( </h1>';
}

/**
 * Displays tags of article
 * @param string $article_id 
 * 
 * @return void
 */
function show_article_tags(string $article_id): void {
    $columns = 'tag_id';
    $table = 'article_tags';
    $where_clause = 'article_id = :article_id';
    $where_values = ['article_id' => $article_id];
    $fetch_multiple_rows = true;

    $tag_ids = select($columns, $table, $where_clause, $where_values, $fetch_multiple_rows);

    $tag_names = null;

    foreach ($tag_ids as $rows) {
        foreach ($rows as $column_name => $tag_id) {
            $columns = 'tag_name';
            $table = 'tags';
            $where_clause = 'tag_id = :tag_id';
            $where_values = ['tag_id' => $tag_id];
            $fetch_multiple_rows = true;
        
            $tag_id_names = select($columns, $table, $where_clause, $where_values, $fetch_multiple_rows);

            foreach ($tag_id_names as $rows) {
                $tag_names .= '<a href=\'News?tag=' . $rows['tag_name'] . '\'>' . $rows['tag_name'] . '</a>, ';
            }
        }
    }

    if ($tag_names != null) {
        echo '<p class=\'left-aligned-text\'> Tags: ' . rtrim($tag_names, ', ') . '</p>';   
    }
}

/**
 * Displays buttons for sharing article links.
 * @return void
 */
function show_article_sharing_options(): void {
    // Purpose: Used to get current page URL for sharing articles.
    include_once dirname(__DIR__) . '/Current-Page-Info.php'; 
    $url = get_current_page_info('url'); 
    $use_addtoany_share = true;
    
    if ($use_addtoany_share) {
        echo '<!-- AddToAny BEGIN -->';
        echo '<div class=\'share-buttons\'>';
        echo '  <a href=\'https://www.addtoany.com/add_to/copy_link?linkurl=' . $url . '&amp;linkname=\' target=\'_blank\'><img id=\'copy-link\' src=\'https://static.addtoany.com/buttons/link.svg\'></a>';
        echo '  <a href=\'https://www.addtoany.com/add_to/email?linkurl=' . $url . '&amp;linkname=\' target=\'_blank\'><img id=\'email\' src=\'https://static.addtoany.com/buttons/email.svg\'></a>';
        echo '  <a href=\'https://www.addtoany.com/add_to/sms?linkurl=' . $url . '&amp;linkname=\' target=\'_blank\'><img id=\'sms\' src=\'https://static.addtoany.com/buttons/sms.svg\'></a>';
        echo '  <a href=\'https://www.addtoany.com/add_to/whatsapp?linkurl=' . $url . '&amp;linkname=\' target=\'_blank\'><img id=\'whatsapp\' src=\'https://static.addtoany.com/buttons/whatsapp.svg\'></a>';
        echo '  <a href=\'https://www.addtoany.com/add_to/telegram?linkurl=' . $url . '&amp;linkname=\' target=\'_blank\'><img id=\'telegram\' src=\'https://static.addtoany.com/buttons/telegram.svg\'></a>';
        echo '  <a href=\'https://www.addtoany.com/add_to/reddit?linkurl=' . $url . '&amp;linkname=\' target=\'_blank\'><img id=\'reddit\' src=\'https://static.addtoany.com/buttons/reddit.svg\'></a>';
        echo '  <a href=\'https://www.addtoany.com/add_to/microsoft_teams?linkurl=' . $url . '&amp;linkname=\' target=\'_blank\'><img id=\'teams\' src=\'https://static.addtoany.com/buttons/microsoft_teams.svg\'></a>';
        echo '</div>';
        echo '<!-- AddToAny END -->';
    } else {
        echo '  <script type=\'text/javascript\' src=\'/The Augmented Eye/JavaScript/copyToClipboard.js\'></script>';    
        echo '  <button class=\'submit-button\' id=\'share-button\' onclick=\'copyToClipboard(\'' . $url . '\')\'>Copy Link</button>';
    }
}

/**
 * Displays article comment section
 * @param int $article_id
 * 
 * @return void
 */
function show_article_comment_section(int $article_id): void {
    echo '<h2 class=\'centered-text\'> Comments: </h2>';

    // Displays comment posting elements.
    if (isset($_SESSION['logged_in'])) {
        echo '<form method=\'POST\'>';
        echo '<fieldset>';
        echo '<legend class=\'center\'><strong> Comment as: ' . $_SESSION['user_name'] . '</strong></legend>';
        echo '<textarea required name=\'new_comment_text\'></textarea>';
        echo '<input type=\'submit\' class=\'submit-button\' value=\'POST\' name=\'post_comment\'></input>';
        echo '</fieldset>';
        echo '</form>';
    } else {
        echo '<p class=\'centered-text\'> Login to be able to comment. </p>';
        echo '<p class=\'centered-text\'><a class=\'dark-text\' href=\'/The Augmented Eye/Login\'> LOGIN </a></p>';
    }

    $columns = '*';
    $table = 'comments';
    $where_clause = 'article_id = :article_id';
    $where_values = ['article_id' => $_GET['viewArticle']];
    $fetch_multiple_rows = true;
    $order_by_column = 'comment_post_datetime';
    $order_by_direction = 'DESC';

    $post_comments = select($columns, $table, $where_clause, $where_values, $fetch_multiple_rows, $order_by_column, $order_by_direction);

    !empty($post_comments) ? $has_comments = true : $has_comments = false;

    if (!$has_comments) {
       echo '<p class=\'centered-text\'> This article has no comments, be the first to post one! </p>';
    } else {
        foreach ($post_comments as $comment) {
            $poster_info = get_comment_poster_info($comment['comment_poster_id']);
            echo '<fieldset>';
            echo '<img class=\'pfp-preview comment\' src=\'/The Augmented Eye/PHP Scripts/Get-Profile-Picture?user_id=' . $poster_info['user_id'] . '\'>'; 
            echo '<h3 align=left> &nbsp;By: <a href=\'/The Augmented Eye/Profile?profileID=' . $poster_info['user_id'] . '\'>' . $poster_info['user_name'] . ' ' . $poster_info["user_surname"] . '</a></h3>';
            $time_ago = time_ago(time() - strtotime($comment['comment_post_datetime']));
            if ($time_ago != '') {
                echo '<h4> Posted @ ' . $comment['comment_post_datetime'] . '<br> (' . $time_ago . ' ago)</h4>'; 
            } else {
                echo '<h4> Posted @ ' . $comment['comment_post_datetime'] . '<br> (posted very recently)</h4>'; 
            }
            echo '<br>';
            echo '<p>' . $comment['comment_text'] . '</p>';
            echo '<br>';
            echo '</fieldset>';
        }
    }
}

/**
 * Displays human readble time
 * @param int $timestamp Time in seconds
 * 
 * @return string Returns string in format of X day(s) X hour(s) X minute(s) X second(s)
 */
function time_ago(int $timestamp): string {
    $periods = array('day' => 86400, 'hour' => 3600, 'minute' => 60, 'second' => 1);
    $timeago = '';

    foreach($periods as $period_alias => $seconds){
        $num_of_periods_elapsed = floor($timestamp / $seconds);
        $timestamp -= ($num_of_periods_elapsed * $seconds);

        if ($num_of_periods_elapsed > 1) {
            $timeago .= $num_of_periods_elapsed . ' ' . $period_alias . 's ';
        }
    }

    return trim($timeago);
}

/**
 * Shows links for articles based on sorting order
 * @param string $order_by_column What column in the articles table to sort based off (valid values: article_id, article_author_id, article_title, article_text, article_publish_datetime, article_view_count)
 * @param string $order_by_direction What direction to sort (ASC or DESC)
 * @param int $row_limit Max amount of rows to retrieve
 * 
 * @return void
 */
function show_article_links(string $order_by_column, string $order_by_direction, int $row_limit): void {
    $include_article_author_in_link = false;
    $show_select_info = false;

    // Selects articles
    $columns = '*';
    $table = 'articles';
    $fetch_multiple_rows = true;

    $articles = select($columns, $table, '', [], $fetch_multiple_rows, $order_by_column, $order_by_direction, $row_limit);

    foreach ($articles as $rows) {
        if ($show_select_info) {
            echo 'Row Info: <br>';
            print_r($rows);
            echo '<br><br>';
        }

        unset($article_id, $article_title, $article_author);

        foreach ($rows as $column => $value) {
            if ($show_select_info) {
                echo 'Column: ' . $column . ' <br> Value:' . $value . '<br><br>';
            } 
            
            switch ($column) {
                case 'article_id':
                    $article_id = $value;
                    break;
                case 'article_title':
                    $article_title = $value;
                    break;
                case 'article_author_id':
                    $article_author_id = $value;
                    break;
                default:
                    # code...
                    break;
            }
        }

        if (isset($article_id, $article_title, $article_author_id)){
            echo '<a class=\'article-link\' href=\'/The Augmented Eye/Article?viewArticle=' . $article_id . '\'>' . $article_title . '</a>';
            if ($include_article_author_in_link) {
                $article_author_name = get_article_author_name($article_id, 'full');
                echo '<a class=\'no-decor-link\' style=\'font-size: 1.25vw\'> by </a>';
                echo '<a class=\'article-link\' href=\'/The Augmented Eye/Profile?profileID=\'' . $article_author_id . '\'>' . $article_author_name . '</a>';
            }
            echo '<br>';
            echo '<br>';
            echo '<hr>';
            echo '<br>';
        }
    }
}

// EOF
