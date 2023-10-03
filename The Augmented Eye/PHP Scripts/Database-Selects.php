<?php
    include("Database-Authentication-Info.php");
    function selectUser($where_clause, $where_values) {
        $show_select_info = false;

        global $db_hostname, $db_username, $db_password, $db_name;

        try{
            
            $dbh = new PDO("mysql:host=$db_hostname;dbname=$db_name",$db_username,$db_password);

            if ($show_select_info) {echo 'Connected successfully<br/>';}

            $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);                 

            //prepare the sql statement
            $stmt = $dbh->prepare("SELECT * FROM Users WHERE ".$where_clause.";");
            $stmt -> execute($where_values);

           // if ($show_select_info) {echo 'User selected successfully <br> Query result: <br>'.$dbh->query($sql);}

            return $stmt->fetch();

        } catch(PDOException $e) {

            echo $e->getMessage();
            return [];
        }
    }
?>