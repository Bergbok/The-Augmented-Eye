<?php

include_once 'FTP-Handler.php';

session_start();

header('Content-Type: image');

if (isset($_GET['userID'])) {
    echo get_profile_picture($_GET['userID']);
} else {
    echo get_profile_picture(-1);
}

// EOF
