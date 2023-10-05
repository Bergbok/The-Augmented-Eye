<?php
    include_once('Header.php'); 
?>

<html>

    <head>

        <title> TITLE-GOES-HERE </title>
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
                    $article_author_name = getUserNameFromArticleID($articleInfo["articleID"]);
                    $article_author_surname = getUserSurnameFromArticleID($articleInfo["articleID"]);
                    echo "<div class='center pixel-text'>";
                    echo "  <form>";
                    echo "      <div class='article-header'>";
                    echo "          <h1 align=left><strong>".$articleInfo["articleTitle"]."</strong></h1>";
                    echo "          <h2 align=left><strong> By: <a href='Profile.php?profileID=".$articleInfo["articleAuthorID"]."'>".$article_author_name." ".$article_author_surname."</a></strong></h2>";
                    echo "          <h3 align=left><strong> Published @ ".$articleInfo["articlePublishDate"]." (UTC) </a></strong></h2>";
                    echo "      </div>";
                    echo "      <p class='article'>".$articleInfo["articleContent"]."</p>";
                    echo "  </form>";
                    echo "</div>";
                }else {
                    echo "<div class='center pixel-text'>";
                    echo "  <form>";
                    echo "      <h1><strong> Article not found :( </strong></h1>";
                    echo "  </form>";
                    echo "</div>";
                } 
            }
        ?>
        
    </body>

</html>