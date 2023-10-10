<!-- 
    Filename: Profile-Preview.php
    Author: Albertus Cilliers   
    Description: Displays welcome message and user options on the left side of the header.
 -->

<html> 
    <body>
        <div class='pixel-text bright-text'>
            <!-- <img class='pfp-preview top-left' src='/The Augmented Eye/Images/pfp-placeholder.png'></img> -->
            <?php
                if (isset($_SESSION['userName']) && $_SESSION['userName'] != null) {
                    echo '<img class=\'pfp-preview top-left\' src=\'/The Augmented Eye/PHP Scripts/Get-Picture?userID=' . $_SESSION['userID'] . '\'>';
                    echo '<li class=\'dropdown bright-text top-left\'>';
                    echo '  <p>Welcome back, ' . $_SESSION['userName'] . '</p>';
                    echo '  <ul class=\'dropdown-items\'>';
                    echo '      <li><a class=\'bright-text\' href=\'/The Augmented Eye/Profile?profileID=' . $_SESSION['userID'] . '\'>View Profile</a></li>';
                    echo '      <li><a class=\'bright-text\' href=\'/The Augmented Eye/Change-Password\'>Change Password</a></li>';
                    echo '      <li><a class=\'bright-text\' href=\'/The Augmented Eye/Logout\'>Logout</a></li>';
                    echo '  </ul>';
                    echo '</li>';
                } else {
                    echo '<img class=\'pfp-preview top-left\' src=\'/The Augmented Eye/Images/pfp-placeholder.png\'>';
                    echo '<a class=\'top-left bright-text\' href=\'/The Augmented Eye/Login\'><u>Login / Register</u></a>';
                }
                echo '</img>';
            ?>
        </div>
    </body>
</html>