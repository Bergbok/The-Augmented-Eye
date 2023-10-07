<?php

date_default_timezone_set('UTC');

// Purpose: Used to connect to database.
include_once 'Database-Connection.php';

// Purpose: Used to generate passwords for new users.
include_once 'Password-Generator.php';

function insertUser(): bool {
    $show_insert_info = false;

    try{
        $dbh = connectToDB();

        //prepare the sql statement
        $stmt = $dbh->prepare("INSERT INTO Users (userPassword, userName, userSurname, userGender, userBirthday, userEmail, userContactNo, userSubscribedToNewsletter, userRegistrationDate)
        VALUES (:userPassword, :newuser_Name, :newuser_Surname, :newuser_Gender, :newuser_Birthday, :newuser_Email, :newuser_Contact, :newuser_ReceiveNewsletter, :newuser_RegistrationDate)");
        
        $data = [
            'userPassword' => generatePassword(30),
            'newuser_Name' => $_POST["newuser_Name"],
            'newuser_Surname' => $_POST["newuser_Surname"],
            'newuser_Gender' => $_POST["newuser_Gender"],
            'newuser_Birthday' => $_POST["newuser_Birthday"],
            'newuser_Email' => $_POST["newuser_Email"],
            'newuser_Contact' => $_POST["newuser_Contact"],
            'newuser_ReceiveNewsletter' => $_POST["newuser_ReceiveNewsletter"] ?? "No",
            'newuser_RegistrationDate' => date("Y-m-d H:i:s")
        ];
        
        if ($show_insert_info) {
            echo "Trying to insert values: <br>";
            foreach ($data as $key => $value) {
                echo "$key: $value<br>";
            }
        }
    
        $stmt->execute($data);

        if ($show_insert_info) {echo 'New records created successfully';}
        return true;

    }catch(PDOException $e){
        echo $e->getMessage();
        return false;
    }
}

function insertArticle(): bool {
    $show_insert_info = false;

    try{
        $dbh = connectToDB();

        //prepare the sql statement
        $stmt = $dbh->prepare("INSERT INTO Articles (articleID, articleAuthorID, articleTitle, articleContent, articlePublishDate)
        VALUES (:articleID, :articleAuthorID, :articleTitle, :articleContent, :articlePublishDate)");
        
        $data = [
            'articleID' => generatePassword(30),
            'articleAuthorID' => $_SESSION["userID"],
            'articleTitle' => $_POST["article_Title"],
            'articleContent' => nl2br($_POST["article_Content"]),
            'articlePublishDate' => date("Y-m-d H:i:s")
        ];
        
        if ($show_insert_info) {
            echo "Trying to insert values: <br>";
            foreach ($data as $key => $value) {
                echo "$key: $value<br>";
            }
        }
    
        $stmt->execute($data);

        if ($show_insert_info) {echo 'New records created successfully';}
        return true;

    }catch(PDOException $e){

        echo $e->getMessage();
        return false;

    }

}

// EOF
