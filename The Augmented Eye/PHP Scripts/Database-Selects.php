<?php

// Purpose: Used to connect to database.
include_once 'Database-Connection.php';

function selectUser(string $where_clause, array $where_values): array {
    $show_select_info = false;

    try{
        
        $dbh = connectToDB();

        //prepare the sql statement
        $stmt = $dbh->prepare('SELECT * FROM Users WHERE ' . $where_clause . ';');
        $stmt -> execute($where_values);

        if ($show_select_info) {echo 'User found';}

        return $stmt->fetch(PDO::FETCH_ASSOC);

    } catch(PDOException $e) {

        echo $e->getMessage();
        return [];
    }
}

// function selectAllUsers($where_clause, $where_values) {
//     $show_select_info = false;

//     try{
        
//         $dbh = connectToDB();

//         //prepare the sql statement
//         $stmt = $dbh->prepare('SELECT * FROM Users WHERE ' . $where_clause . ';');
//         $stmt -> execute($where_values);

//        if ($show_select_info) {echo 'Users found';}

//         return $stmt->fetchAll(PDO::FETCH_ASSOC);

//     } catch(PDOException $e) {

//         echo $e->getMessage();
//         return [];
//     }
// }

function selectArticle(string $where_clause, array $where_values): array {
    $show_select_info = false;

    try{
        
        $dbh = connectToDB();

        //prepare the sql statement
        $stmt = $dbh->prepare('SELECT * FROM Articles WHERE ' . $where_clause . ';');
        $stmt -> execute($where_values);

        if ($show_select_info) {echo 'Article found';}

        return $stmt->fetch(PDO::FETCH_ASSOC);

    } catch(PDOException $e) {

        echo $e->getMessage();
        return [];
    }
}

function selectAllArticles(string $order_by_column, string $order_by_direction, string $row_limit): array {
    $show_select_info = false;

    try{
        
        $dbh = connectToDB();

        //prepare the sql statement
        $stmt = $dbh->prepare('SELECT * FROM Articles ORDER BY ' . $order_by_column . ' ' . $order_by_direction . ' LIMIT ' . $row_limit . '; <br>');

        if ($show_select_info) {echo 'Articles found';}

        $stmt -> execute();

        if ($show_select_info) {
            echo ('SQL STRING: SELECT * FROM Articles ORDER BY ' . $order_by_column . ' ' . $order_by_direction .' LIMIT ' . $row_limit . '; <br>');
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch(PDOException $e) {

        echo $e->getMessage();
        return [];
    }
}

function selectAdmin(int $userID): array {
    $show_select_info = false;

    try{
        
        $dbh = connectToDB();

        //prepare the sql statement
        $stmt = $dbh->prepare('SELECT * FROM Admins WHERE userID = :id;');
        $where_values = [
            'id' => $userID
        ];
        $stmt -> execute($where_values);

        if ($show_select_info) {echo 'Admin found';}

        return $stmt->fetch(PDO::FETCH_ASSOC);

    } catch(PDOException $e) {

        echo $e->getMessage();
        return [];
    }
}

function getNewsletterSubcriberEmails(): array {
    $show_select_info = false;

    try{
        
        $dbh = connectToDB();

        //prepare the sql statement
        $stmt = $dbh->query('SELECT userEmail FROM Users WHERE userSubscribedToNewsletter = 1;');
        $stmt -> execute();

        if ($show_select_info) {echo 'Users found';}

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch(PDOException $e) {

        echo $e->getMessage();
        return [];

    }
}

function getAuthorID(int $article_ID): int {
    $where_clause = 'articleID = :id';
    $where_values = [
        'id' => $article_ID,
    ];

    $article_Info = selectArticle($where_clause, $where_values);
    $author_ID = $article_Info['articleAuthorID'];

    return $author_ID;
}

function getUserNameFromArticleID(int $article_ID): string {
    $where_clause = 'userID = :id';
    $where_values = [
        'id' => getAuthorID($article_ID),
    ];

    $userInfo = selectUser($where_clause, $where_values);
    $author_name = $userInfo['userName'];
    return $author_name;
}

function getUserSurnameFromArticleID(int $article_ID): string {
    $where_clause = 'userID = :id';
    $where_values = [
        'id' => getAuthorID($article_ID),
    ];

    $userInfo = selectUser($where_clause, $where_values);
    $author_surname = $userInfo['userSurname'];
    return $author_surname;
}

// EOF
