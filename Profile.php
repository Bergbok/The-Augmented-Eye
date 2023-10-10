<!-- 
    Filename: Profile.php
    Author: Albertus Cilliers   
    Description: Displays user information and user options if the profile belongs to them.
 -->

<?php 
    // Purpose: Displays header.
    include_once 'Header.php'; 
?>

<html>
    <body>
        <?php
            include_once 'PHP Scripts/Display Handlers/Profile-Display-Handler.php';
            if (isset($_GET['profileID'])) {
                // Purpose: Used to select user information for display on profile.
                include_once 'PHP Scripts/Database-Handler.php'; 

                $columns = '*';
                $table = 'users';
                $where_clause = 'user_id = :user_id';
                $where_values = ['user_id' => $_GET['profileID']];
            
                $user_info = select($columns, $table, $where_clause, $where_values);

                !empty($user_info) ? $user_exists = true : $user_exists = false;

                if ($user_exists) {
                    show_profile_info($user_info);
                } else {
                    show_profile_not_found();
                } 
            } else {
                show_profile_not_found();
            }
        ?>
    </body>

</html>