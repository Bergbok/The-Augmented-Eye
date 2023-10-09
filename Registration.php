<!-- 
    Filename: Registration.php
    Author: Albertus Cilliers   
    Description: Lets the user create a new account.
 -->

<?php 
    // Purpose: Displays header.
    include_once 'Header.php'; 
?>

<html>
    <head>
        <title> Registration </title>
    </head>

    <body>
        <div class='centered-column pixel-text'>
             <form method='POST' enctype='multipart/form-data'>
                <fieldset>

                    <legend class='center'>
                        <strong>Registration</strong>
                    </legend>

                    <label for='name'>Name:</label>
                    <input type='text' id='name' name='newuser_Name'></input>

                    <br/><br/>

                    <label for='surname'>Surname:</label>
                    <input type='text' id='surname' name='newuser_Surname'></input>

                    <br/><br/>

                    <label for='gender'>Gender:</label>
                    <select id='gender' name='newuser_Gender'>
                        <option>Male</option>
                        <option>Female</option>
                        <option>Other</option>
                    </select>      
                    
                    <br/><br/>

                    <label for='birthday'>Birthday:</label>
                    <input type='date' id='birthday' name='newuser_Birthday'></input>

                    <br/><br/>

                    <label for='email'>Email:</label>
                    <input type='text' id='email' name='newuser_Email'></input>

                    <br/><br/>

                    <label for='contact'>Contact Number:</label>
                    <input type='number' id='contact' name='newuser_Contact'></input>

                    <br/><br/>

                    <!-- Sets newuser_ReceiveNewsletter to No by default -->
                    <?php
                        // $_POST['newuser_ReceiveNewsletter'] = 'No';
                    ?>

                    <label for='newsletter' id='newsletter'>Receive newsletters via e-mail? </label>
                    <input type='checkbox' id='newsletter_checkbox' name='newuser_ReceiveNewsletter' value='Yes'></input>

                    <br/><br/>

                    <label for='profile_picture'>Profile Picture:</label>
                    <input type='file' id='profile_picture' name='new_profile_picture'></input>

                    <br/><br/>

                    <input class='submit-button' type='submit' value='Register' name='Register'></input>

                </fieldset>
                    
                <?php         
                    if (isset($_REQUEST['Register'])) {
                        // Purpose: Used to validate registration information.
                        include_once 'PHP Scripts/Form-Validation.php';

                        if (validate_registration()) {
                            // Purpose: Used to generate passwords for new users.
                            include_once 'PHP Scripts/Password-Generator.php';
                            // Purpose: Used to insert new user into database.
                            include_once 'PHP Scripts/Database-Inserts.php';

                            $column_names = 'userPassword, userName, userSurname, userGender, userBirthday, userEmail, userContactNo, userSubscribedToNewsletter, userRegistrationDate';

                            $values_clause = ':new_user_password, :newuser_Name, :newuser_Surname, :newuser_Gender, :newuser_Birthday, :newuser_Email, :newuser_Contact, :newuser_ReceiveNewsletter, :newuser_RegistrationDate';
                            
                            $data = [
                                'new_user_password' => generate_password(30),
                                'newuser_Name' => $_POST['newuser_Name'],
                                'newuser_Surname' => $_POST['newuser_Surname'],
                                'newuser_Gender' => $_POST['newuser_Gender'],
                                'newuser_Birthday' => $_POST['newuser_Birthday'],
                                'newuser_Email' => $_POST['newuser_Email'],
                                'newuser_Contact' => $_POST['newuser_Contact'],
                                'newuser_ReceiveNewsletter' => $_POST['newuser_ReceiveNewsletter'] ?? 'No',
                                'newuser_RegistrationDate' => date('Y-m-d H:i:s')
                            ];

                            if (insert('Users', $column_names, $values_clause, $data)) {
                                // Purpose: Used to email password to user upon successful registration.
                                include_once 'PHP Scripts/Email-Handler.php';

                                if (send_password()) {
                                    echo '<div class=\'centered-text\'>';
                                    echo '  <p> Successfully created account, check your email for your password. </p>';
                                    echo '  <a class=\'dark-text\' href=\'/The Augmented Eye/Login\'> LOGIN </a>';
                                    echo '</div>';
                                } else {
                                    echo '<div class=\'centered-text\'>';
                                    echo '  <p> Successfully created account, couldn\'t send you your password via email though :( </p>';
                                    echo '  <a class=\'dark-text\' href=\'/The Augmented Eye/Login\'> LOGIN </a>';
                                    echo '</div>';
                                }

                                if (isset($_FILES['new_profile_picture']) && $_FILES['new_profile_picture']['error'] == 0) {
                                    // Purpose: Used to upload profile picture to FTP server.
                                    include_once 'PHP Scripts/FTP-Handler.php';
        
                                    upload_profile_picture_from_registration($_POST['newuser_Email']);
                                }
                            } else {
                                echo '<p> Couldn\'t create account </p>';
                            }
                        }
                    }
                ?>
            </form>      
        </div>
    </body>
</html>