<?php 
    // Purpose: Displays header.
    include_once 'Header.php'; 
?>

<html>
    <body>
        <?php
            if (isset($_GET['profileID'])) {
                // Purpose: Used to select user information for display on profile.
                include_once 'PHP Scripts/Database-Selects.php'; 

                $where_clause = 'userID = :id';
                $where_values = [
                    'id' => $_GET['profileID']
                ];

                $user_info = select_user($where_clause, $where_values);

                !empty($user_info) ? $user_exists = true : $user_exists = false;

                if ($user_exists) {
                    show_profile_info($user_info);
                } else {
                    show_profile_not_found();
                } 
            } else {
                show_profile_not_found();
            }

            function show_profile_info(array $user_info): void {
                echo '<title> ' . $user_info['userName'] . ' ' . $user_info['userSurname'] . '\'s Profile </title>';
                echo '<div class=\'centered-column centered-text pixel-text\'>';
                echo '  <form type=\'POST\'>';
                echo '      <h1> ' . $user_info['userName'] . ' ' . $user_info['userSurname'] . '\'s Profile </h1>';
                echo '      <p> Date Joined: ' . $user_info['userRegistrationDate'] . ' </p>';
                echo '      <br>';
                echo '      <p> Birthday: ' . $user_info['userBirthday'] . ' </p>';
                echo '      <p> Gender: ' . $user_info['userGender'] . ' </p>';
                echo '      <br>';
                echo '      <p> Contact Number: <a href=\'tel: ' . $user_info['userContactNo'] . '\'>' . $user_info['userContactNo'] . '</a> </p>';
                echo '      <p> Email: <a href=\'mailto: ' . $user_info['userEmail'] . '\'>' . $user_info['userEmail'] . '</a> </p>';
                echo '      <br>';
                if ($user_info['userSubscribedToNewsletter']) {
                    echo '  <p> This user is subscribed to the newsletter 💌 </p>';
                } else {
                    echo '  <p> This user isn\'t subscribed to the newsletter :( </p>';
                }
                echo '      <br>';

                // Purpose: Used to check if profile belongs to currently logged in user.
                include_once 'PHP Scripts/Login-Handler.php'; 

                if (is_logged_in()) {
                    if ($_GET['profileID'] == $_SESSION['userID']) {
                        echo '<div class=\'article-link\'>';
                        echo '  <a class=\'dark-text\' href=\'/The Augmented Eye/Change-Password\'> Change Password </a>';
                        echo '  <br><br>';
                        echo '  <a class=\'dark-text\' href=\'/The Augmented Eye/Logout\'>Logout</a>';
                        echo '</div>';
                    }
                }
                echo '  </form>';
                echo '</div>';
            }
            function show_profile_not_found(): void {
                echo '<h1 class=\'centered-text bright-text pixel-text\'> User not found :( </h1>';
            }
        ?>
    </body>

</html>