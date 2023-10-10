<?php

/**
 * Filename: About.php
 * Author: Albertus Cilliers  
 * Description: Handles file uploading/downloading.
 */

// Purpose: Provides authentication info for connection to FTP server. 
include_once 'FTP-Authentication-Info.php';
function connect_to_ftp_server(): bool | FTP\Connection {
    $show_connection_errors = true;

    // global $ftp_hostname,
    //         $ftp_username,
    //         $ftp_password;
    $ftp_hostname = '127.0.0.1';
    $ftp_username = 'FILEZILLA_USER_NAME';
    $ftp_password = 'FILEZILLA_PASSWORD';

    $ftp_connection = ftp_connect($ftp_hostname);
    $login = ftp_login($ftp_connection, $ftp_username, $ftp_password);

    if (!$ftp_connection) {
        return false;
        if ($show_connection_errors) {
            echo '<p class=\'centered-text error-message\'> Could not connect to FTP server </p>';
        }
    }

    if (!$login) {
        return false;
        if ($show_connection_errors) {
            echo '<p class=\'centered-text error-message\'> Could not login to FTP </p>';
        }
    }

    ftp_pasv($ftp_connection, true);

    return $ftp_connection;
}

function close_ftp_connection(FTP\Connection $ftp_connection): bool {
    if (ftp_close($ftp_connection)) {
        echo '<p class=\'centered-text error-message\'> Closed FTP connection </p>';
        return true;
    } else {
        return false;
    }
}

function is_ftp_dir($ftp_connection, $dir): bool {
    $list = ftp_rawlist($ftp_connection, $dir);
    $is_dir = is_array($list);

    if ($is_dir) {
        return true;
    } else {
        return false;
    }
}

function upload_profile_picture(string $where_clause, array $where_values): bool {
    $is_valid_upload = true;

    $supported_file_types = [
        'image/jpeg',
        'image/png',
        'image/gif'
    ];

    if (!in_array($_FILES['new_profile_picture']['type'], $supported_file_types)) {
        echo '<p class=\'centered-text error-message\'> Filetype not supported </p>';
        $is_valid_upload = false;
    }

    if ($is_valid_upload) {
        include_once 'Database-Selects.php';

        $columns = 'userID';
        $table = 'Users';
    
        $user_info = select($columns, $table, $where_clause, $where_values);

        // $user_info = select_user($where_clause, $where_values);

        !empty($user_info) ? $user_exists = true : $user_exists = false;

        if (!$user_exists) {
            echo '<p class=\'centered-text error-message\'> Couldn\'t set profile picture, user not found </p>';
            $is_valid_upload = false;
        }
    }

    if ($is_valid_upload) {
        $connection = connect_to_ftp_server();

        if (is_bool($connection)) {
            echo '<p class=\'centered-text error-message\'> Couldn\'t establish connection to FTP server. </p>';
            $is_valid_upload = false;
        } else {
            if (!is_ftp_dir($connection, 'Profile Pictures')) {
                ftp_mkdir($connection, 'Profile Pictures');
            }
    
            $remote_filetype = substr($_FILES['new_profile_picture']['type'], strpos($_FILES['new_profile_picture']['type'], '/') + 1);
            $remote_filename = '\Profile Pictures\\' . $user_info['userID'] . '.' . $remote_filetype;
            $local_filename = $_FILES['new_profile_picture']['tmp_name'];
    
            $upload_status = ftp_put($connection, $remote_filename, $local_filename, FTP_BINARY);
    
            if (!$upload_status)  {
                echo '<p class=\'centered-text error-message\'> Could not upload file to: ' . $remote_filename . ' from: '. $local_filename  . '</p>';
                $is_valid_upload = false;
            } else {
                echo "File uploaded";
                include 'Database-Updates.php';

                $set_clause = 'userProfilePictureFilename = :picture_name';

                $where_clause = 'userID = :user_id';

                $data = [
                    'picture_name' => $user_info['userID'] . '.' . $remote_filetype,
                    'user_id' => $user_info['userID']
                ];
                update('Users', $set_clause, $where_clause, $data);
            }
        }
    }

    close_ftp_connection($connection);

    return $is_valid_upload;
}

function update_profile_picture(): bool {
    $where_clause = 'userID = :user_id';
    $where_values = [
        'user_id' => $_SESSION['userID']
    ];

    return upload_profile_picture($where_clause, $where_values);
}

function upload_profile_picture_from_registration($email) {
    // echo 'Full Path: ' . $_FILES['newuser_profile_picture']['full_path'] .'<br>';
    // echo 'Name: ' . $_FILES['newuser_profile_picture']['name'] .'<br>';
    // echo 'Type: ' . $_FILES['newuser_profile_picture']['type'] .'<br>';
    // echo 'Size: ' . $_FILES['newuser_profile_picture']['size'] .'<br>';
    // echo 'Error: ' . $_FILES['newuser_profile_picture']['error'] .'<br>';
    // echo 'Temp Name: ' . $_FILES['newuser_profile_picture']['tmp_name'] .'<br>';

    $where_clause = 'userEmail = :email';
    $where_values = [
        'email' => $email
    ];

    upload_profile_picture($where_clause, $where_values);

    // $supported_file_types = [
    //     'image/jpeg',
    //     'image/png',
    //     'image/gif'
    // ];

    // if (!in_array($_FILES['newuser_profile_picture']['type'], $supported_file_types)) {
    //     echo '<p class=\'centered-text error-message\'> Filetype not supported </p>';
    //     exit();
    // }

    // include_once 'Database-Selects.php';

    // $where_clause = 'userEmail = :email';
    // $where_values = [
    //     'email' => $email
    // ];

    // $user_info = select_user($where_clause, $where_values);

    // !empty($user_info) ? $user_exists = true : $user_exists = false;

    // if (!$user_exists) {
    //     echo '<p class=\'centered-text error-message\'> Couldn\'t set profile picture, user not found </p>';
    //     exit();
    // }

    // $connection = connect_to_ftp_server();

    // if (!is_ftp_dir($connection, 'Profile Pictures')) {
    //     ftp_mkdir($connection, 'Profile Pictures');
    // }

    // $remote_filetype = substr($_FILES['newuser_profile_picture']['type'], strpos($_FILES['newuser_profile_picture']['type'], '/') + 1);
    // $remote_filename = '\Profile Pictures\\' . $user_info['userID'] . '.' . $remote_filetype;
    // $local_filename = $_FILES['newuser_profile_picture']['tmp_name'];

    // $upload_status = ftp_put($connection, $remote_filename, $local_filename, FTP_BINARY);

    // if ($upload_status)  {
    //     echo "File uploaded";
    //     include 'Database-Updates.php';
    //     $data = [
    //         'picture_name' => $user_info['userID'] . '.' . $remote_filetype,
    //         'user_id' => $user_info['userID']
    //     ];
    //     update_user_profile_picture_filename($data);
    // }else{
    //     echo "Could not upload file to: " . $remote_filename . ' from: '. $local_filename;
    // }

    // close_ftp_connection($connection);
}

function get_profile_picture($user_id) {
    include_once 'Database-Selects.php';

    $columns = 'userProfilePictureFilename';
    $table = 'Users';
    $where_clause = 'userID = :user_id';
    $where_values = ['user_id' => $user_id];

    $user_info = select($columns, $table, $where_clause, $where_values);

    !empty($user_info) ? $user_exists = true : $user_exists = false;

    if ($user_exists && $user_info['userProfilePictureFilename'] != null) {
        $picture_filename = $user_info['userProfilePictureFilename'];
    } else {
        $picture_filename = 'pfp-placeholder.png';
    }

    $picture_path = 'Profile Pictures/' . $picture_filename;

    $connection = connect_to_ftp_server();

    ob_start();
    $result = ftp_get($connection, "php://output", $picture_path, FTP_BINARY);
    $binary = ob_get_contents();
    ob_end_clean();

    return $binary;
}

// EOF
