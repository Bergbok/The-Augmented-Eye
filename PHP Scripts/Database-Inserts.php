<?php

/**
 * Filename: About.php
 * Author: Albertus Cilliers  
 * Description: Used to insert rows into database tables.
 */

// date_default_timezone_set('Africa/Johannesburg');

// Purpose: Used to connect to database.
include_once 'Database-Connection.php';

function insert(string $table, string $column_names, string $values_clause, array $data): bool {
    $show_insert_info = false;

    try{
        $dbh = connect_to_db();

        //prepare the sql statement
        $stmt = $dbh->prepare('INSERT INTO ' . $table . ' (' . $column_names . ')
        VALUES (' . $values_clause . ');');
        
        if ($show_insert_info) {
            echo 'Trying to insert values: <br>';
            foreach ($data as $key => $value) {
                echo $key . ':' . $value . '<br>';
            }
        }
    
        if ($stmt->execute($data)) {
            if ($show_insert_info) {echo 'New records created successfully';}
            return true;
        } else {
            return false;
        }

    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
}

// EOF
