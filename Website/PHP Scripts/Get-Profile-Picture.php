<?php

/**
 * Filename: Get-Profile-Picture.php
 * Author: Albertus Cilliers
 * Description: Displays profile pictures if referenced as <img src='Get-Profile-Picture'>
 */ 

include_once 'FTP-Handler.php';

session_start();

header('Content-Type: image');

if (isset($_GET['user_id'])) {
    echo get_profile_picture($_GET['user_id']);
} else {
    echo get_profile_picture(-1);
}

// EOF
