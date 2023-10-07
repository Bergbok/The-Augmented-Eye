<?php
    include_once("Database-Selects.php");
    function logIn() {
        $where_clause = "userEmail = :email AND userPassword = :password";
        $where_values = [
            'email' => $_POST["user_Email"],
            'password' => $_POST["user_Password"],
        ];

        $userInfo = selectUser($where_clause, $where_values);

        !empty($userInfo) ? $userExists = true : $userExists = false;

        if ($userExists) {
            //print_r($userInfo);

            $_SESSION["loggedIn"] = true;
            $_SESSION["loggedInSince"] = date('d-m-y h:i:s');
            $_SESSION["userID"] = $userInfo["userID"];
            $_SESSION["userName"] = $userInfo["userName"];
            $_SESSION["userSurname"] = $userInfo["userSurname"];
            $_SESSION["userGender"] = $userInfo["userGender"];
            $_SESSION["userBirthday"] = $userInfo["userBirthday"];
            $_SESSION["userEmail"] = $userInfo["userEmail"];
            $_SESSION["userContactNo"] = $userInfo["userContactNo"];
            $_SESSION["userSubscribedToNewsletter"] = $userInfo["userSubscribedToNewsletter"];
            // $_SESSION[""] = $userInfo[""];
            return true;
        } else {
            return false;
        }
    }

    function logOut() {
        session_destroy();
    }

    function isLoggedIn() {
        (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == true) ? $isLoggedIn=true : $isLoggedIn=false;
        return $isLoggedIn;
    }

    function isAdmin() {
        if (isset($_SESSION["userID"])) {
            !empty(selectAdmin($_SESSION["userID"])) ? $isAdmin=true : $isAdmin=false;
            return $isAdmin;
        } else {
            return false;
        }
    }
?>