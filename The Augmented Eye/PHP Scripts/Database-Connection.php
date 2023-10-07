<?php
    include_once("Database-Authentication-Info.php");

    function connectToDB(): PDO {
        $show_connection_info = false;

        global $db_hostname,
                $db_username, 
                $db_password, 
                $db_name;

        $dbh = new PDO("mysql:host=$db_hostname;dbname=$db_name",$db_username,$db_password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 

        if ($show_connection_info) {echo 'Connected successfully<br/>';}
        
        return $dbh;
    }
?>