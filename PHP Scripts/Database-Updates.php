<?php

/**
 * Filename: About.php
 * Author: Albertus Cilliers  
 * Description: Used to update existsting rows in database tables.
 */

// date_default_timezone_set('UTC');

// Purpose: Used to connect to database.
include_once 'Database-Connection.php';

function update(string $table, string $set_clause, string $where_clause, array $data): bool {
    $show_update_info = false;

    try{
        $dbh = connect_to_db();

        //prepare the sql statement
        $stmt = $dbh->prepare('UPDATE ' . $table . ' SET ' . $set_clause . ' WHERE ' . $where_clause . ';');
        
        if ($show_update_info) {
            echo 'Trying to update values: <br>';
            foreach ($data as $key => $value) {
                echo $key . ':' . $value . '<br>';
            }
        }
        
        if ($stmt->execute($data)) {
            if ($show_update_info) {echo 'Records updated successfully';}
            return true;
        } else {
            return false;
        }

    } catch(Exception $e) {
        echo $e->getMessage();
        return false;
    }
}

function increment_article_viewcount(int $article_id): bool {
    $set_clause = 'article_view_count = article_view_count + 1';

    $where_clause = 'article_id = :article_id';

    $data = [
        'article_id' => $article_id
    ];

    return update('articles', $set_clause, $where_clause, $data);
}

// EOF
