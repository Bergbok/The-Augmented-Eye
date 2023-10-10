<!-- 
    Filename: News.php
    Author: Albertus Cilliers   
    Description: Displays article links based on sorting/filtering options.
 -->

<?php 
    // Purpose: Displays header.
    include_once 'Header.php'; 
?>

<html>
    <head>
        <title> News </title>
    </head>

    <body>
        <div class='centered-column pixel-text'>
            <form method='GET'>
                <h1 class='centered-text'><a id= 'compose-article-link' href='/The Augmented Eye/Compose-Article'> Compose Article 📝 </a></h1>
                <fieldset>
                    <div class='toolbar'>
                        <div class='limiter'>
                            <label for='row-limit-articles-combobox'> Show: </label>
                            <select id='row-limit-articles-combobox' name='row-limit'>
                                <?php
                                    if (isset($_GET['row-limit'])) {
                                        echo '<option disabled selected value=' . $_GET['row-limit'] . '>' . $_GET['row-limit'] . '</option>';
                                    } else {
                                        echo '<option disabled selected>LIMIT AMOUNT OF ARTICLES HERE</option>';
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
                            <label for='order-by-combobox'> Sort: </label>
                            <select id='order-by-combobox' name='order-by'> 
                                <?php
                                    if (isset($_GET['order-by'])) {
                                        switch ($_GET['order-by']) {
                                            case 'articleTitle':
                                                echo '<option disabled selected value=\'articleTitle\'> By Title </option>';
                                                break;
                                            case 'articlePublishDate':
                                                echo '<option disabled selected value=\'articlePublishDate\'> By Date </option>';
                                                break;
                                            case 'articleViews':
                                                echo '<option disabled selected value=\'articleViews\'> By Views </option>';
                                                break;
                                            default:
                                                unset($_GET['order-by']);
                                                echo '<option disabled selected> SORT ARTICLES HERE </option>';
                                                break;
                                        }
                                    } else {
                                        echo '<option disabled selected> SORT ARTICLES HERE </option>';
                                    }
                                ?>
                                <option value='articleTitle'> By Title </option> 
                                <option value='articlePublishDate'> By Date </option> 
                                <option value='articleViews'> By Views </option> 
                                <!-- <option value='articleAuthorID'> By Author </option>  -->
                            </select>
                            <br>
                            <br>
                            <label for='order-by-direction-combobox'> Sort Direction: </label>
                            <select id='order-by-direction-combobox' name='order-by-direction'> 
                                <?php
                                    if (isset($_GET['order-by-direction'])) {
                                        switch ($_GET['order-by-direction']) {
                                            case 'ASC':
                                                echo '<option disabled selected value=\'ASC\'> Ascending </option>';
                                                break;
                                            case 'DESC':
                                                echo '<option disabled selected value=\'DESC\'> Descending </option>';
                                                break;
                                            default:
                                                unset($_GET['order-by-direction']);
                                                echo '<option disabled selected>CHANGE SORT DIRECTION HERE</option>';
                                                break;
                                        }
                                    } else {
                                        echo '<option disabled selected>CHANGE SORT DIRECTION HERE</option>';
                                    }
                                ?>
                                <option value='ASC'> Ascending </option> 
                                <option value='DESC'> Descending </option> 
                            </select>
                        </div>
                        <br>
                        <input class='submit-button' type='submit' value='Sort'></input>
                    </div>
                </fieldset>

                <br>
                <!-- <hr> -->
                <br>

                <div id='article-list' class='centered-text'>
                    <?php
                        isset($_GET['order-by'])           ? $order_by_column = $_GET['order-by']              : $order_by_column = 'articlePublishDate';
                        isset($_GET['order-by-direction']) ? $order_by_direction = $_GET['order-by-direction'] : $order_by_direction = 'DESC';
                        isset($_GET['row-limit'])          ? $row_limit = $_GET['row-limit']                   : $row_limit = 50;

                        // Purpose: Used to display article links.
                        include_once 'PHP Scripts/Article-Display-Handler.php'; 

                        show_article_links($order_by_column, $order_by_direction, $row_limit);
                    ?>
                </div>
            </form>
        </div>
    </body>
</html>