<?php
    // include_once("Current-Page-Info"); 
    
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

                if (isset($_POST["user_Email"])) {
                    $user_Email_isvalid = true;
                    if ($show_provided_login_info){
                        echo '<p class="error-message"> Provided name is: '.$_POST["user_Email"].'</p>';
                    }
                } elseif ($show_login_errors) {
                    echo '<p class="error-message"> Please enter your email </p>';   
                }

                if (isset($_POST["user_Password"])) {
                    $user_Password_isvalid = true;
                    if ($show_provided_login_info){
                        echo '<p class="error-message"> Provided password is: '.$_POST["user_Password"].'</p>';
                    }
                } elseif ($show_login_errors) {
                    echo '<p class="error-message"> Please enter your password </p>';
                }
                
            }
        }

        if ($user_Email_isvalid && $user_Password_isvalid) {
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

                if (isset($_POST["newuser_Name"]) && $_POST["newuser_Name"] != null) {
                    $newuser_Name_isvalid = true;
                    if ($show_provided_registration_info){
                        echo '<p class="error-message"> Provided name is: '.$_POST["newuser_Name"].'</p>';
                    }
                } elseif ($show_registration_errors) {
                    echo '<p class="error-message"> Please enter your name </p>';   
                }

                if (isset($_POST["newuser_Surname"]) && $_POST["newuser_Surname"] != null) {
                    $newuser_Surname_isvalid = true;
                    if ($show_provided_registration_info){
                        echo '<p class="error-message"> Provided surname is: '.$_POST["newuser_Surname"].'</p>';
                    }
                } elseif ($show_registration_errors) {
                    echo '<p class="error-message"> Please enter your surname </p>';
                }

                if (isset($_POST["newuser_Gender"]) && $_POST["newuser_Gender"] != null) {
                    $newuser_Gender_isvalid = true;
                    if ($show_provided_registration_info){
                        echo '<p class="error-message"> Provided gender is: '.$_POST["newuser_Gender"].'</p>';
                    }
                } elseif ($show_registration_errors) {
                    echo '<p class="error-message"> Please enter your gender </p>';
                }

                if (isset($_POST["newuser_Birthday"]) && $_POST["newuser_Birthday"] != null) {
                    $newuser_Birthday_isvalid = true;
                    if ($show_provided_registration_info){
                        echo '<p class="error-message"> Provided birthday is: '.$_POST["newuser_Birthday"].'</p>';
                    }
                } elseif ($show_registration_errors) {
                    echo '<p class="error-message"> Please enter your birthday </p>';
                }

                if (isset($_POST["newuser_Email"]) && $_POST["newuser_Email"] != null) {
                    $newuser_Email_isvalid = true;
                    if ($show_provided_registration_info){
                        echo '<p class="error-message"> Provided e-mail is: '.$_POST["newuser_Email"].'</p>';
                    }
                } elseif ($show_registration_errors) {
                    echo '<p class="error-message"> Please enter your e-mail </p>';
                }

                if (isset($_POST["newuser_Contact"]) && $_POST["newuser_Contact"] != null) {
                    $newuser_Contact_isvalid = true;
                    if ($show_provided_registration_info){
                        echo '<p class="error-message"> Provided contact is: '.$_POST["newuser_Contact"].'</p>';
                    }
                } elseif ($show_registration_errors) {
                    echo '<p class="error-message"> Please enter your contact information </p>';
                }
                
                if (isset($_POST["newuser_ReceiveNewsletter"]) && $_POST["newuser_ReceiveNewsletter"] != null) {
                    if ($show_provided_registration_info){
                        echo '<p class="error-message"> Provided newsletter choice is: '.$_POST["newuser_ReceiveNewsletter"].'</p>';
                    }
                } 

            }
        }

        if ($newuser_Name_isvalid && $newuser_Surname_isvalid && $newuser_Gender_isvalid && $newuser_Birthday_isvalid && $newuser_Email_isvalid && $newuser_Contact_isvalid) {
            return true;
        } else {
            return false;
        }
    }

    function validateArticle() {
        $show_article_errors = true;
        $show_provided_article_info = false;

        $article_Title_isvalid = $article_Content_isvalid = false;

        if (isset($_SERVER["REQUEST_METHOD"])){
            if ($_SERVER["REQUEST_METHOD"] == "POST"){ 

                if (isset($_POST["article_Title"])) {
                    $article_Title_isvalid = true;
                    if ($show_provided_article_info){
                        echo '<p class="error-message"> Provided title is: '.$_POST["article_Title"].'</p>';
                    }
                } elseif ($show_article_errors) {
                    echo '<p class="error-message"> Please enter a title </p>';   
                }

                if (isset($_POST["article_Content"])) {
                    if (strlen($_POST["article_Content"]) < 50) {
                        echo '<p class="error-message"> Provided article text is only '.strlen($_POST["article_Content"]).' characters long, please ensure that you enter at least 50 characters</p>';
                    } else {
                        $article_Content_isvalid = true;
                        if ($show_provided_article_info){
                            echo '<p class="error-message"> Provided article text is: '.$_POST["article_Content"].'</p>';
                        }
                    }
                } elseif ($show_article_errors) {
                    echo '<p class="error-message"> Please enter article text </p>';
                }

            }
        }

        if ($article_Title_isvalid && $article_Content_isvalid) {
            return true;
        } else {
            return false;
        }
    }

    function validateNewsletter() {
        $show_newsletter_errors = true;
        $show_provided_newsletter_info = false;

        $newsletter_Subject_isvalid = $newsletter_Body_isvalid = false;

        if (isset($_SERVER["REQUEST_METHOD"])){
            if ($_SERVER["REQUEST_METHOD"] == "POST"){ 

                if (isset($_POST["newsletter_Subject"])) {
                    $newsletter_Subject_isvalid = true;
                    if ($show_provided_newsletter_info){
                        echo '<p class="error-message"> Provided subject is: '.$_POST["newsletter_Subject"].'</p>';
                    }
                } elseif ($show_newsletter_errors) {
                    echo '<p class="error-message"> Please enter a subject </p>';   
                }

                if (isset($_POST["newsletter_Body"])) {
                    $newsletter_Body_isvalid = true;
                    if ($show_provided_newsletter_info){
                        echo '<p class="error-message"> Provided newsletter body is: '.$_POST["newsletter_Body"].'</p>';
                    }
                } elseif ($show_newsletter_errors) {
                    echo '<p class="error-message"> Please enter article text </p>';
                }

            }
        }

        if ($newsletter_Subject_isvalid && $newsletter_Body_isvalid) {
            return true;
        } else {
            return false;
        }
    }

    function validatePasswordChange() {
        $show_new_password_errors = true;
        $show_provided_new_password_info = false;

        $new_password_isvalid = false;

        if (isset($_SERVER["REQUEST_METHOD"])){
            if ($_SERVER["REQUEST_METHOD"] == "POST"){  

                if (isset($_POST["new_Password"]) && !empty($_POST["new_Password"])) {
                    $new_password_isvalid = true;
                    if ($show_provided_new_password_info){
                        echo '<p class="error-message"> Provided password is: '.$_POST["new_Password"].'</p>';
                    }
                } elseif ($show_new_password_errors) {
                    echo '<p class="error-message"> Please enter a password </p>';   
                }

            }
        }

        if ($new_password_isvalid) {
            return true;
        } else {
            return false;
        }
    }
?>