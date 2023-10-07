<?php

$from = "albertus.cilliers@gmail.com"; //your gmail address here
function sendPassword(): bool {
    $show_email_info = false;
    $show_email_errors = false;
    $show_successfull_emails = false;

    include_once('Database-Selects.php');
    $where_clause = "userName = :name AND userSurname = :surname AND userGender = :gender AND userBirthday = :birthday AND userEmail = :email AND userContactNo = :contactNo and userSubscribedToNewsletter = :subscribedToNewsletter";
    $where_values = [
        'name' => $_POST["newuser_Name"],
        'surname' => $_POST["newuser_Surname"],
        'gender' => $_POST["newuser_Gender"],
        'birthday' => $_POST["newuser_Birthday"],
        'email' => $_POST["newuser_Email"],
        'contactNo' => $_POST["newuser_Contact"],
        'subscribedToNewsletter' => $_POST["newuser_ReceiveNewsletter"] ?? 0,
    ];

    $userInfo = selectUser($where_clause, $where_values);

    !empty($userInfo) ? $userExists = true : $userExists = false;

    if (!$userExists) {
        if ($show_email_errors) { echo "<p class='error-message'> Error sending email, couldn't find user </p><br>"; }
        return false;
    } else {
        global $from; 

        $headers ='from:' . $from;

        $to = $_POST["newuser_Email"];

        $subject = 'The Augemented Eye Password';

        $message = 'Your password is: '.$userInfo["userPassword"];

        $message =  str_replace("\n.", "\n..", $message);

        if ($show_email_info) {
            echo "<hr>";
            echo "<p> Headers: ".$headers."</p>";
            echo "<p> To: ".$to."</p>";
            echo "<p> Subject: ".$subject."</p>";
            echo "<p> Body: ".$message."</p>";
        }

        $sent = mail($to, $subject, $message, $headers);

        if (!$sent){
            if ($show_email_errors) { echo "<p class='error-message'> Error sending email </p><br>"; }
            return false;
        } else {
            if ($show_successfull_emails) { echo "<p> Password sent to: ".$_POST["newuser_Email"]."</p>"; }
            return true;
        }
    }
}

function sendNewsletter(): bool {
    $show_email_info = false;
    $show_email_errors = true;
    $show_successfull_emails = true;

    $subscribers = getToEmails();

    !empty($subscribers) ? $newsletter_has_subscribers = true : $newsletter_has_subscribers = false;

    if (!$newsletter_has_subscribers) {
        if ($show_email_errors) { echo "<p class='error-message'> Newsletter has no subscribers </p><br>"; }
        return false;
    } else {
        foreach ($subscribers as $recipient_email) {
            if ($recipient_email != null) {
                global $from; 

                $headers ='from:' . $from;

                $to = $recipient_email;

                $subject = $_POST["newsletter_Subject"];

                $message =  str_replace("\n.", "\n..", $_POST["newsletter_Body"]);

                if ($show_email_info) {
                    echo "<hr>";
                    echo "<p> Headers: ".$headers."</p>";
                    echo "<p> To: ".$to."</p>";
                    echo "<p> Subject: ".$subject."</p>";
                    echo "<p> Body: ".$message."</p>";
                }

                $sent = mail($to, $subject, $message, $headers);

                if (!$sent){
                    if ($show_email_errors) { echo "<p class='error-message'> Error sending email to ".$recipient_email."</p><br>"; }
                } else {
                    if ($show_successfull_emails) { echo "<p> Newsletter sent to: ".$recipient_email."</p>"; }
                }   
            }
        }
        return true;
    }
}

function getToEmails(): array {
    $show_email_info = false;

    include_once('PHP Scripts/Database-Selects.php');
    $recipients[] = null;

    foreach (getNewsletterSubcriberEmails() as $rows) {
        if ($show_email_info) {
            echo "Row Info: <br>";
            print_r($rows);
            echo "<br>";
        }

        foreach ($rows as $email) {
            if ($show_email_info) {
                echo "Email: ".$email."<br><br>";
            }
            array_push($recipients, $email);
        }
    }

    if ($show_email_info) {
        echo "To Array Info: <br>";
        print_r($recipients);
        echo "<br>";
    }
    
    return($recipients);
}

// EOF
