<?php

include_once("Current-Page-Info.php"); 

$page = getCurrentPageInfo("page");

switch ($page) {
    case ("Logout.php" || "Logout"):
        echo '<script>alert("Logged out! Redirecting to homepage in 3 seconds.")</script>';
        break;
    default:
        echo '<script>alert("No known alert for this page:'.$page.'")</script>';
        break;
}