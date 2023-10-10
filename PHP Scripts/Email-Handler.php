<?php

/**
 * Filename: About.php
 * Author: Albertus Cilliers  
 * Description: Handles sending emails.
 */

// Insert the email you have set as auth_username in sendmail.ini and sendmail_from in php.ini
$from = 'albertus.cilliers@gmail.com'; 

function send_password(): bool {
    $show_email_info = false;
    $show_email_errors = false;
    $show_successfull_emails = false;

    // Purpose: Used to get users password.
    include_once 'Database-Selects.php';

    $columns = '*';
    $table = 'users';
    $where_clause = 'user_name = :name AND user_surname = :surname AND user_gender = :gender AND user_birthday = :birthday AND user_email = :email AND user_contact_num = :contactNo and user_subscribed_to_newsletter = :subscribedToNewsletter';
    $where_values = [
        'name' => $_POST['new_user_name'],
        'surname' => $_POST['new_user_surname'],
        'gender' => $_POST['new_user_gender'],
        'birthday' => $_POST['new_user_birthday'],
        'email' => $_POST['new_user_email'],
        'contactNo' => $_POST['new_user_contact_num'],
        'subscribedToNewsletter' => $_POST['new_user_subscribed_to_newsletter'] ?? 0,
    ];

    $user_info = select($columns, $table, $where_clause, $where_values);

    !empty($user_info) ? $user_exists = true : $user_exists = false;

    if (!$user_exists) {
        if ($show_email_errors) { echo '<p class=\'error-message\'> Error sending email, couldn\'t find user </p><br>'; }
        return false;
    } else {
        global $from; 

        $headers ='from:' . $from;

        $to = $_POST['new_user_email'];

        $subject = 'The Augemented Eye Password';

        $message = 'Your password is: '.$user_info['user_password'];

        $message =  str_replace('\n.', '\n..', $message);

        if ($show_email_info) {
            echo '<hr>';
            echo '<p> Headers: ' . $headers . '</p>';
            echo '<p> To: ' . $to . '</p>';
            echo '<p> Subject: ' . $subject . '</p>';
            echo '<p> Body: ' . $message . '</p>';
        }

        $sent = mail($to, $subject, $message, $headers);

        if (!$sent){
            if ($show_email_errors) { echo '<p class=\'error-message\'> Error sending email </p><br>'; }
            return false;
        } else {
            if ($show_successfull_emails) { echo '<p> Password sent to: ' . $_POST['new_user_email'] . '</p>'; }
            return true;
        }
    }
}

function send_newsletter(): bool {
    $show_email_info = false;
    $show_email_errors = true;
    $show_successfull_emails = true;

    $subscribers = get_to_emails();

    !empty($subscribers) ? $newsletter_has_subscribers = true : $newsletter_has_subscribers = false;

    if (!$newsletter_has_subscribers) {
        if ($show_email_errors) { echo '<p class=\'error-message\'> Newsletter has no subscribers </p><br>'; }
        return false;
    } else {
        foreach ($subscribers as $recipient_email) {
            if ($recipient_email != null) {
                global $from; 

                $headers ='from:' . $from;

                $to = $recipient_email;

                $subject = $_POST['newsletter_subject'];

                $message =  str_replace('\n.', '\n..', $_POST['newsletter_body']);

                if ($show_email_info) {
                    echo '<hr>';
                    echo '<p> Headers: ' . $headers . '</p>';
                    echo '<p> To: ' . $to . '</p>';
                    echo '<p> Subject: ' . $subject . '</p>';
                    echo '<p> Body: ' . $message . '</p>';
                }

                $sent = mail($to, $subject, $message, $headers);

                if (!$sent){
                    if ($show_email_errors) { echo '<p class=\'error-message\'> Error sending email to ' . $recipient_email . '</p><br>'; }
                } else {
                    if ($show_successfull_emails) { echo '<p> Newsletter sent to: ' . $recipient_email . '</p>'; }
                }   
            }
        }
        return true;
    }
}

function get_to_emails(): array {
    $show_email_info = true;

    // Purpose: Used to get newsletter subscriber emails.
    include_once 'PHP Scripts/Database-Selects.php';

    $recipient_emails = [];

    $columns = 'user_email';
    $table = 'users';
    $where_clause = 'user_subscribed_to_newsletter = 1';
    $fetch_multiple_rows = true;

    $subscribers = select($columns, $table, $where_clause, [], $fetch_multiple_rows);

    foreach ($subscribers as $rows) {
        if ($show_email_info) {
            echo 'Row Info: <br>';
            print_r($rows);
            echo '<br>';
        }

        foreach ($rows as $email) {
            if ($show_email_info) {
                echo 'Email: ' . $email . '<br><br>';
            }
            array_push($recipient_emails, $email);
        }
    }

    if ($show_email_info) {
        echo 'To Array Info: <br>';
        print_r($recipient_emails);
        echo '<br>';
    }
    
    return $recipient_emails;
}

// EOF
