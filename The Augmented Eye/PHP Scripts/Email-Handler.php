<?php
    function sendNewsletter() {
        $show_email_info = false;
        $show_email_errors = true;
        $show_successfull_emails = true;

        $subscribers = getToEmails();

        foreach ($subscribers as $recipient_email) {
            if ($recipient_email != null) {
                $from = "albertus.cilliers@gmail.com"; //your gmail address here

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
                // $sent = false;

                if (!$sent){
                    if ($show_email_errors) {
                        echo "<p class='error-message'> Error sending email </p><br>";
                        print_r(error_get_last());
                    }
                }else{
                    if ($show_successfull_emails) {
                        echo "<p> Newsletter sent to: ".$recipient_email."</p>";
                    }
                }   
            }
            
        }

    }

    function getToEmails() {
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
?>