<html> 
    <head>

        <!-- <link rel="stylesheet" href="styles.css"> -->

    </head>
    <body>
        <div class="pixel-text bright-text">
            <img class="pfp-preview top-left" src="/The Augmented Eye/Images/pfp-placeholder.png"></img>
            <?php
                if (isset($_SESSION["userName"])) {
                    echo "<li class='dropdown bright-text top-left'>
                            <p>Welcome back, ".$_SESSION["userName"]."</p>
                            <ul class='dropdown-items'>
                                <li><a class='bright-text' href='/The Augmented Eye/Profile.php?profileID=".$_SESSION["userID"]."'>View Profile</a></li>
                                <li><a class='bright-text' href='/The Augmented Eye/Change-Password.php'>Change Password</a></li>
                                <li><a class='bright-text' href='/The Augmented Eye/Logout.php'>Logout</a></li>
                            </ul>
                            </li>";
                } else {
                    echo "<a class='top-left bright-text' href='/The Augmented Eye/Login.php'><u>Login / Register</u></a>";
                }
            ?>
        </div>
    </body>
</html>