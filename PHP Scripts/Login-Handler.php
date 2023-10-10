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
    $table = 'Users';
    $where_clause = 'userEmail = :email AND userPassword = :password';
    $where_values = [
        'email' => $_POST['user_Email'],
        'password' => $_POST['user_Password'],
    ];

    $user_info = select($columns, $table, $where_clause, $where_values);
    // $user_info = select_user($where_clause, $where_values);

    !empty($user_info) ? $user_exists = true : $user_exists = false;

    if ($user_exists) {
        //print_r($user_info);

        $_SESSION['loggedIn'] = true;
        $_SESSION['loggedInSince'] = date('d-m-y h:i:s');
        $_SESSION['userID'] = $user_info['userID'];
        $_SESSION['userName'] = $user_info['userName'];
        $_SESSION['userSurname'] = $user_info['userSurname'];
        $_SESSION['userGender'] = $user_info['userGender'];
        $_SESSION['userBirthday'] = $user_info['userBirthday'];
        $_SESSION['userEmail'] = $user_info['userEmail'];
        $_SESSION['userContactNo'] = $user_info['userContactNo'];
        $_SESSION['userSubscribedToNewsletter'] = $user_info['userSubscribedToNewsletter'];
        $_SESSION['userProfilePictureFilename'] = $user_info['userProfilePictureFilename'];
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
    (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) ? $is_logged_in=true : $is_logged_in=false;
    return $is_logged_in;
}

function is_admin(): bool {
    if (isset($_SESSION['userID'])) {
        $columns = 'userID';
        $table = 'Admins';
        $where_clause = 'userID = :user_id';
        $where_values = ['user_id' => $_SESSION['userID']];

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