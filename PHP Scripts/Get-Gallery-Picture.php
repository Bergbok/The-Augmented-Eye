<?php

/**
 * Filename: Get-Gallery-Picture.php
 * Author: Albertus Cilliers
 * Description: Displays gallery images if referenced as <img src='Get-Gallery-Picture'>
 */ 

include_once 'FTP-Handler.php';

session_start();

header('Content-Type: image');

if (isset($_GET['gallery_id']) && isset($_GET['image_name'])) {
    echo get_gallery_image($_GET['gallery_id'], $_GET['image_name']);
} else {
    echo 'Failed to get image, $_GET values not set';
}

// EOF
