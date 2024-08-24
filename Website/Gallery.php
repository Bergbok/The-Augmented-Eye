<!-- 
    Filename: Gallery.php
    Author: Albertus Cilliers   
    Description: Shows gallery information (title, author, publish date, viewcount, body & images)
 -->

<?php 
    // Purpose: Displays header.
    include_once 'Header.php'; 
?>

<html>
    <body>
        <?php
            // Purpose: Used to display gallery.
            include_once 'PHP Scripts/Display Handlers/Gallery-Display-Handler.php'; 

            if (isset($_GET['viewGallery'])) {
                // Purpose: Used to get gallery info.
                include_once 'PHP Scripts/Database-Handler.php'; 

                $columns = '*';
                $table = 'galleries';
                $where_clause = 'gallery_id = :id';
                $where_values = [
                    'id' => $_GET['viewGallery']
                ];
            
                $gallery_info = select($columns, $table, $where_clause, $where_values);

                !empty($gallery_info) ? $gallery_exists = true : $gallery_exists = false;

                if ($gallery_exists) {
                    show_gallery_info($gallery_info);
                    // Purpose: Used to increment the gallery view count.
                    include_once 'PHP Scripts/Database-Handler.php'; 
                    increment_gallery_view_count($_GET['viewGallery']);
                } else {
                    show_gallery_not_found();
                } 
            } else {
                show_gallery_not_found();
            }
        ?>
    </body>
</html>