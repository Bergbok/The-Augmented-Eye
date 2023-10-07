<?php 
    // Purpose: Displays header.
    include_once 'Header.php'; 
?>

<html>
    <body>
        <?php
            if (isset($_GET["profileID"])) {
                // Purpose: Used to select user information for display on profile.
                include_once 'PHP Scripts/Database-Selects.php'; 

                $where_clause = "userID = :id";
                $where_values = [
                    'id' => $_GET["profileID"]
                ];

                $userInfo = selectUser($where_clause, $where_values);

                !empty($userInfo) ? $userExists = true : $userExists = false;

                if ($userExists) {
                    echoProfileInfo($userInfo);
                } else {
                    echoProfileNotFound();
                } 
            } else {
                echoProfileNotFound();
            }

            function echoProfileInfo(array $userInfo): void {
                echo "<title> ".$userInfo["userName"]." ".$userInfo["userSurname"]."'s Profile </title>";
                echo "<div class='centered-column centered-text pixel-text'>";
                echo "  <form type='POST'>";
                echo "      <h1> ".$userInfo["userName"]." ".$userInfo["userSurname"]."'s Profile </h1>";
                echo "      <p> Date Joined: ".$userInfo["userRegistrationDate"]." </p>";
                echo "      <br>";
                echo "      <p> Birthday: ".$userInfo["userBirthday"]." </p>";
                echo "      <p> Gender: ".$userInfo["userGender"]." </p>";
                echo "      <br>";
                echo "      <p> Contact Number: <a href='tel: ".$userInfo["userContactNo"]."'>".$userInfo["userContactNo"]."</a> </p>";
                echo "      <p> Email: <a href='mailto: ".$userInfo["userEmail"]."'>".$userInfo["userEmail"]."</a> </p>";
                echo "      <br>";
                if ($userInfo["userSubscribedToNewsletter"]) {
                    echo "  <p> This user is subscribed to the newsletter 💌 </p>";
                } else {
                    echo "  <p> This user isn't subscribed to the newsletter :( </p>";
                }
                echo "      <br>";

                // Purpose: Used to check if profile belongs to currently logged in user.
                include_once 'PHP Scripts/Login-Handler.php'; 

                if (isLoggedIn()) {
                    if ($_GET["profileID"] == $_SESSION["userID"]) {
                        echo "<div class='article-link'>";
                        echo "  <a class='dark-text' href='/The Augmented Eye/Change-Password'> Change Password </a>";
                        echo "  <br><br>";
                        echo "  <a class='dark-text' href='/The Augmented Eye/Logout'>Logout</a>";
                        echo "</div>";
                    }
                }
                echo "  </form>";
                echo "</div>";
            }
            function echoProfileNotFound(): void {
                echo "<h1 class='centered-text bright-text pixel-text'> User not found :( </h1>";
            }
        ?>
    </body>

</html>