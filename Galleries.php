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
        <title> Galleries </title>
    </head>

    <body>
        <div class='centered-column pixel-text'>
            <form method='GET'>
                <h1 class='centered-text'><a id= 'compose-article-link' href='/The Augmented Eye/Compose-Gallery'> Compose Gallery 📷 </a></h1>
                <fieldset>
                    <div class='toolbar'>
                        <div class='limiter'>
                            <label for='row_limit_articles_combobox'> Show: </label>
                            <select id='row_limit_articles_combobox' name='row_limit'>
                                <?php
                                    if (isset($_GET['row_limit'])) {
                                        echo '<option disabled selected value=' . $_GET['row_limit'] . '>' . $_GET['row_limit'] . '</option>';
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
                            <label for='order_by_combobox'> Sort: </label>
                            <select id='order_by_combobox' name='order_by'> 
                                <?php
                                    if (isset($_GET['order_by'])) {
                                        switch ($_GET['order_by']) {
                                            case 'gallery_title':
                                                echo '<option disabled selected value=\'gallery_title\'> By Title </option>';
                                                break;
                                            case 'gallery_publish_datetime':
                                                echo '<option disabled selected value=\'gallery_publish_datetime\'> By Date </option>';
                                                break;
                                            case 'gallery_view_count':
                                                echo '<option disabled selected value=\'gallery_view_count\'> By Views </option>';
                                                break;
                                            default:
                                                unset($_GET['order_by']);
                                                echo '<option disabled selected> SORT ARTICLES HERE </option>';
                                                break;
                                        }
                                    } else {
                                        echo '<option disabled selected> SORT ARTICLES HERE </option>';
                                    }
                                ?>
                                <option value='gallery_title'> By Title </option> 
                                <option value='gallery_publish_datetime'> By Date </option> 
                                <option value='gallery_view_count'> By Views </option> 
                                <!-- <option value='article_author_id'> By Author </option>  -->
                            </select>
                            <br>
                            <br>
                            <label for='order_by_direction_combobox'> Sort Direction: </label>
                            <select id='order_by_direction_combobox' name='order_by_direction'> 
                                <?php
                                    if (isset($_GET['order_by_direction'])) {
                                        switch ($_GET['order_by_direction']) {
                                            case 'ASC':
                                                echo '<option disabled selected value=\'ASC\'> Ascending </option>';
                                                break;
                                            case 'DESC':
                                                echo '<option disabled selected value=\'DESC\'> Descending </option>';
                                                break;
                                            default:
                                                unset($_GET['order_by_direction']);
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
                        isset($_GET['order_by'])           ? $order_by_column = $_GET['order_by']              : $order_by_column = 'gallery_publish_datetime';
                        isset($_GET['order_by_direction']) ? $order_by_direction = $_GET['order_by_direction'] : $order_by_direction = 'DESC';
                        isset($_GET['row_limit'])          ? $row_limit = $_GET['row_limit']                   : $row_limit = 50;

                        // Purpose: Used to display article links.
                        include_once 'PHP Scripts/Display Handlers/Gallery-Display-Handler.php'; 

                        show_gallery_links($order_by_column, $order_by_direction, $row_limit);
                    ?>
                </div>
            </form>
        </div>
    </body>
</html>