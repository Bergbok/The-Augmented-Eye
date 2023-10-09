<?php

/**
 * Filename: About.php
 * Author: Albertus Cilliers  
 * Description: Used to select data and rows from database tables.
 */

// Purpose: Used to connect to database.
include_once 'Database-Connection.php';


// function select_user(string $where_clause, array $where_values): array | bool {
//     $show_select_info = false;

//     try{
        
//         $dbh = connect_to_db();

//         //prepare the sql statement
//         $stmt = $dbh->prepare('SELECT * FROM Users WHERE ' . $where_clause . ';');
//         $stmt -> execute($where_values);

//         if ($show_select_info) {echo 'User found';}

//         return $stmt->fetch(PDO::FETCH_ASSOC);

//     } catch(PDOException $e) {
//         // echo $e->getMessage();
//         return [];
//     }
// }

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

function select(string $columns, string $table, string $where_clause = '', array $where_values = [], bool $fetch_multiple_rows = false, string $order_by_column = '', string $order_by_direction = 'DESC', int $row_limit = 100): bool | array {
    $show_select_info = false;

    try{
        
        $dbh = connect_to_db();

        $query_string = 'SELECT ' . $columns . ' FROM ' . $table;
        
        if ($where_clause != '') {
            $query_string .= ' WHERE ' . $where_clause;
        }

        if ($order_by_column != '') {
            $query_string .= ' ORDER BY ' . $order_by_column . ' ' . $order_by_direction;
        }

        if ($row_limit != 100) {
            $query_string .= ' LIMIT ' . $row_limit;
        }

        $query_string .= ';';

        if ($show_select_info) {echo $query_string . '<br>';}
        //prepare the sql statement
        $stmt = $dbh->prepare($query_string);

        if ($where_clause != '' && !empty($where_values)) {
            $select_success = $stmt -> execute($where_values);
        } else {
            $select_success = $stmt -> execute();
        }

        if ($select_success) {
            if ($show_select_info) {echo 'Records found';}

            if ($fetch_multiple_rows) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }
        } else {
            return [];
        }

    } catch(Exception $e) {
        echo $e->getMessage();
        return [];
    }
}

function get_author_id(int $article_id): int {
    $columns = 'articleAuthorID';
    $table = 'Articles';
    $where_clause = 'articleID = :article_id';
    $where_values = [
        'article_id' => $_GET['viewArticle']
    ];

    $article_info = select($columns, $table, $where_clause, $where_values);

    $author_ID = $article_info['articleAuthorID'];

    return $author_ID;
}

function get_author_name_from_article_id(int $article_id): string {
    $columns = 'userName';
    $table = 'Users';
    $where_clause = 'userID = :user_id';
    $where_values = ['user_id' => get_author_id($article_id)];

    $user_info = select($columns, $table, $where_clause, $where_values);
    $author_name = $user_info['userName'];

    return $author_name;
}

function get_author_surname_from_article_id(int $article_id): string {
    $columns = 'userSurname';
    $table = 'Users';
    $where_clause = 'userID = :user_id';
    $where_values = ['user_id' => get_author_id($article_id)];

    $user_info = select($columns, $table, $where_clause, $where_values);
    $author_surname = $user_info['userSurname'];
    
    return $author_surname;
}

function get_comment_poster_info(int $comment_poster_id) {
    $columns = 'userID, userName, userSurname';
    $table = 'Users';
    $where_clause = 'userID = :user_id';
    $where_values = ['user_id' => $comment_poster_id];

    $comment_poster_info = select($columns, $table, $where_clause, $where_values);

    return $comment_poster_info;
}

function get_profile_picture_filename(int | null $user_id) {
    $columns = 'userProfilePictureFilename';
    $table = 'Users';
    $where_clause = 'userID = :user_id';
    $where_values = ['user_id' => $user_id];

    $user_info = select($columns, $table, $where_clause, $where_values);

    !empty($user_info) ? $user_exists = true : $user_exists = false;

    if ($user_exists && $user_info['userProfilePictureFilename'] != null) {
        $picture_filename = $user_info['userProfilePictureFilename'];
    } else {
        $picture_filename = 'pfp-placeholder.png';
    }
    
    return $picture_filename;
}

// EOF
