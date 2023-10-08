<?php

session_start();

include_once 'FTP-Handler.php';

header('Content-Type: image/jpeg');

if (isset($_SESSION['userID'])) {
    echo get_profile_picture($_SESSION['userID']);
} else {
    echo get_profile_picture(-1);
}

// EOF
