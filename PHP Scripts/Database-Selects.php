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

function get_author_name(int $article_author_id, string $name_scope = 'full'): string {
    $columns = 'userName, userSurname';
    $table = 'Users';
    $where_clause = 'userID = :user_id';
    $where_values = ['user_id' => $article_author_id];

    $user_info = select($columns, $table, $where_clause, $where_values);

    switch ($name_scope) {
        case 'first':
        case 'firstname':
            $author_name = $user_info['userName'];
            break;
        case 'last':
        case 'final':
        case 'surname':
        case 'lastname':
            $author_name = $user_info['userSurname'];
            break;
        case 'full':
            $author_name = $user_info['userName'] . ' ' . $user_info['userSurname'];
            break;
        default:
            $author_name = $user_info['userName'] . ' ' . $user_info['userSurname'];
            break;
    }

    return $author_name;
}

function get_comment_poster_info(int $comment_poster_id) {
    $columns = 'userID, userName, userSurname';
    $table = 'Users';
    $where_clause = 'userID = :user_id';
    $where_values = ['user_id' => $comment_poster_id];

    $comment_poster_info = select($columns, $table, $where_clause, $where_values);

    return $comment_poster_info;
}

// EOF
