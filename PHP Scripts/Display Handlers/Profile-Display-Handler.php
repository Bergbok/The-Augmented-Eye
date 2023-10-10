<?php

function show_profile_info(array $user_info): void {
    echo '<title> ' . $user_info['user_name'] . ' ' . $user_info['user_surname'] . '\'s Profile </title>';

    echo '<div class=\'centered-column centered-text pixel-text\'>';
    echo '<h1> ' . $user_info['user_name'] . ' ' . $user_info['user_surname'] . '\'s Profile </h1>';
    echo '<img class=\'pfp-profile\' src=\'/The Augmented Eye/PHP Scripts/Get-Profile-Picture?user_id=' . $user_info['user_id'] . '\'></img>';
    echo '<br><br>';
    echo '<table>';
    echo '  <tr>';
    echo '      <td class=\'right-aligned-text\'><b>Gender:<b></td>';
    echo '      <td>' . $user_info['user_gender'] . '</td>';
    echo '  </tr>';
    echo '  <tr>';
    echo '      <td class=\'right-aligned-text\'><b>Birthday:<b></td>';
    echo '      <td>' . $user_info['user_birthday'] . '</td>';
    echo '  </tr>';
    echo '  <tr>';
    echo '      <td class=\'right-aligned-text\'><b>Email:<b></td>';
    echo '      <td>' . $user_info['user_email'] . '</td>';
    echo '  </tr>';
    echo '  <tr>';
    echo '      <td class=\'right-aligned-text\'><b>Contact Number:<b></td>';
    echo '      <td>' . $user_info['user_contact_num'] . '</td>';
    echo '  </tr>';
    echo '  <tr>';
    echo '      <td class=\'right-aligned-text\'><b>Date Joined:<b></td>';
    echo '      <td>' . $user_info['user_registration_datetime'] . '</td>';
    echo '  </tr>';
    echo '</table>';

    show_user_options();
    
}

function show_user_options(): void {
    // echo '<form method=\'POST\'>';
    // echo '<fieldset>';
    // echo '<legend class=\'center\'><strong>Change Gender</strong></legend>';                        
    // echo '<label for=new_Password> New Password </label>';
    // echo '<input type=\'text\' name=\'new_Password\'></input>';
    // echo '<br><br>';
    // echo '<input class=\'submit-button\' type=\'submit\' value=\'Change Password\' name=\'change_password\'></input>';
    // echo '</fieldset>';
    // echo '</form>';

    // Purpose: Used to check if profile belongs to currently logged in user.
    include_once dirname(__DIR__) . '/Login-Handler.php'; 

    if (is_logged_in()) {
        if ($_GET['profileID'] == $_SESSION['user_id']) {
            echo '<h2>Options:</h2>';

            echo '<form method=\'POST\'>';
            echo '<fieldset>';
            echo '<legend class=\'center\'><strong>Change Password</strong></legend>';                        
            echo '<label for=new_password> New Password </label>';
            echo '<input required type=\'text\' name=\'new_password\'></input>';
            echo '<br><br>';
            echo '<input class=\'submit-button\' type=\'submit\' value=\'Change Password\' name=\'change_password\'></input>';
            echo '</fieldset>';
            echo '</form>';
        
            if (isset($_REQUEST['change_password'])) {
                // Purpose: Used to validate new password.
                include_once dirname(__DIR__) . '/Form-Validation.php';

                if (validate_password_change()) {
                    // Purpose: Used to update the password.
                    include_once dirname(__DIR__) . '/Database-Handler.php';
        
                    if (update('users', 'user_password = :new_password', 'user_id = :user_id', ['new_password' => $_POST['new_password'], 'user_id' => $_SESSION['user_id']])) {
                        echo '<p> Successfully updated password! </p>';
                    } else {
                        echo '<p class=\'error-message\'> Couldn\'t update password </p>';
                    }
                }
            }
        
            echo '<form method=\'POST\' enctype="multipart/form-data">';
            echo '<fieldset>';
            echo '<legend class=\'center\'><strong>Change Profile Picture</strong></legend>';
            echo '<input required class=\'full-width\' type=\'file\' name=\'new_profile_picture\'></input>';
            echo '<br><br>';
            echo '<input class=\'submit-button\' type=\'submit\' value=\'Change Profile Picture\' name=\'change_profile_picture\'></input>';
            echo '</fieldset>';
            echo '</form>';
        
            if (isset($_REQUEST['change_profile_picture'])) {
                if (isset($_FILES['new_profile_picture']) && $_FILES['new_profile_picture']['error'] == 0) {
                    // Purpose: Used to update users profile picture.
                    include_once dirname(__DIR__) . '/FTP-Handler.php';
        
                    if (update_profile_picture()) {
                        echo '<p> Successfully updated profile picture! </p>';
                    } else {
                        echo '<p class=\'error-message\'> Couldn\'t update profile picture </p>';
                    }
                }
            }
        }
    }

    echo '</div>';
}

function show_profile_not_found(): void {
    echo '<h1 class=\'centered-text bright-text pixel-text\'> User not found :( </h1>';
}

// EOF
