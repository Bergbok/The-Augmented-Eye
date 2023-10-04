<?php
    include_once("Database-Connection.php");
    function selectUser($where_clause, $where_values) {
        $show_select_info = false;

        try{
            
            $dbh = connectToDB();

            //prepare the sql statement
            $stmt = $dbh->prepare("SELECT * FROM Users WHERE ".$where_clause.";");
            $stmt -> execute($where_values);

           if ($show_select_info) {echo 'User found';}

            return $stmt->fetch();

        } catch(PDOException $e) {

            echo $e->getMessage();
            return [];
        }
    }

    function selectArticles($order_by_column, $order_by_direction, $row_limit) {
        $show_select_info = false;

        try{
            
            $dbh = connectToDB();

            //prepare the sql statement
            $stmt = $dbh->prepare("SELECT * FROM Articles ORDER BY ".$order_by_column ." ". $order_by_direction." LIMIT ".$row_limit."; <br>");

            if ($show_select_info) {}

            $stmt -> execute();

           if ($show_select_info) {
                echo ("SQL STRING: SELECT * FROM Articles ORDER BY ".$order_by_column ." ". $order_by_direction." LIMIT ".$row_limit."; <br>");
            }

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch(PDOException $e) {

            echo $e->getMessage();
            return [];
        }
    }

    function getUserNameFromID($author_ID) {
        $where_clause = "userID = :id";
        $where_values = [
            'id' => $author_ID,
        ];

        $userInfo = selectUser($where_clause, $where_values);
        $author_name = $userInfo["userName"];
        return $author_name;
    }
?>