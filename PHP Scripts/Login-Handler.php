<?php

/**
 * Filename: About.php
 * Author: Albertus Cilliers  
 * Description: Handles loggin in/out aswell as checking whether the user is logged in and whether the user is an admin.
 */

// Purpose: Used to get user info from database.
include_once 'Database-Selects.php';

function login(): bool {
    $columns = '*';
    $table = 'users';
    $where_clause = 'user_email = :email AND user_password = :password';
    $where_values = [
        'email' => $_POST['user_email'],
        'password' => $_POST['user_password'],
    ];

    $user_info = select($columns, $table, $where_clause, $where_values);
    // $user_info = select_user($where_clause, $where_values);

    !empty($user_info) ? $user_exists = true : $user_exists = false;

    if ($user_exists) {
        //print_r($user_info);

        $_SESSION['logged_in'] = true;
        $_SESSION['logged_in_since'] = date('d-m-y h:i:s');
        $_SESSION['user_id'] = $user_info['user_id'];
        $_SESSION['user_name'] = $user_info['user_name'];
        $_SESSION['user_surname'] = $user_info['user_surname'];
        $_SESSION['user_gender'] = $user_info['user_gender'];
        $_SESSION['user_birthday'] = $user_info['user_birthday'];
        $_SESSION['user_email'] = $user_info['user_email'];
        $_SESSION['user_contact_num'] = $user_info['user_contact_num'];
        $_SESSION['user_subscribed_to_newsletter'] = $user_info['user_subscribed_to_newsletter'];
        $_SESSION['user_profile_picture_filename'] = $user_info['user_profile_picture_filename'];
        // $_SESSION[''] = $user_info[''];
        return true;
    } else {
        return false;
    }
}

function logout(): void {
    session_destroy();
    $_SESSION = [];
}

function is_logged_in(): bool {
    (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) ? $is_logged_in=true : $is_logged_in=false;
    return $is_logged_in;
}

function is_admin(): bool {
    if (isset($_SESSION['user_id'])) {
        $columns = 'user_id';
        $table = 'admins';
        $where_clause = 'user_id = :user_id';
        $where_values = ['user_id' => $_SESSION['user_id']];

        if (!is_bool(select($columns, $table, $where_clause, $where_values))) {
            !empty(select($columns, $table, $where_clause, $where_values)) ? $is_admin=true : $is_admin=false;
            return $is_admin;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

// EOF
