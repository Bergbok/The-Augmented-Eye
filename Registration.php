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

                    <label class='required' for='name'>Name:</label>
                    <input required  type='text' id='name' name='new_user_name'></input>

                    <br/><br/>

                    <label class='required' for='surname'>Surname:</label>
                    <input required  type='text' id='surname' name='new_user_surname'></input>

                    <br/><br/>

                    <label class='required' for='gender'>Gender:</label>
                    <select id='gender' name='new_user_gender'>
                        <option>Male</option>
                        <option>Female</option>
                        <option>Other</option>
                    </select>      
                    
                    <br/><br/>

                    <label class='required' for='birthday'>Birthday:</label>
                    <input required  type='date' id='birthday' name='new_user_birthday'></input>

                    <br/><br/>

                    <label class='required' for='email'>Email:</label>
                    <input required  type='text' id='email' name='new_user_email'></input>

                    <br/><br/>

                    <label for='contact'>Contact Number:</label>
                    <input type='number' id='contact' name='new_user_contact_num'></input>

                    <br/><br/>

                    <!-- Sets new_user_subscribed_to_newsletter to No by default -->
                    <?php
                        // $_POST['new_user_subscribed_to_newsletter'] = 'No';
                    ?>

                    <label for='newsletter' class='checkbox-label'>Receive newsletters via e-mail? </label>
                    <input type='checkbox' class='checkbox' name='new_user_subscribed_to_newsletter' value='Yes'></input>

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
                            include_once 'PHP Scripts/Database-Handler.php';

                            $columns = '*';
                            $table = 'users';
                            $where_clause = 'user_email = :user_email';
                            $where_values = [
                                'user_email' => $_POST['new_user_email']
                            ];
                        
                            $user_info = select($columns, $table, $where_clause, $where_values);
            
                            !empty($user_info) ? $user_exists = true : $user_exists = false;

                            if ($user_exists) {
                                echo '<p class=\'error-message\'> Existing account found for provided email, could not create account </p>';
                            } else {
                                $column_names = 'user_password, user_name, user_surname, user_gender, user_birthday, user_email, user_contact_num, user_subscribed_to_newsletter, user_registration_datetime';

                                $prepared_statement = ':new_user_password, :new_user_name, :new_user_surname, :new_user_gender, :new_user_birthday, :new_user_email, :new_user_contact_num, :new_user_subscribed_to_newsletter, :newuser_RegistrationDate';
                                
                                $values = [
                                    'new_user_password' => generate_password(mt_rand(15,30)),
                                    'new_user_name' => $_POST['new_user_name'],
                                    'new_user_surname' => $_POST['new_user_surname'],
                                    'new_user_gender' => $_POST['new_user_gender'],
                                    'new_user_birthday' => $_POST['new_user_birthday'],
                                    'new_user_email' => $_POST['new_user_email'],
                                    'new_user_contact_num' => $_POST['new_user_contact_num'],
                                    'new_user_subscribed_to_newsletter' => $_POST['new_user_subscribed_to_newsletter'] ?? 'No',
                                    'newuser_RegistrationDate' => date('Y-m-d H:i:s')
                                ];
    
                                if (insert('users', $column_names, $prepared_statement, $values)) {
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
            
                                        upload_profile_picture_from_registration($_POST['new_user_email']);
                                    }
                                } else {
                                    echo '<p class=\'error-message\'> Couldn\'t create account </p>';
                                }
                            }
                        }
                    }
                ?>
            </form>      
        </div>
    </body>
</html>