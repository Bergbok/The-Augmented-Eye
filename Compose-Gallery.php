<!-- 
    Filename: 
    Author: Albertus Cilliers   
    Description: 
 -->

 <?php 
    // Purpose: Displays header.
    include_once 'Header.php'; 
?>

<html>

    <head>

        <title> Compose Gallery </title>
        <link rel='stylesheet' href='styles.css'>

    </head>

    <body>
        <div class='centered-column pixel-text'>
            <form method='POST' enctype='multipart/form-data'>
                <fieldset>
                    <?php
                        // Purpose: Used to check if the user is logged in.
                        include_once('PHP Scripts/Login-Handler.php');

                        if (!is_logged_in()){
                            echo '<div class=\'centered-text\'';
                            echo '<p> Login to be able to post. </p>';
                            echo '<a class=\'dark-text\' href=\'/The Augmented Eye/Login\'> LOGIN </a>';
                            echo '</div>';
                        } else {
                            echo '<div class=\'centered-text\'>';
                            echo '<label for=\'name\'>Title:</label>';
                            echo '<input type=\'text\' id=\'titleInput\' name=\'gallery_title\'></input>';
                            echo '<h3> Images: </h1>';
                            echo '</div>';

                            echo '<input class=\'full-width\' type="file" name="gallery_photos[]" multiple/></input>';
                            echo '<br><br>';
                            echo '<input class=\'submit-button\' type=\'submit\' value=\'Upload\' name=\'upload\'></input>';
                        }

                        if (isset($_REQUEST['upload'])) {
                            include_once 'PHP Scripts/Database-Handler.php';

                            $column_names = 'gallery_author_id, gallery_title, gallery_publish_datetime';

                            $values_clause = ':gallery_author_id, :gallery_title, :gallery_publish_datetime';
                            
                            $data = [
                                'gallery_author_id' => $_SESSION['user_id'],
                                'gallery_title' => $_POST['gallery_title'],
                                'gallery_publish_datetime' => date('Y-m-d H:i:s')
                            ];

                            insert('galleries', $column_names, $values_clause, $data);

                            include_once 'PHP Scripts/FTP-Handler.php';

                            $columns = 'gallery_id';
                            $table = 'galleries';
                            $where_clause = 'gallery_author_id = :gallery_author_id';
                            $where_values = [
                                'gallery_author_id' => $_SESSION['user_id']
                            ];
                            $fetch_multiple_rows = false;
                            $order_by_column = 'gallery_publish_datetime';
                            $order_by_direction = 'DESC';
                        
                            $gallery_info = select($columns, $table, $where_clause, $where_values, $fetch_multiple_rows, $order_by_column, $order_by_direction);
                            echo($gallery_info['gallery_id']);

                            upload_gallery($_FILES['gallery_photos'], 'Galleries/' . $gallery_info['gallery_id']);
                        }
                    ?>
                </fieldset>
            </form>
        </div>
    </body>

</html>