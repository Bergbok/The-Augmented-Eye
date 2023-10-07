<?php

// date_default_timezone_set('UTC');
include_once("Database-Connection.php");

function updateUserPassword(): bool {
    $show_update_info = false;

    try{
        $dbh = connectToDB();

        //prepare the sql statement
        $stmt = $dbh->prepare("UPDATE Users SET userPassword = :newPassword WHERE userID = :userID");
        
        $data = [
            'newPassword' => $_POST["new_Password"],
            'userID' => $_SESSION["userID"]
        ];
        
        if ($show_update_info) {
            echo "Trying to update values: <br>";
            foreach ($data as $key => $value) {
                echo "$key: $value<br>";
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

function incrementArticleViews(int $article_ID): bool {
    $show_update_info = false;

    try{
        $dbh = connectToDB();

        //prepare the sql statement
        $stmt = $dbh->prepare("UPDATE Articles SET articleViews = articleViews+1 WHERE articleID = :articleID");
        $data = [
            'articleID' => $article_ID
        ];
        
        if ($show_update_info) {
            echo "Trying to update values: <br>";
            foreach ($data as $key => $value) {
                echo "$key: $value<br>";
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
