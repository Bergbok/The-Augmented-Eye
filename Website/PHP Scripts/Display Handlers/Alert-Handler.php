<?php

/**
 * Filename: Alert-Handler.php
 * Author: Albertus Cilliers  
 * Description: Handles displaying alerts through the browser.
 */

// Purpose: Used to get current page.
include_once dirname(__DIR__) . '/Current-Page-Info.php'; 

$page = get_current_page_info('page');

switch ($page) {
    case ('Logout.php' || 'Logout'):
        echo '<script>alert(\'Logged out! Redirecting to homepage in 3 seconds.\')</script>';
        break;
    default:
        echo '<script>alert(\'No known alert for this page:' . $page . '\')</script>';
        break;
}

// EOF
