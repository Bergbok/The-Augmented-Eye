<?php

/**
 * Filename: Form-Validation.php
 * Author: Albertus Cilliers  
 * Description: Used to validate forms across the website.
 */

//  function validate_function_template(): bool {
//     $null_checks = [
//         'POST_KEY' => 'ERROR DESCRIPTOR',
//         'POST_KEY2' => 'ERROR DESCRIPTOR'
//     ];

//     $is_valid_WHAT_YOUR_VALIDATING = validate_post_keys($null_checks);

//     if ($is_valid_WHAT_YOUR_VALIDATING) {
//         // Additional checks go here
//     }

//     return $is_valid_WHAT_YOUR_VALIDATING;
// }

/**
 * Determines if the request method is POST
 * @return bool Returns true if the request method is POST or false if it is not.
 */
function is_post(): bool {
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
        return true;
    } else {
        return false;
    }
} 

/**
 * Determines if $_POST values are set
 * @param array $null_checks KVP array ($_POST value to check => message to display if it isn't set)
 * 
 * @return bool Returns true if all keys are set or false if not.
 */
function validate_post_keys(array $null_checks): bool {
    $show_validation_errors = true;
    $show_post_values = false;
    $is_valid = true;

    if (is_post()) {
        foreach ($null_checks as $post_key => $error_descriptor) {
            if ($show_post_values){
                echo '<p class=\'centered-text\'>' . $post_key . ' is: ' . $_POST[$post_key] . '</p>';
            }

            if (!isset($_POST[$post_key]) || $_POST[$post_key] == null) {
                if ($show_validation_errors) {
                    echo '<p class=\'centered-text error-message\'> ' . $error_descriptor . ' </p>';   
                }
                $is_valid = false;
            }
        }
    } else {
        $is_valid = false;
        if ($show_validation_errors && isset($_SERVER['REQUEST_METHOD'])) {
            echo '<p class=\'centered-text error-message\'> Could not perform operation using ' . $_SERVER['REQUEST_METHOD'] . ' </p>';  
        }
    }
    
    return $is_valid;
}

/**
 * Validates if provided login information is valid data (not whether the user exists in the database)
 * @return bool Return true if valid, false if invalid
 */
function validate_login(): bool {
    $null_checks = [
        'user_email' => 'Please enter your email',
        'user_password' => 'Please enter your password'
    ];

    $is_valid_login = validate_post_keys($null_checks);

    if ($is_valid_login) {
        // Additional checks go here
    }

    return $is_valid_login;
}

/**
 * Determines if registration information is valid for inserting into database
 * @return bool Return true if valid, false if invalid
 */
function validate_registration(): bool {
    $null_checks = [
        'new_user_name' => 'Please enter your name',
        'new_user_surname' => 'Please enter your surname',
        'new_user_gender' => 'Please enter your gender',
        'new_user_birthday' => 'Please enter your birthday',
        'new_user_email' => 'Please enter your e-mail'
    ];

    $is_valid_registration = validate_post_keys($null_checks);

    if ($is_valid_registration) {
        // Additional checks go here
    }

    return $is_valid_registration;    
}

/**
 * Determines if article information is valid for inserting into database
 * @return bool Return true if valid, false if invalid
 */
function validate_article(): bool {
    $null_checks = [
        'article_title' => 'Please enter a title',
        'article_text' => 'Please enter article text'
    ];

    $is_valid_article = validate_post_keys($null_checks);

    if ($is_valid_article) {
        if (strlen($_POST['article_text']) < 50) {
            $is_valid_article = false;
            echo '<p class=\'error-message\'> Provided article text is only '.strlen($_POST['article_text']).' characters long, please ensure that you enter at least 50 characters</p>';
        }
    }

    return $is_valid_article;
}

/**
 * Determines if comment information is valid for inserting into database
 * @return bool Return true if valid, false if invalid
 */
function validate_comment(): bool {
    $null_checks = [
        'new_comment_text' => 'Please enter comment body'
    ];

    $is_valid_comment = validate_post_keys($null_checks);

    if ($is_valid_comment) {
        // Additional checks go here
    }

    return $is_valid_comment;
}

/**
 * Determines if newsletter information is valid for sending to subscribers
 * @return bool Return true if valid, false if invalid
 */
function validate_newsletter(): bool {
    $null_checks = [
        'newsletter_subject' => 'Please enter a subject',
        'newsletter_body' => 'Please enter article text'
    ];

    $is_valid_newsletter = validate_post_keys($null_checks);

    if ($is_valid_newsletter) {
        // Additional checks go here
    }

    return $is_valid_newsletter;
}

/**
 * Determines if password is valid for changing
 * @return bool Return true if valid, false if invalid
 */
function validate_password_change(): bool {
    $null_checks = [
        'new_password' => 'Please enter a password'
    ];

    $is_valid_password_change = validate_post_keys($null_checks);

    if ($is_valid_password_change) {
        // Additional checks go here
    }

    return $is_valid_password_change;
}

/**
 * Determines if gallery information is valid for inserting into database
 * @return bool Return true if valid, false if invalid
 */
function validate_gallery(): bool {
    $null_checks = [
        'gallery_title' => 'Please enter a title'
    ];

    $is_valid_password_change = validate_post_keys($null_checks);

    if ($is_valid_password_change) {
        // Additional checks go here
    }

    return $is_valid_password_change;
}

// EOF
