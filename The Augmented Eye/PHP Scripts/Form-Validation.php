<?php
    // include("getCurrentPageInfo.php"); 
    
    // $uri = getCurrentPageInfo("uri");

    // switch (substr($uri, strrpos($uri, '/') + 1)) {
    //     case "Registration.php":
    //         return validateRegistration();
    //         break;
    //     case "Login.php":

    //         break;
        
    //     default:
    //         # code...
    //         break;
    // }

    function validateLogin() {
        $show_login_errors = true;
        $show_provided_login_info = false;

        $user_Email_isvalid = $user_Password_isvalid = false;

        if (isset($_SERVER["REQUEST_METHOD"])){
            if ($_SERVER["REQUEST_METHOD"] == "POST"){                
                if ($show_provided_login_info || $show_login_errors == true) {

                    if (isset($_POST["user_Email"])) {
                        $user_Email_isvalid = true;
                        if ($show_provided_login_info == true){
                            echo '<p class="error-message"> Provided name is: '.$_POST["newuser_Name"].'</p>';
                        }
                    } elseif ($show_login_errors == true) {
                        echo '<p class="error-message"> Please enter your email </p>';   
                    }

                    if (isset($_POST["user_Password"])) {
                        $user_Password_isvalid = true;
                        if ($show_provided_login_info == true){
                            echo '<p class="error-message"> Provided surname is: '.$_POST["newuser_Surname"].'</p>';
                        }
                    } elseif ($show_login_errors == true) {
                        echo '<p class="error-message"> Please enter your password </p>';
                    }
                }
            }
        }

        if ($user_Email_isvalid == true && $user_Password_isvalid == true) {
            return true;
        } else {
            return false;
        }
    }

    //Return true if valid, false if invalid
    function validateRegistration() {
        $show_registration_errors = true;
        $show_provided_registration_info = false;

        $newuser_Name_isvalid = $newuser_Surname_isvalid = $newuser_Gender_isvalid = $newuser_Birthday_isvalid = $newuser_Email_isvalid = $newuser_Contact_isvalid = false;
        
        if (isset($_SERVER["REQUEST_METHOD"])){
            if ($_SERVER["REQUEST_METHOD"] == "POST"){                
                if ($show_provided_registration_info || $show_registration_errors == true) {

                    if (isset($_POST["newuser_Name"]) && $_POST["newuser_Name"] != null) {
                        $newuser_Name_isvalid = true;
                        if ($show_provided_registration_info == true){
                            echo '<p class="error-message"> Provided name is: '.$_POST["newuser_Name"].'</p>';
                        }
                    } elseif ($show_registration_errors == true) {
                        echo '<p class="error-message"> Please enter your name </p>';   
                    }

                    if (isset($_POST["newuser_Surname"]) && $_POST["newuser_Surname"] != null) {
                        $newuser_Surname_isvalid = true;
                        if ($show_provided_registration_info == true){
                            echo '<p class="error-message"> Provided surname is: '.$_POST["newuser_Surname"].'</p>';
                        }
                    } elseif ($show_registration_errors == true) {
                        echo '<p class="error-message"> Please enter your surname </p>';
                    }

                    if (isset($_POST["newuser_Gender"]) && $_POST["newuser_Gender"] != null) {
                        $newuser_Gender_isvalid = true;
                        if ($show_provided_registration_info == true){
                            echo '<p class="error-message"> Provided gender is: '.$_POST["newuser_Gender"].'</p>';
                        }
                    } elseif ($show_registration_errors == true) {
                        echo '<p class="error-message"> Please enter your gender </p>';
                    }

                    if (isset($_POST["newuser_Birthday"]) && $_POST["newuser_Birthday"] != null) {
                        $newuser_Birthday_isvalid = true;
                        if ($show_provided_registration_info == true){
                            echo '<p class="error-message"> Provided birthday is: '.$_POST["newuser_Birthday"].'</p>';
                        }
                    } elseif ($show_registration_errors == true) {
                        echo '<p class="error-message"> Please enter your birthday </p>';
                    }

                    if (isset($_POST["newuser_Email"]) && $_POST["newuser_Email"] != null) {
                        $newuser_Email_isvalid = true;
                        if ($show_provided_registration_info == true){
                            echo '<p class="error-message"> Provided e-mail is: '.$_POST["newuser_Email"].'</p>';
                        }
                    } elseif ($show_registration_errors == true) {
                        echo '<p class="error-message"> Please enter your e-mail </p>';
                    }

                    if (isset($_POST["newuser_Contact"]) && $_POST["newuser_Contact"] != null) {
                        $newuser_Contact_isvalid = true;
                        if ($show_provided_registration_info == true){
                            echo '<p class="error-message"> Provided contact is: '.$_POST["newuser_Contact"].'</p>';
                        }
                    } elseif ($show_registration_errors == true) {
                        echo '<p class="error-message"> Please enter your contact information </p>';
                    }
                    
                    if (isset($_POST["newuser_ReceiveNewsletter"]) && $_POST["newuser_ReceiveNewsletter"] != null) {
                        if ($show_provided_registration_info == true){
                            echo '<p class="error-message"> Provided newsletter choice is: '.$_POST["newuser_ReceiveNewsletter"].'</p>';
                        }
                    } 
                }
            }
        }

        if ($newuser_Name_isvalid == true && $newuser_Surname_isvalid == true && $newuser_Gender_isvalid == true && $newuser_Birthday_isvalid == true && $newuser_Email_isvalid == true && $newuser_Contact_isvalid == true) {
            return true;
        } else {
            return false;
        }
    }
?>