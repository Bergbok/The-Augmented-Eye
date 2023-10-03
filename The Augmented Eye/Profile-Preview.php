<html> 
    <head>

        <link rel="stylesheet" href="styles.css">

    </head>
    <body>
        <div class="pixel-text bright-text">
            <img class="pfp-preview top-left" src="Images/pfp-placeholder.png"></img>
            <?php
                if (isset($_SESSION["userName"])) {
                    echo "<li class='dropdown bright-text top-left'>
                            <p>Welcome back, ".$_SESSION["userName"]."</p>
                            <ul class='dropdown-items'>
                                <li><a class='bright-text' href='Profile.php'>View Profile</a></li>
                                <li><a class='bright-text' href='Logout.php'>Logout</a></li>
                            </ul>
                           </li>";
                } else {
                    echo "<a class='top-left bright-text' href='Login.php'><u>Login</u></a>";
                }
            ?>
        </div>
    </body>
</html>