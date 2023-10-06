<?php
    include_once('Header.php'); 
?>

<html>

    <head>

        <link rel="stylesheet" href="styles.css">

    </head>

    <body>
        <?php
            include_once('PHP Scripts/Article-Display-Handler.php'); 
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
        ?>
        
    </body>

</html>