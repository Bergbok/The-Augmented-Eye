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
            if (isset($_GET['profileID'])) {
                // Purpose: Used to select user information for display on profile.
                include_once 'PHP Scripts/Database-Selects.php'; 

                $columns = '*';
                $table = 'Users';
                $where_clause = 'userID = :user_id';
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

            function show_profile_info(array $user_info): void {
                echo '<title> ' . $user_info['userName'] . ' ' . $user_info['userSurname'] . '\'s Profile </title>';
                // echo '<div class=\'centered-column centered-text pixel-text\'>';
                // echo '  <form type=\'POST\'>';
                // echo '      <h1> ' . $user_info['userName'] . ' ' . $user_info['userSurname'] . '\'s Profile </h1>';
                // echo '      <p> Date Joined: ' . $user_info['userRegistrationDate'] . ' </p>';
                // echo '      <br>';
                // echo '      <p> Birthday: ' . $user_info['userBirthday'] . ' </p>';
                // echo '      <p> Gender: ' . $user_info['userGender'] . ' </p>';
                // echo '      <br>';
                // echo '      <p> Contact Number: <a href=\'tel: ' . $user_info['userContactNo'] . '\'>' . $user_info['userContactNo'] . '</a> </p>';
                // echo '      <p> Email: <a href=\'mailto: ' . $user_info['userEmail'] . '\'>' . $user_info['userEmail'] . '</a> </p>';
                // echo '      <br>';
                // if ($user_info['userSubscribedToNewsletter']) {
                //     echo '  <p> This user is subscribed to the newsletter 💌 </p>';
                // } else {
                //     echo '  <p> This user isn\'t subscribed to the newsletter :( </p>';
                // }
                // echo '      <br>';

                // // Purpose: Used to check if profile belongs to currently logged in user.
                // include_once 'PHP Scripts/Login-Handler.php'; 

                // if (is_logged_in()) {
                //     if ($_GET['profileID'] == $_SESSION['userID']) {
                //         echo '<div class=\'article-link\'>';
                //         echo '  <a class=\'dark-text\' href=\'/The Augmented Eye/Change-Password\'> Change Password </a>';
                //         echo '  <br><br>';
                //         echo '  <a class=\'dark-text\' href=\'/The Augmented Eye/Logout\'>Logout</a>';
                //         echo '</div>';
                //     }
                // }
                // echo '  </form>';
                // echo '</div>';
                echo '<div class=\'centered-column centered-text pixel-text\'>';
                echo '<h1> ' . $user_info['userName'] . ' ' . $user_info['userSurname'] . '\'s Profile </h1>';
                echo '<img class=\'pfp-profile\' src=\'/The Augmented Eye/PHP Scripts/Get-Picture?userID=' . $user_info['userID'] . '\'></img>';
                echo '<br><br>';
                echo '<table>';
                echo '  <tr>';
                echo '      <td class=\'right-aligned-text\'><b>Gender:<b></td>';
                echo '      <td>' . $user_info['userGender'] . '</td>';
                echo '  </tr>';
                echo '  <tr>';
                echo '      <td class=\'right-aligned-text\'><b>Birthday:<b></td>';
                echo '      <td>' . $user_info['userBirthday'] . '</td>';
                echo '  </tr>';
                echo '  <tr>';
                echo '      <td class=\'right-aligned-text\'><b>Email:<b></td>';
                echo '      <td>' . $user_info['userEmail'] . '</td>';
                echo '  </tr>';
                echo '  <tr>';
                echo '      <td class=\'right-aligned-text\'><b>Contact Number:<b></td>';
                echo '      <td>' . $user_info['userContactNo'] . '</td>';
                echo '  </tr>';
                echo '  <tr>';
                echo '      <td class=\'right-aligned-text\'><b>Date Joined:<b></td>';
                echo '      <td>' . $user_info['userRegistrationDate'] . '</td>';
                echo '  </tr>';
                echo '</table>';

                show_user_options();
                
            }

            function show_user_options(): void {
                echo '<h2>Options:</h2>';

                echo '<form method=\'POST\'>';
                echo '<fieldset>';
                echo '<legend class=\'center\'><strong>Change Gender</strong></legend>';                        
                echo '<label for=new_Password> New Password </label>';
                echo '<input type=\'text\' name=\'new_Password\'></input>';
                echo '<br><br>';
                echo '<input class=\'submit-button\' type=\'submit\' value=\'Change Password\' name=\'change_password\'></input>';
                echo '</fieldset>';
                echo '</form>';

                echo '<form method=\'POST\'>';
                echo '<fieldset>';
                echo '<legend class=\'center\'><strong>Change Password</strong></legend>';                        
                echo '<label for=new_password> New Password </label>';
                echo '<input type=\'text\' name=\'new_password\'></input>';
                echo '<br><br>';
                echo '<input class=\'submit-button\' type=\'submit\' value=\'Change Password\' name=\'change_password\'></input>';
                echo '</fieldset>';
                echo '</form>';

                include_once 'PHP Scripts/Form-Validation.php';

                if (isset($_REQUEST['change_password'])) {
                    if (validate_password_change()) {
                        // Purpose: Used to update the password.
                        include_once 'PHP Scripts/Database-Updates.php';

                        if (update('Users', 'userPassword = :new_password', 'userID = :userID', ['new_password' => $_POST['new_password'], 'userID' => $_SESSION['userID']])) {
                            echo '<p> Successfully updated password! </p>';
                        } else {
                            echo '<p class=\'error-message\'> Couldn\'t update password </p>';
                        }
                    }
                }

                echo '<form method=\'POST\' enctype="multipart/form-data">';
                echo '<fieldset>';
                echo '<legend class=\'center\'><strong>Change Profile Picture</strong></legend>';
                echo '<input type=\'file\' name=\'new_profile_picture\' style=\'width:100%;\'></input>';
                echo '<br><br>';
                echo '<input class=\'submit-button\' type=\'submit\' value=\'Change Profile Picture\' name=\'change_profile_picture\'></input>';
                echo '</fieldset>';
                echo '</form>';

                if (isset($_REQUEST['change_profile_picture'])) {
                    if (isset($_FILES['new_profile_picture']) && $_FILES['new_profile_picture']['error'] == 0) {
                        // Purpose: Used to update the password.
                        include_once 'PHP Scripts/FTP-Handler.php';

                        if (update_profile_picture()) {
                            echo '<p> Successfully updated profile picture! </p>';
                        } else {
                            echo '<p class=\'error-message\'> Couldn\'t update profile picture </p>';
                        }
                    }
                }

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
                echo '</div>';
            }
            function show_profile_not_found(): void {
                echo '<h1 class=\'centered-text bright-text pixel-text\'> User not found :( </h1>';
            }
        ?>
    </body>

</html>