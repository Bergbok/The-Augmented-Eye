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

    $where_clause = 'userName = :name AND userSurname = :surname AND userGender = :gender AND userBirthday = :birthday AND userEmail = :email AND userContactNo = :contactNo and userSubscribedToNewsletter = :subscribedToNewsletter';
    $where_values = [
        'name' => $_POST['newuser_Name'],
        'surname' => $_POST['newuser_Surname'],
        'gender' => $_POST['newuser_Gender'],
        'birthday' => $_POST['newuser_Birthday'],
        'email' => $_POST['newuser_Email'],
        'contactNo' => $_POST['newuser_Contact'],
        'subscribedToNewsletter' => $_POST['newuser_ReceiveNewsletter'] ?? 0,
    ];

    $user_info = select_user($where_clause, $where_values);

    !empty($user_info) ? $user_exists = true : $user_exists = false;

    if (!$user_exists) {
        if ($show_email_errors) { echo '<p class=\'error-message\'> Error sending email, couldn\'t find user </p><br>'; }
        return false;
    } else {
        global $from; 

        $headers ='from:' . $from;

        $to = $_POST['newuser_Email'];

        $subject = 'The Augemented Eye Password';

        $message = 'Your password is: '.$user_info['userPassword'];

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
            if ($show_successfull_emails) { echo '<p> Password sent to: ' . $_POST['newuser_Email'] . '</p>'; }
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

                $subject = $_POST['newsletter_Subject'];

                $message =  str_replace('\n.', '\n..', $_POST['newsletter_Body']);

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
    $show_email_info = false;

    // Purpose: Used to get newsletter subscriber emails.
    include_once 'PHP Scripts/Database-Selects.php';

    $recipients[] = null;

    foreach (get_newsletter_subscriber_emails() as $rows) {
        if ($show_email_info) {
            echo 'Row Info: <br>';
            print_r($rows);
            echo '<br>';
        }

        foreach ($rows as $email) {
            if ($show_email_info) {
                echo 'Email: ' . $email . '<br><br>';
            }
            array_push($recipients, $email);
        }
    }

    if ($show_email_info) {
        echo 'To Array Info: <br>';
        print_r($recipients);
        echo '<br>';
    }
    
    return($recipients);
}

// EOF
