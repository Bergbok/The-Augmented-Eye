<?php
    include("Database-Authentication-Info.php");
    function insertUser() {
        $show_insert_info = true;

        global $db_hostname, $db_username, $db_password, $db_name;

        try{
            
            include("generatePassword.php");

            $dbh = new PDO("mysql:host=$db_hostname;dbname=$db_name",$db_username,$db_password);

            if ($show_insert_info) {echo 'Connected successfully<br/>';}

            $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);                 

            //prepare the sql statement
            $stmt = $dbh->prepare("INSERT INTO Users (userPassword, userName, userSurname, userGender, userBirthday, userEmail, userContactNo, userSubscribedToNewsletter)
            VALUES (:userPassword, :newuser_Name, :newuser_Surname, :newuser_Gender, :newuser_Birthday, :newuser_Email, :newuser_Contact, :newuser_ReceiveNewsletter)");
            
            $data = [
                'userPassword' => generatePassword(30),
                'newuser_Name' => $_POST["newuser_Name"],
                'newuser_Surname' => $_POST["newuser_Surname"],
                'newuser_Gender' => $_POST["newuser_Gender"],
                'newuser_Birthday' => $_POST["newuser_Birthday"],
                'newuser_Email' => $_POST["newuser_Email"],
                'newuser_Contact' => $_POST["newuser_Contact"],
                'newuser_ReceiveNewsletter' => $_POST["newuser_ReceiveNewsletter"] ?? "No",
            ];
            
                if ($show_insert_info) {
                echo "Trying to insert values: <br>";
                foreach ($data as $key => $value) {
                    echo "$key: $value<br>";
                }
            }
        
            $stmt->execute($data);

            if ($show_insert_info) {echo 'New records created successfully';}

        }catch(PDOException $e){

            echo $e->getMessage();

        }
    }
?>