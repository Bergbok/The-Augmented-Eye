<?php
    include_once('Header.php'); 
?>

<html>

    <head>

        <link rel="stylesheet" href="styles.css">

    </head>

    <body>
        <?php
            if (isset($_GET["viewArticle"])) {
                include_once('PHP Scripts/Database-Selects.php'); 
                $where_clause = "articleID = :id";
                $where_values = [
                    'id' => $_GET["viewArticle"]
                ];

                $articleInfo = selectArticle($where_clause, $where_values);

                !empty($articleInfo) ? $articleExists = true : $articleExists = false;

                if ($articleExists) {
                    echoArticleInfo($articleInfo);
                    include_once('PHP Scripts/Database-Updates.php'); 
                    incrementArticleViews($_GET["viewArticle"]);
                } else {
                    echoArticleNotFound();
                } 
            } else {
                echoArticleNotFound();
            }

            function echoArticleInfo($articleInfo) {
                $article_author_name = getUserNameFromArticleID($articleInfo["articleID"]);
                $article_author_surname = getUserSurnameFromArticleID($articleInfo["articleID"]);
                echo "<title> ".$articleInfo["articleTitle"]." </title>";
                echo "<div class='centered-column pixel-text'>";
                echo "  <div class='article-header'>";
                echo "      <h1 align=left>".$articleInfo["articleTitle"]."</h1>";
                echo "      <h2 align=left> By: <a href='Profile.php?profileID=".$articleInfo["articleAuthorID"]."'>".$article_author_name." ".$article_author_surname."</a></h2>";
                echo "      <h3 align=left> Published @ ".$articleInfo["articlePublishDate"]." (UTC)</h3>";
                echo "      <h4 align=left> Views: ".$articleInfo["articleViews"]."</h4>";
                echo "  </div>";
                echo "  <p class='article-text'>".$articleInfo["articleContent"]."</p>";
                echo "</div>";
            }
            function echoArticleNotFound() {
                echo "<h1 class='centered-text bright-text pixel-text'> Article not found :( </h1>";
            }
        ?>
        
    </body>

</html>