<?php

/**
 * Filename: About.php
 * Author: Albertus Cilliers  
 * Description: Used to create a connection to the database.
 */

// Purpose: Provides authentication info for connection to database. 
include_once 'Database-Authentication-Info.php';

function connect_to_db(): PDO {
    $show_connection_info = false;

    // From Database-Authentication-Info.php
    // global $db_hostname,
    //         $db_username, 
    //         $db_password, 
    //         $db_name;
    $db_hostname = 'localhost';
    $db_username = 'username';
    $db_password = 'password';
    $db_name = 'the_augmented_eye';

    $dsn = 'mysql:host=' . $db_hostname . ';dbname=' . $db_name;
    $dbh = new PDO($dsn,$db_username,$db_password);

    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 

    if ($show_connection_info) {echo 'Connected successfully<br/>';}
    
    return $dbh;
}

// EOF
