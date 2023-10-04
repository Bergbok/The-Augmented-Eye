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
?>