<?php

/**
 * Filename: About.php
 * Author: Albertus Cilliers  
 * Description: Used to create a connection to the database.
 */

 /**#######################################################################*/

function connect_to_db(): PDO {
    $show_connection_info = false;

    $db_hostname = 'localhost';
    $db_username = 'username';
    $db_password = 'password';
    $db_name = 'the_augmented_eye';

    $dsn = 'mysql:host=' . $db_hostname . ';dbname=' . $db_name;
    $dbh = new PDO($dsn,$db_username,$db_password);

    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 

    if ($show_connection_info) {echo 'Connected successfully<br/>';}
    
    return $dbh;
}

/**#######################################################################*/

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

/**#######################################################################*/

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

function get_article_author_name(int $article_author_id, string $name_scope = 'full'): string {
    $columns = 'user_name, user_surname';
    $table = 'users';
    $where_clause = 'user_id = :user_id';
    $where_values = ['user_id' => $article_author_id];

    $user_info = select($columns, $table, $where_clause, $where_values);

    switch ($name_scope) {
        case 'first':
        case 'firstname':
            $author_name = $user_info['user_name'];
            break;
        case 'last':
        case 'final':
        case 'surname':
        case 'lastname':
            $author_name = $user_info['user_surname'];
            break;
        case 'full':
            $author_name = $user_info['user_name'] . ' ' . $user_info['user_surname'];
            break;
        default:
            $author_name = $user_info['user_name'] . ' ' . $user_info['user_surname'];
            break;
    }

    return $author_name;
}

function get_gallery_author_name(int $gallery_author_id, string $name_scope = 'full'): string {
    $columns = 'user_name, user_surname';
    $table = 'users';
    $where_clause = 'user_id = :user_id';
    $where_values = ['user_id' => $gallery_author_id];

    $user_info = select($columns, $table, $where_clause, $where_values);

    switch ($name_scope) {
        case 'first':
        case 'firstname':
            $author_name = $user_info['user_name'];
            break;
        case 'last':
        case 'final':
        case 'surname':
        case 'lastname':
            $author_name = $user_info['user_surname'];
            break;
        case 'full':
            $author_name = $user_info['user_name'] . ' ' . $user_info['user_surname'];
            break;
        default:
            $author_name = $user_info['user_name'] . ' ' . $user_info['user_surname'];
            break;
    }

    return $author_name;
}

function get_comment_poster_info(int $comment_poster_id) {
    $columns = 'user_id, user_name, user_surname';
    $table = 'users';
    $where_clause = 'user_id = :user_id';
    $where_values = ['user_id' => $comment_poster_id];

    $comment_poster_info = select($columns, $table, $where_clause, $where_values);

    return $comment_poster_info;
}

/**#######################################################################*/

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

function increment_gallery_viewcount(int $gallery_id): bool {
    $set_clause = 'gallery_view_count = gallery_view_count + 1';

    $where_clause = 'gallery_id = :gallery_id';

    $data = [
        'gallery_id' => $gallery_id
    ];

    return update('galleries', $set_clause, $where_clause, $data);
}

// EOF
