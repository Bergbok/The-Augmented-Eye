<?php

/**
 * Filename: About.php
 * Author: Albertus Cilliers  
 * Description: Handles displaying article links & pages.
 */

// Purpose: Used to select articles.
include_once dirname(__DIR__) . '/Database-Handler.php'; 
// Purpose: Used to get gallery images.
include_once dirname(__DIR__) . '/FTP-Handler.php'; 

function show_gallery_info(array $gallery_info): void {
    $author_name = get_gallery_author_name($gallery_info['gallery_author_id'],'full');

    echo '<title> ' . $gallery_info['gallery_title'] . ' </title>';
    echo '<div class=\'centered-column pixel-text\'>';
    echo '  <article>';
    echo '      <div class=\'article-header\'>';
    echo '          <h1 align=left>' . $gallery_info['gallery_title'] . '</h1>';
    echo '          <h2 align=left> By: <a href=\'/The Augmented Eye/Profile?profileID=' . $gallery_info['gallery_author_id'] . '\'>' . $author_name . '</a></h2>';
    echo '          <h3 align=left> Published @ ' . $gallery_info['gallery_publish_datetime'] . '</h3>';
    echo '          <h4 align=left> Views: ' . $gallery_info['gallery_view_count'] . '</h4>';
    echo '      </div>';
    echo '  </article>';

    show_gallery_images($gallery_info);
}

function show_gallery_not_found(): void {
    echo '<h1 class=\'centered-text bright-text pixel-text\'> Gallery not found :( </h1>';
}

function show_gallery_images(array $gallery_info): void {
    $gallery_id = $gallery_info['gallery_id'];

    $image_list = get_gallery_image_list('/Galleries/' . $gallery_id);

    echo '<div class=\'center\'>';

    foreach ($image_list as $image_name) {
        // echo 'GET REQUEST: ?gallery_id=' . $gallery_id . '&image_name=' . $image_name . '<br>';
        echo '<img src=\'/The Augmented Eye/PHP Scripts/Get-Gallery-Picture?gallery_id=' . $gallery_id . '&image_name=' . $image_name . '\'></img>';
        echo '<br>';
    }

    echo '</div>';
}

function show_gallery_links(string $order_by_column, string $order_by_direction, int $row_limit): void {
    $include_article_author_in_link = false;
    $show_select_info = false;

    $columns = '*';
    $table = 'galleries';
    $fetch_multiple_rows = true;

    $galleries = select($columns, $table, '', [], $fetch_multiple_rows, $order_by_column, $order_by_direction, $row_limit);

    foreach ($galleries as $rows) {
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
                case 'gallery_id':
                    $gallery_id = $value;
                    break;
                case 'gallery_title':
                    $gallery_title = $value;
                    break;
                case 'gallery_author_id':
                    $gallery_author_id = $value;
                    break;
                default:
                    # code...
                    break;
            }
        }

        if (isset($gallery_id, $gallery_title, $gallery_author_id)){
            echo '<a class=\'article-link\' href=\'/The Augmented Eye/Gallery?viewGallery=' . $gallery_id . '\'>' . $gallery_title . '</a>';

            if ($include_article_author_in_link) {
                $article_author_name = get_gallery_author_name($gallery_id, 'full');
                echo '<a class=\'no-decor-link\' style=\'font-size: 1.25vw\'> by </a>';
                echo '<a class=\'article-link\' href=\'/The Augmented Eye/Profile?profileID=\'' . $gallery_author_id . '\'>' . $article_author_name . '</a>';
            }

            echo '<br>';
            echo '<br>';
            echo '<hr>';
            echo '<br>';
        }
    }
}

// EOF
