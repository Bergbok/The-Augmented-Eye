<?php
    include_once('Header.php'); 
?>

<html>

    <head>

        <title> News </title>
        <link rel="stylesheet" href="styles.css">

    </head>

    <body>
        <div id="" class="centered-column pixel-text">
            <form method="GET">
                <h1 class="centered-text"><a id= "compose_article_link" href="Compose-Article.php"> Compose Article 📝 </a></h1>
                <br>
                <div class='toolbar'>
                    <div class='limiter'>
                        <label for="limit-articles-combobox"> Show: </label>
                        <select id="limit-articles-combobox" name="limit">
                            <?php
                                if (isset($_GET["limit"])) {
                                    echo "<option disabled selected value=".$_GET["limit"].">".$_GET["limit"]."</option>";
                                } else {
                                    echo "<option disabled selected>LIMIT AMOUNT OF ARTICLES HERE</option>";
                                }
                            ?>
                            <option value=10> 10 </option> 
                            <option value=25> 25 </option> 
                            <option value=50> 50 </option> 
                            <option value=100> 100 </option> 
                            <option value=500> 500 </option> 
                        </select>
                    </div>
                    <br>
                    <div class='sorter'>
                        <label for="sort-by-combobox"> Sort: </label>
                        <select id="sort-by-combobox" name="sort-by"> 
                            <?php
                                if (isset($_GET["sort-by"])) {
                                    switch ($_GET["sort-by"]) {
                                        case 'articleTitle':
                                            echo "<option disabled selected value='articleTitle'> By Title </option>";
                                            break;
                                        case 'articlePublishDate':
                                            echo "<option disabled selected value='articlePublishDate'> By Date </option>";
                                            break;
                                        default:
                                            echo "<option disabled selected> SORT ARTICLES HERE </option>";
                                            break;
                                    }
                                } else {
                                    echo "<option disabled selected> SORT ARTICLES HERE </option>";
                                }
                            ?>
                            <option value="articleTitle"> By Title </option> 
                            <option value="articlePublishDate"> By Date </option> 
                            <!-- <option value="articleAuthorID"> By Author </option>  -->
                        </select>
                        <br>
                        <br>
                        <label for="sort-by-direction-combobox"> Sort Direction: </label>
                        <select id="sort-by-direction-combobox" name="sort-by-direction"> 
                            <?php
                                if (isset($_GET["sort-by-direction"])) {
                                    switch ($_GET["sort-by-direction"]) {
                                        case 'ASC':
                                            echo "<option disabled selected value='ASC'> Ascending </option>";
                                            break;
                                        case 'DESC':
                                            echo "<option disabled selected value='DESC'> Descending </option>";
                                            break;
                                        default:
                                            echo "<option disabled selected>CHANGE SORT DIRECTION HERE</option>";
                                            break;
                                    }
                                } else {
                                    echo "<option disabled selected>CHANGE SORT DIRECTION HERE</option>";
                                }
                            ?>
                            <option value="ASC"> Ascending </option> 
                            <option value="DESC"> Descending </option> 
                        </select>
                    </div>
                    <br>
                    <input class="submit-button" type="submit" value="Sort"></input>
                </div>

                <br>
                <!-- <hr> -->
                <br>

                <div id="article-list" class="centered-text">
                    <?php
                        $show_article_info = false;
                        include_once('PHP Scripts/Database-Selects.php'); 

                        isset($_GET["sort-by"]) ? $sort_by = $_GET["sort-by"] : $sort_by = 'articlePublishDate';
                        isset($_GET["sort-by-direction"]) ? $sort_by_direction = $_GET["sort-by-direction"] : $sort_by_direction = 'DESC';
                        isset($_GET["limit"]) ? $limit = $_GET["limit"] : $limit = 50;

                        foreach (selectAllArticles($sort_by, $sort_by_direction, $limit) as $rows) {
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
                                echo "<a class='article-link' href='Article.php?viewArticle=".$article_ID."'>".$article_title."</a>";
                                // $article_author_name = getUserNameFromID($article_author_ID);
                                // $article_author_surname = getUserSurnameFromID($article_author_ID);
                                // echo "<a class='no-decor-link' style='font-size: 1.25vw'> by </a>";
                                // echo "<a class='article-link' href='Profile.php?profileID=".$article_author_ID."'> ".$article_author_name." ".$article_author_surname."</a>";
                                echo "<br>";
                                echo "<br>";
                                // echo "<hr>";
                                echo "<br>";
                            }

                            // hmmmmm
                            if (isset($_GET["viewArticle"])) {
                                echo $_GET["viewArticle"];
                            } 
                        }
                    ?>
                </div>
            </form>
        </div>
    </body>

</html>