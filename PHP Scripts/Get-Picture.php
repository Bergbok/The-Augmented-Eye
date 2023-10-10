<?php

include_once 'FTP-Handler.php';

session_start();

header('Content-Type: image');

if (isset($_GET['user_id'])) {
    echo get_profile_picture($_GET['user_id']);
} else {
    echo get_profile_picture(-1);
}

// EOF
