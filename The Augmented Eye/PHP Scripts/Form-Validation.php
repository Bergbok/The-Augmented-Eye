<?php

/**
 * Filename: About.php
 * Author: Albertus Cilliers  
 * Description: Used to validate forms across the website.
 */

function validate_login(): bool {
    $show_login_errors = true;
    $show_provided_login_info = false;

    $user_Email_isvalid = $user_Password_isvalid = false;

    if (isset($_SERVER['REQUEST_METHOD'])){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){                

            if (isset($_POST['user_Email'])) {
                $user_Email_isvalid = true;
                if ($show_provided_login_info){
                    echo '<p class=\'error-message\'> Provided name is: ' . $_POST['user_Email'] . '</p>';
                }
            } elseif ($show_login_errors) {
                echo '<p class=\'error-message\'> Please enter your email </p>';   
            }

            if (isset($_POST['user_Password'])) {
                $user_Password_isvalid = true;
                if ($show_provided_login_info){
                    echo '<p class=\'error-message\'> Provided password is: ' . $_POST['user_Password'] . '</p>';
                }
            } elseif ($show_login_errors) {
                echo '<p class=\'error-message\'> Please enter your password </p>';
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
function validate_registration(): bool {
    $show_registration_errors = true;
    $show_provided_registration_info = false;

    $newuser_name_isvalid = $newuser_surname_isvalid = $newuser_gender_isvalid = $newuser_birthday_isvalid = $newuser_email_isvalid = $newuser_contact_isvalid = false;
    
    if (isset($_SERVER['REQUEST_METHOD'])){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){                

            if (isset($_POST['newuser_Name'])) {
                $newuser_name_isvalid = true;
                if ($show_provided_registration_info){
                    echo '<p class=error-message> Provided name is: ' . $_POST['newuser_Name'] . '</p>';
                }
            } elseif ($show_registration_errors) {
                echo '<p class=\'error-message\'> Please enter your name </p>';   
            }

            if (isset($_POST['newuser_Surname'])) {
                $newuser_surname_isvalid = true;
                if ($show_provided_registration_info){
                    echo '<p class=\'error-message\'> Provided surname is: ' . $_POST['newuser_Surname'] . '</p>';
                }
            } elseif ($show_registration_errors) {
                echo '<p class=\'error-message\'> Please enter your surname </p>';
            }

            if (isset($_POST['newuser_Gender'])) {
                $newuser_gender_isvalid = true;
                if ($show_provided_registration_info){
                    echo '<p class=\'error-message\'> Provided gender is: ' . $_POST['newuser_Gender'] . '</p>';
                }
            } elseif ($show_registration_errors) {
                echo '<p class=\'error-message\'> Please enter your gender </p>';
            }

            if (isset($_POST['newuser_Birthday'])) {
                $newuser_birthday_isvalid = true;
                if ($show_provided_registration_info){
                    echo '<p class=\'error-message\'> Provided birthday is: ' . $_POST['newuser_Birthday'] . '</p>';
                }
            } elseif ($show_registration_errors) {
                echo '<p class=\'error-message\'> Please enter your birthday </p>';
            }

            if (isset($_POST['newuser_Email'])) {
                $newuser_email_isvalid = true;
                if ($show_provided_registration_info){
                    echo '<p class=\'error-message\'> Provided e-mail is: ' . $_POST['newuser_Email'] . '</p>';
                }
            } elseif ($show_registration_errors) {
                echo '<p class=\'error-message\'> Please enter your e-mail </p>';
            }

            if (isset($_POST['newuser_Contact'])) {
                $newuser_contact_isvalid = true;
                if ($show_provided_registration_info){
                    echo '<p class=\'error-message\'> Provided contact is: ' . $_POST['newuser_Contact'] . '</p>';
                }
            } elseif ($show_registration_errors) {
                echo '<p class=\'error-message\'> Please enter your contact information </p>';
            }
            
            if (isset($_POST['newuser_ReceiveNewsletter'])) {
                if ($show_provided_registration_info){
                    echo '<p class=\'error-message\'> Provided newsletter choice is: ' . $_POST['newuser_ReceiveNewsletter'] . '</p>';
                }
            } 

        }
    }

    if ($newuser_name_isvalid && $newuser_surname_isvalid && $newuser_gender_isvalid && $newuser_birthday_isvalid && $newuser_email_isvalid && $newuser_contact_isvalid) {
        return true;
    } else {
        return false;
    }
}

function validate_article(): bool {
    $show_article_errors = true;
    $show_provided_article_info = false;

    $article_title_isvalid = $article_content_isvalid = false;

    if (isset($_SERVER['REQUEST_METHOD'])){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){ 

            if (isset($_POST['article_Title'])) {
                $article_title_isvalid = true;
                if ($show_provided_article_info){
                    echo '<p class=\'error-message\'> Provided title is: ' . $_POST['article_Title'] . '</p>';
                }
            } elseif ($show_article_errors) {
                echo '<p class=\'error-message\'> Please enter a title </p>';   
            }

            if (isset($_POST['article_Content'])) {
                if (strlen($_POST['article_Content']) < 50) {
                    echo '<p class=\'error-message\'> Provided article text is only '.strlen($_POST['article_Content']).' characters long, please ensure that you enter at least 50 characters</p>';
                } else {
                    $article_content_isvalid = true;
                    if ($show_provided_article_info){
                        echo '<p class=\'error-message\'> Provided article text is: ' . $_POST['article_Content'] . '</p>';
                    }
                }
            } elseif ($show_article_errors) {
                echo '<p class=\'error-message\'> Please enter article text </p>';
            }

        }
    }

    if ($article_title_isvalid && $article_content_isvalid) {
        return true;
    } else {
        return false;
    }
}

function validate_newsletter(): bool {
    $show_newsletter_errors = true;
    $show_provided_newsletter_info = false;

    $newsletter_subject_isvalid = $newsletter_body_isvalid = false;

    if (isset($_SERVER['REQUEST_METHOD'])){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){ 

            if (isset($_POST['newsletter_Subject'])) {
                $newsletter_subject_isvalid = true;
                if ($show_provided_newsletter_info){
                    echo '<p class=\'error-message\'> Provided subject is: ' . $_POST['newsletter_Subject'] . '</p>';
                }
            } elseif ($show_newsletter_errors) {
                echo '<p class=\'error-message\'> Please enter a subject </p>';   
            }

            if (isset($_POST['newsletter_Body'])) {
                $newsletter_body_isvalid = true;
                if ($show_provided_newsletter_info){
                    echo '<p class=\'error-message\'> Provided newsletter body is: ' . $_POST['newsletter_Body'] . '</p>';
                }
            } elseif ($show_newsletter_errors) {
                echo '<p class=\'error-message\'> Please enter article text </p>';
            }

        }
    }

    if ($newsletter_subject_isvalid && $newsletter_body_isvalid) {
        return true;
    } else {
        return false;
    }
}

function validate_password_change(): bool {
    $show_new_password_errors = true;
    $show_provided_new_password_info = false;

    $new_password_isvalid = false;

    if (isset($_SERVER['REQUEST_METHOD'])){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){  

            if (isset($_POST['new_Password']) && !empty($_POST['new_Password'])) {
                $new_password_isvalid = true;
                if ($show_provided_new_password_info){
                    echo '<p class=\'error-message\'> Provided password is: ' . $_POST['new_Password'] . '</p>';
                }
            } elseif ($show_new_password_errors) {
                echo '<p class=\'error-message\'> Please enter a password </p>';   
            }

        }
    }

    if ($new_password_isvalid) {
        return true;
    } else {
        return false;
    }
}

// EOF
