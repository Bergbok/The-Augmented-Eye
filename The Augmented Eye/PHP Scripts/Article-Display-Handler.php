<?php

function show_article_info(array $articleInfo): void {
    // Purpose: Used to get current page URL for sharing articles.
    include_once 'Current-Page-Info.php'; 

    $url = get_current_page_info('url'); 
    $use_addtoany_share = true;
    $articleInfo["articleAuthorName"] = get_author_name_from_article_id($articleInfo['articleID']);
    $articleInfo["articleAuthorSurname"] = get_author_surname_from_article_id($articleInfo['articleID']);

    echo '<title> ' . $articleInfo['articleTitle'] . ' </title>';
    echo '<div class=\'centered-column pixel-text\'>';
    echo '  <div class=\'article-header\'>';
    echo '      <h1 align=left>' . $articleInfo['articleTitle'] . '</h1>';
    echo '      <h2 align=left> By: <a href=\'/The Augmented Eye/Profile?profileID=' . $articleInfo['articleAuthorID'] . '\'>' . $articleInfo["articleAuthorName"] . ' ' . $articleInfo["articleAuthorSurname"] . '</a></h2>';
    echo '      <h3 align=left> Published @ ' . $articleInfo['articlePublishDate'] . ' (UTC)</h3>';
    echo '      <h4 align=left> Views: ' . $articleInfo['articleViews'] . '</h4>';
    echo '  </div>';
    echo '  <p class=\'article-text\'>' . $articleInfo['articleContent'] . '</p>';

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

    echo '</div>';
}

function show_article_not_found(): void {
    echo '<h1 class=\'centered-text bright-text pixel-text\'> Article not found :( </h1>';
}

function show_article_links(string $order_by_column, string $order_by_direction, int $row_limit): void {
    $include_article_author_in_link = false;
    $show_select_info = false;

    // Purpose: Used to select articles.
    include_once 'Database-Selects.php'; 

    foreach (select_all_articles($order_by_column, $order_by_direction, $row_limit) as $rows) {
        if ($show_select_info) {
            echo 'Row Info: <br>';
            print_r($rows);
            echo '<br><br>';
        }

        unset($article_ID, $article_title, $article_author);

        foreach ($rows as $column => $value) {
            if ($show_select_info) {
                echo 'Column: ' . $column . ' <br> Value:' . $value . '<br><br>';
            } 
            
            switch ($column) {
                case 'articleID':
                    $article_ID = $value;
                    break;
                case 'articleTitle':
                    $article_title = $value;
                    break;
                case 'articleAuthorID':
                    $article_author_ID = $value;
                    break;
                default:
                    # code...
                    break;
            }
        }

        if (isset($article_ID, $article_title, $article_author_ID)){
            echo '<a class=\'article-link\' href=\'/The Augmented Eye/Article?viewArticle=' . $article_ID . '\'>' . $article_title . '</a>';
            if ($include_article_author_in_link) {
                $article_author_name = get_author_name_from_article_id($article_ID);
                $article_author_surname = get_author_surname_from_article_id($article_ID);
                echo '<a class=\'no-decor-link\' style=\'font-size: 1.25vw\'> by </a>';
                echo '<a class=\'article-link\' href=\'/The Augmented Eye/Profile?profileID=\'' . $article_author_ID . '\'>' . $article_author_name . ' ' . $article_author_surname . '</a>';
            }
            echo '<br>';
            echo '<br>';
            echo '<hr>';
            echo '<br>';
        }
    }
}

// EOF
