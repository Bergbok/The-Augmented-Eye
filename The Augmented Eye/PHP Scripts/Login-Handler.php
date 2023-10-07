<?php

// Purpose: Used to get user info from database.
include_once 'Database-Selects.php';

function login(): bool {
    $where_clause = 'userEmail = :email AND userPassword = :password';
    $where_values = [
        'email' => $_POST['user_Email'],
        'password' => $_POST['user_Password'],
    ];

    $userInfo = select_user($where_clause, $where_values);

    !empty($userInfo) ? $userExists = true : $userExists = false;

    if ($userExists) {
        //print_r($userInfo);

        $_SESSION['loggedIn'] = true;
        $_SESSION['loggedInSince'] = date('d-m-y h:i:s');
        $_SESSION['userID'] = $userInfo['userID'];
        $_SESSION['userName'] = $userInfo['userName'];
        $_SESSION['userSurname'] = $userInfo['userSurname'];
        $_SESSION['userGender'] = $userInfo['userGender'];
        $_SESSION['userBirthday'] = $userInfo['userBirthday'];
        $_SESSION['userEmail'] = $userInfo['userEmail'];
        $_SESSION['userContactNo'] = $userInfo['userContactNo'];
        $_SESSION['userSubscribedToNewsletter'] = $userInfo['userSubscribedToNewsletter'];
        // $_SESSION[''] = $userInfo[''];
        return true;
    } else {
        return false;
    }
}

function logout(): void {
    session_destroy();
}

function is_logged_in(): bool {
    (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) ? $is_logged_in=true : $is_logged_in=false;
    return $is_logged_in;
}

function is_admin(): bool {
    if (isset($_SESSION['userID'])) {
        !empty(select_admin($_SESSION['userID'])) ? $is_admin=true : $is_admin=false;
        return $is_admin;
    } else {
        return false;
    }
}

// EOF
