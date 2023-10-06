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
    //         $stmt = $dbh->prepare("SELECT * FROM Users WHERE ".$where_clause.";");
    //         $stmt -> execute($where_values);

    //        if ($show_select_info) {echo 'Users found';}

    //         return $stmt->fetchAll(PDO::FETCH_ASSOC);

    //     } catch(PDOException $e) {

    //         echo $e->getMessage();
    //         return [];
    //     }
    // }

    function selectArticle($where_clause, $where_values) {
        $show_select_info = false;

        try{
            
            $dbh = connectToDB();

            //prepare the sql statement
            $stmt = $dbh->prepare("SELECT * FROM Articles WHERE ".$where_clause.";");
            $stmt -> execute($where_values);

           if ($show_select_info) {echo 'Article found';}

            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch(PDOException $e) {

            echo $e->getMessage();
            return [];
        }
    }

    function selectAllArticles($order_by_column, $order_by_direction, $row_limit) {
        $show_select_info = false;

        try{
            
            $dbh = connectToDB();

            //prepare the sql statement
            $stmt = $dbh->prepare("SELECT * FROM Articles ORDER BY ".$order_by_column ." ". $order_by_direction." LIMIT ".$row_limit."; <br>");

            if ($show_select_info) {echo 'Articles found';}

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

    function selectAdmin($userID) {
        $show_select_info = false;

        try{
            
            $dbh = connectToDB();

            //prepare the sql statement
            $stmt = $dbh->prepare("SELECT * FROM Admins WHERE userID = :id;");
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

    function getNewsletterSubcriberEmails() {
        $show_select_info = false;

        try{
            
            $dbh = connectToDB();

            //prepare the sql statement
            $stmt = $dbh->query("SELECT userEmail FROM Users WHERE userSubscribedToNewsletter = 1;");
            $stmt -> execute();

           if ($show_select_info) {echo 'Users found';}

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch(PDOException $e) {

            echo $e->getMessage();
            return [];

        }
    }

    function getAuthorID($article_ID) {
        $where_clause = "articleID = :id";
        $where_values = [
            'id' => $article_ID,
        ];

        $article_Info = selectArticle($where_clause, $where_values);
        $author_ID = $article_Info["articleAuthorID"];

        return $author_ID;
    }

    function getUserNameFromArticleID($article_ID) {
        $where_clause = "userID = :id";
        $where_values = [
            'id' => getAuthorID($article_ID),
        ];

        $userInfo = selectUser($where_clause, $where_values);
        $author_name = $userInfo["userName"];
        return $author_name;
    }

    function getUserSurnameFromArticleID($article_ID) {
        $where_clause = "userID = :id";
        $where_values = [
            'id' => getAuthorID($article_ID),
        ];

        $userInfo = selectUser($where_clause, $where_values);
        $author_surname = $userInfo["userSurname"];
        return $author_surname;
    }
?>