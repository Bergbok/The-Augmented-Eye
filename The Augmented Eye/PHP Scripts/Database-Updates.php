<?php

// date_default_timezone_set('UTC');

// Purpose: Used to connect to database.
include_once 'Database-Connection.php';

function update_user_password(): bool {
    $show_update_info = false;

    try{
        $dbh = connect_to_db();

        //prepare the sql statement
        $stmt = $dbh->prepare('UPDATE Users SET userPassword = :newPassword WHERE userID = :userID');
        
        $data = [
            'newPassword' => $_POST['new_Password'],
            'userID' => $_SESSION['userID']
        ];
        
        if ($show_update_info) {
            echo 'Trying to update values: <br>';
            foreach ($data as $key => $value) {
                echo $key . ':' . $value . '<br>';
            }
        }
    
        $stmt->execute($data);

        if ($show_update_info) {echo 'Records updated successfully';}
        return true;

    }catch(PDOException $e){
        echo $e->getMessage();
        return false;
    }
}

function increment_article_viewcount(int $article_id): bool {
    $show_update_info = false;

    try{
        $dbh = connect_to_db();

        //prepare the sql statement
        $stmt = $dbh->prepare('UPDATE Articles SET articleViews = articleViews+1 WHERE articleID = :articleID');
        $data = [
            'articleID' => $article_id
        ];
        
        if ($show_update_info) {
            echo 'Trying to update values: <br>';
            foreach ($data as $key => $value) {
                echo $key . ':' . $value . '<br>';
            }
        }
    
        $stmt->execute($data);

        if ($show_update_info) {echo 'Records updated successfully';}
        return true;

    }catch(PDOException $e){
        echo $e->getMessage();
        return false;
    }
}

// EOF
