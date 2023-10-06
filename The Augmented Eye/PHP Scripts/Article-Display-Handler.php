<?php
    function echoArticleInfo($articleInfo) {
        $article_author_name = getUserNameFromArticleID($articleInfo["articleID"]);
        $article_author_surname = getUserSurnameFromArticleID($articleInfo["articleID"]);
        echo "<title> ".$articleInfo["articleTitle"]." </title>";
        echo "<div class='centered-column pixel-text'>";
        echo "  <div class='article-header'>";
        echo "      <h1 align=left>".$articleInfo["articleTitle"]."</h1>";
        echo "      <h2 align=left> By: <a href='/The Augmented Eye/Profile.php?profileID=".$articleInfo["articleAuthorID"]."'>".$article_author_name." ".$article_author_surname."</a></h2>";
        echo "      <h3 align=left> Published @ ".$articleInfo["articlePublishDate"]." (UTC)</h3>";
        echo "      <h4 align=left> Views: ".$articleInfo["articleViews"]."</h4>";
        echo "  </div>";
        echo "  <p class='article-text'>".$articleInfo["articleContent"]."</p>";
        echo "  <script type='text/javascript' src='/The Augmented Eye/JavaScript/copyToClipboard.js'></script>"; 
        include_once("getCurrentPageInfo.php"); 
        $url = getCurrentPageInfo("url");    
        echo "  <button class='submit-button' id='share-button' onclick='copyToClipboard(\"".$url."\")'>Copy Link</button>";
        echo "</div>";
    }

    function echoArticleNotFound() {
        echo "<h1 class='centered-text bright-text pixel-text'> Article not found :( </h1>";
    }

    function echoArticleLinks($order_by_column, $order_by_direction, $row_limit) {
        $show_article_info = false;
        include_once('Database-Selects.php'); 

        foreach (selectAllArticles($order_by_column, $order_by_direction, $row_limit) as $rows) {
            if ($show_article_info) {
                echo "Row Info: <br>";
                print_r($rows);
                echo "<br><br>";
            }

            unset($article_ID, $article_title, $article_author);

            foreach ($rows as $column => $value) {
                if ($show_article_info) {
                    echo 'Column: '.$column.' <br> Value:'.$value.'<br><br>';
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
                echo "<a class='article-link' href='/The Augmented Eye/Article.php?viewArticle=".$article_ID."'>".$article_title."</a>";
                // $article_author_name = getUserNameFromID($article_author_ID);
                // $article_author_surname = getUserSurnameFromID($article_author_ID);
                // echo "<a class='no-decor-link' style='font-size: 1.25vw'> by </a>";
                // echo "<a class='article-link' href='/The Augmented Eye/Profile.php?profileID=".$article_author_ID."'> ".$article_author_name." ".$article_author_surname."</a>";
                echo "<br>";
                echo "<br>";
                echo "<hr>";
                echo "<br>";
            }
        }
    }
?>