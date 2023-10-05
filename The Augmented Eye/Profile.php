<?php
    include_once('Header.php'); 
?>

<html>

    <head>

        <link rel="stylesheet" href="styles.css">

    </head>

    <body>
        <?php
            if (isset($_GET["profileID"])) {
                include_once('PHP Scripts/Database-Selects.php'); 
                $where_clause = "userID = :id";
                $where_values = [
                    'id' => $_GET["profileID"]
                ];

                $userInfo = selectUser($where_clause, $where_values);

                !empty($userInfo) ? $userExists = true : $userExists = false;

                if ($userExists) {
                    echo "<title> ".$userInfo["userName"]." ".$userInfo["userSurname"]."'s Profile </title>";
                    echo "<div class='center pixel-text'>";
                    echo "  <form type='POST'>";
                    echo "      <h1> ".$userInfo["userName"]." ".$userInfo["userSurname"]."'s Profile </h1>";
                    echo "      <p> Date Joined: ".$userInfo["userRegistrationDate"]." </p>";
                    echo "      <br>";
                    echo "      <p> Birthday: ".$userInfo["userBirthday"]." </p>";
                    echo "      <p> Gender: ".$userInfo["userGender"]." </p>";
                    echo "      <br>";
                    echo "      <p> Contact Number: ".$userInfo["userContactNo"]." </p>";
                    echo "      <p> Email: ".$userInfo["userEmail"]." </p>";
                    echo "      <p> Password: ".$userInfo["userPassword"]." </p>";
                    echo "      <br>";

                    if ($userInfo["userSubscribedToNewsletter"]) {
                        echo "  <p> This user is subscribed to the newsletter 💌 </p>";
                    } else {
                        echo "  <p> This user isn't subscribed to the newsletter :( </p>";
                    }
                    echo "      <br>";

                    include_once('PHP Scripts/Login-Handler.php'); 
                    if (isLoggedIn()) {
                        if ($_GET["profileID"] == $_SESSION["userID"]) {
                            echo "<div class='article-link'>";
                            echo "  <a class='dark-text' href='Change-Password.php'> Change Password </a>";
                            echo "  <br><br>";
                            echo "  <a class='dark-text' href='Logout.php'>Logout</a>";
                            echo "</div>";
                        }
                    }
                    echo "  </form>";
                    echo "</div>";
                } else {
                    echo "<div class='center pixel-text'>";
                    echo "  <form>";
                    echo "      <h1><strong> User not found :( </strong></h1>";
                    echo "  </form>";
                    echo "</div>";
                } 
            } else {
                include_once("PHP Scripts/Login-Handler.php");
                if (isLoggedIn()) {
                    header("Location: Profile.php?profileID=".$_SESSION["userID"]);
                } else {
                    header("Location: Home.php");
                }
            }
        ?>
    </body>

</html>