<?php

/**
 * Filename: About.php
 * Author: Albertus Cilliers  
 * Description: Used to select data and rows from database tables.
 */

// Purpose: Used to connect to database.
include_once 'Database-Connection.php';

function select_user(string $where_clause, array $where_values): array | bool {
    $show_select_info = false;

    try{
        
        $dbh = connect_to_db();

        //prepare the sql statement
        $stmt = $dbh->prepare('SELECT * FROM Users WHERE ' . $where_clause . ';');
        $stmt -> execute($where_values);

        if ($show_select_info) {echo 'User found';}

        return $stmt->fetch(PDO::FETCH_ASSOC);

    } catch(PDOException $e) {
        // echo $e->getMessage();
        return [];
    }
}

// function selectAllUsers($where_clause, $where_values) {
//     $show_select_info = false;

//     try{
        
//         $dbh = connect_to_db();

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

function select_article(string $where_clause, array $where_values): array | bool {
    $show_select_info = false;

    try{
        
        $dbh = connect_to_db();

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

function select_all_articles(string $order_by_column, string $order_by_direction, string $row_limit): array {
    $show_select_info = false;

    try{
        
        $dbh = connect_to_db();

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

function select_admin(int $userID): array | bool {
    $show_select_info = false;

    try{
        
        $dbh = connect_to_db();

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

function select_comments(int $article_id, string $order_by_column = 'comment_post_date', string $order_by_direction = 'DESC'): array | bool {
    $show_select_info = false;

    try{
        
        $dbh = connect_to_db();

        //prepare the sql statement
        $stmt = $dbh->prepare('SELECT * FROM comments WHERE article_id = :id ORDER BY ' . $order_by_column . ' ' . $order_by_direction . ';');
        $where_values = [
            'id' => $article_id
        ];
        $stmt -> execute($where_values);

        if ($show_select_info) {echo 'Comment(s) found';}

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch(PDOException $e) {

        echo $e->getMessage();
        return [];
    }
}

function get_newsletter_subscriber_emails(): array | bool {
    $show_select_info = false;

    try{
        
        $dbh = connect_to_db();

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

function get_author_id(int $article_id): int {
    $where_clause = 'articleID = :id';
    $where_values = [
        'id' => $article_id,
    ];

    $article_Info = select_article($where_clause, $where_values);
    $author_ID = $article_Info['articleAuthorID'];

    return $author_ID;
}

function get_author_name_from_article_id(int $article_id): string {
    $where_clause = 'userID = :id';
    $where_values = [
        'id' => get_author_id($article_id),
    ];

    $user_info = select_user($where_clause, $where_values);
    $user_info = select_user($where_clause, $where_values);
    $author_name = $user_info['userName'];
    return $author_name;
}

function get_author_surname_from_article_id(int $article_id): string {
    $where_clause = 'userID = :id';
    $where_values = [
        'id' => get_author_id($article_id),
    ];

    $user_info = select_user($where_clause, $where_values);
    $author_surname = $user_info['userSurname'];
    return $author_surname;
}

function get_comment_poster_info(int $comment_poster_id) {
    $where_clause = 'userID = :id';
    $where_values = [
        'id' => $comment_poster_id,
    ];

    $comment_poster_info = select_user($where_clause, $where_values);
    return $comment_poster_info;
}

function get_profile_picture_filename(int | null $user_id) {
    $where_clause = 'userID = :id';
    $where_values = [
        'id' => $user_id,
    ];

    $user_info = select_user($where_clause, $where_values);

    !empty($user_info) ? $user_exists = true : $user_exists = false;

    if ($user_exists && $user_info['userProfilePictureFilename'] != null) {
        $picture_filename = $user_info['userProfilePictureFilename'];
    } else {
        $picture_filename = 'pfp-placeholder.png';
    }
    
    return $picture_filename;
}

// EOF
