<?php

/**
 * Filename: Database-Handler.php
 * Author: Albertus Cilliers  
 * Description: Used to create a connection to the database.
 */

 /**#######################################################################*/

/** Establishes a connection to the database.
 * @return PDO Represents a connection to the database server.
 */
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

/**
 * Inserts a row into the database.
 * @param string $table Valid values: admins, article_tags, articles, comments, galleries, tags, users
 * @param string $column_names Column names you want to insert into
 * @param string $prepared_statement Prepared statement using either syntax: (?, ?, ?) OR (:key => value)
 * @param array $values Array of values you want to insert
 * 
 * @return bool Returns true on success or false on failure.
 */
function insert(string $table, string $column_names, string $prepared_statement, array $values): bool {
    $show_insert_info = false;

    try{
        $dbh = connect_to_db();

        //prepare the sql statement
        $stmt = $dbh->prepare('INSERT INTO ' . $table . ' (' . $column_names . ')
        VALUES (' . $prepared_statement . ');');
        
        if ($show_insert_info) {
            echo 'Trying to insert values: <br>';
            foreach ($values as $key => $value) {
                echo $key . ':' . $value . '<br>';
            }
        }
    
        if ($stmt->execute($values)) {
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

/**
 * Selects rows from the databse
 * @param string $columns Specific columns you want to select OR *
 * @param string $table Valid values: admins, article_tags, articles, comments, galleries, tags, users
 * @param string $where_clause Row filter
 * @param array $where_values Needed if $where_clause is specified, array of values to use for filter
 * @param bool $fetch_multiple_rows Whether or not multiple rows must try to be selected
 * @param string $order_by_column What columns to order the rows by
 * @param string $order_by_direction What direction to order the rows by (ASC | DESC)
 * @param int $row_limit Max amount of rows to retrieve
 * 
 * @return bool | array Returns false or an empty array on failure or an array of row data on success.
 */
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

/**
 * Gets the author name for a given article author ID
 * @param int $article_author_id ID of authors name to get
 * @param string $name_scope Valid values: full, (first, firstname), (last, final, surname, lastname)
 * 
 * @return string Returns article author name
 */
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

/**
 * Gets the author name for a given gallery author ID
 * @param int $gallery_author_id ID of authors name to get
 * @param string $name_scope Valid values: full, (first, firstname), (last, final, surname, lastname)
 * 
 * @return string Returns gallery author name
 */
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

/**
 * Gets information of user for a given comment poster ID
 * @param int $comment_poster_id ID of comment poster
 * 
 * @return array Returns an array containing database row information about comment poster
 */
function get_comment_poster_info(int $comment_poster_id): array {
    $columns = 'user_id, user_name, user_surname';
    $table = 'users';
    $where_clause = 'user_id = :user_id';
    $where_values = ['user_id' => $comment_poster_id];

    $comment_poster_info = select($columns, $table, $where_clause, $where_values);

    return $comment_poster_info;
}

/**#######################################################################*/

/**
 * Updates a row in the database.
 * @param string $table Valid values: admins, article_tags, articles, comments, galleries, tags, users
 * @param string $set_clause What columns you want to set to which values
 * @param string $where_clause Row filter
 * @param array $values Values you want to set
 * 
 * @return bool Returns true on success or false on failure.
 */
function update(string $table, string $set_clause, string $where_clause, array $values): bool {
    $show_update_info = false;

    try{
        $dbh = connect_to_db();

        //prepare the sql statement
        $stmt = $dbh->prepare('UPDATE ' . $table . ' SET ' . $set_clause . ' WHERE ' . $where_clause . ';');
        
        if ($show_update_info) {
            echo 'Trying to update values: <br>';
            foreach ($values as $key => $value) {
                echo $key . ':' . $value . '<br>';
            }
        }
        
        if ($stmt->execute($values)) {
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

/**
 * Increases the view count of a article by 1
 * @param int $article_id Article ID of the article's view count to increment 
 * 
 * @return bool Returns true on success or false on failure.
 */
function increment_article_view_count(int $article_id): bool {
    $set_clause = 'article_view_count = article_view_count + 1';

    $where_clause = 'article_id = :article_id';

    $values = [
        'article_id' => $article_id
    ];

    return update('articles', $set_clause, $where_clause, $values);
}

/**
 * Increases the view count of a gallery by 1
 * @param int $gallery_id Gallery ID of the gallery's view count to increment 
 * 
 * @return bool Returns true on success or false on failure.
 */
function increment_gallery_view_count(int $gallery_id): bool {
    $set_clause = 'gallery_view_count = gallery_view_count + 1';

    $where_clause = 'gallery_id = :gallery_id';

    $values = [
        'gallery_id' => $gallery_id
    ];

    return update('galleries', $set_clause, $where_clause, $values);
}

// EOF
