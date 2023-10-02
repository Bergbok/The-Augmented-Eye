<html>

    <head>

        <title> Registration </title>
        <link rel="stylesheet" href="styles.css">

    </head>
    
    <?php include('Header.php'); ?>

    <body>
        <div class="center pixel-text">

            <!-- <h3> Registration </h3> -->

            <form method="POST">

                <fieldset>

                    <legend align="center">
                        <strong>Registration</strong>
                    </legend>

                    <label for="name">Name:</label>
                    <input type="text" id="name" name="newuser_Name"></input>

                    <br/><br/>

                    <label for="surname">Surname:</label>
                    <input type="text" id="surname" name="newuser_Surname"></input>

                    <br/><br/>

                    <label for="gender">Gender:</label>
                    <select id="gender" name="newuser_Gender">
                        <option>Male</option>
                        <option>Female</option>
                        <option>Other</option>
                    </select>      
                    
                    <br/><br/>

                    <label for="birthday">Birthday:</label>
                    <input type="date" id="birthday" name="newuser_Birthday"></input>

                    <br/><br/>

                    <label for="email">Email:</label>
                    <input type="text" id="email" name="newuser_Email"></input>

                    <br/><br/>

                    <label for="contact">Contact Number:</label>
                    <input type="number" id="contact" name="newuser_Contact"></input>

                    <br/><br/>

                    <!-- Sets newuser_ReceiveNewsletter to No by default -->
                    <?php
                        $_POST["newuser_ReceiveNewsletter"] = "No";
                    ?>

                    <label for="newsletter" id="newsletter">Receive newsletters via e-mail? </label>
                    <!-- <input type="hidden" id="newsletter_checkbox_false" value="No" name="newuser_ReceiveNewsletter" checked></input> -->
                    <input type="checkbox" id="newsletter_checkbox" name="newuser_ReceiveNewsletter" value="Yes"></input>

                    <br/><br/>

                    <input class="center submit-button" type="submit" value="Register"></input>

                </fieldset>
                    
                <?php
                    if (isset($_SERVER["REQUEST_METHOD"])){
                        if ($_SERVER["REQUEST_METHOD"] == "POST"){

                            $show_registration_errors = true;
                            $show_provided_registration_info = false;

                            $newuser_Name_isvalid = $newuser_Surname_isvalid = $newuser_Gender_isvalid = $newuser_Birthday_isvalid = $newuser_Email_isvalid = $newuser_Contact_isvalid = false;
                            
                            if ($show_provided_registration_info || $show_registration_errors == true) {
    
                                if (isset($_POST["newuser_Name"]) && $_POST["newuser_Name"] != null) {
                                    $newuser_Name_isvalid = true;
                                    if ($show_provided_registration_info == true){
                                        echo '<p class="error-message"> Provided name is: '.$_POST["newuser_Name"].'</p>';
                                    }
                                } elseif ($show_registration_errors == true) {
                                    echo '<p class="error-message"> Please enter your name </p>';   
                                }
    
                                if (isset($_POST["newuser_Surname"]) && $_POST["newuser_Surname"] != null) {
                                    $newuser_Surname_isvalid = true;
                                    if ($show_provided_registration_info == true){
                                        echo '<p class="error-message"> Provided surname is: '.$_POST["newuser_Surname"].'</p>';
                                    }
                                } elseif ($show_registration_errors == true) {
                                    echo '<p class="error-message"> Please enter your surname </p>';
                                }
    
                                if (isset($_POST["newuser_Gender"]) && $_POST["newuser_Gender"] != null) {
                                    $newuser_Gender_isvalid = true;
                                    if ($show_provided_registration_info == true){
                                        echo '<p class="error-message"> Provided gender is: '.$_POST["newuser_Gender"].'</p>';
                                    }
                                } elseif ($show_registration_errors == true) {
                                    echo '<p class="error-message"> Please enter your gender </p>';
                                }
    
                                if (isset($_POST["newuser_Birthday"]) && $_POST["newuser_Birthday"] != null) {
                                    $newuser_Birthday_isvalid = true;
                                    if ($show_provided_registration_info == true){
                                        echo '<p class="error-message"> Provided birthday is: '.$_POST["newuser_Birthday"].'</p>';
                                    }
                                } elseif ($show_registration_errors == true) {
                                    echo '<p class="error-message"> Please enter your birthday </p>';
                                }
    
                                if (isset($_POST["newuser_Email"]) && $_POST["newuser_Email"] != null) {
                                    $newuser_Email_isvalid = true;
                                    if ($show_provided_registration_info == true){
                                        echo '<p class="error-message"> Provided e-mail is: '.$_POST["newuser_Email"].'</p>';
                                    }
                                } elseif ($show_registration_errors == true) {
                                    echo '<p class="error-message"> Please enter your e-mail </p>';
                                }
    
                                if (isset($_POST["newuser_Contact"]) && $_POST["newuser_Contact"] != null) {
                                    $newuser_Contact_isvalid = true;
                                    if ($show_provided_registration_info == true){
                                        echo '<p class="error-message"> Provided contact is: '.$_POST["newuser_Contact"].'</p>';
                                    }
                                } elseif ($show_registration_errors == true) {
                                    echo '<p class="error-message"> Please enter your contact information </p>';
                                }
                                
                                if (isset($_POST["newuser_ReceiveNewsletter"]) && $_POST["newuser_ReceiveNewsletter"] != null) {
                                    if ($show_provided_registration_info == true){
                                        echo '<p class="error-message"> Provided newsletter choice is: '.$_POST["newuser_ReceiveNewsletter"].'</p>';
                                    }
                                } 
                                // elseif ($show_registration_errors == true) {
                                //     echo '<p class="error-message"> Provided newsletter choice is: No </p>';
                                // }
                                
                                //Inserting user into database
                                if ($newuser_Name_isvalid == true && $newuser_Surname_isvalid == true && $newuser_Gender_isvalid == true && $newuser_Birthday_isvalid == true && $newuser_Email_isvalid == true && $newuser_Contact_isvalid == true) {
                                    
                                    $hostname = 'localhost';
                                    $username = 'ODBC';
                                    $password = "";
                                    $dbname = 'TheAugmentedEye';
                                    $insert_logging = true;

                                    try{
                                        
                                        //Used in generatePassword function
                                        function getRandomBytes($nbBytes = 32)
                                        {
                                            $bytes = openssl_random_pseudo_bytes($nbBytes, $strong);
                                            if ($bytes !== false && $strong === true) {
                                                return $bytes;
                                            }
                                            else {
                                                throw new Exception("Unable to generate secure token from OpenSSL.");
                                            }
                                        }

                                        //Used to generate a random password
                                        function generatePassword($length){
                                            return substr(preg_replace("/[^a-zA-Z0-9]/", "", base64_encode(getRandomBytes($length+1))),0,$length);
                                        }

                                        $dbh = new PDO("mysql:host=$hostname;dbname=$dbname",$username,$password);

                                        if ($insert_logging) {echo 'Connected successfully<br/>';}

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
                                            'newuser_ReceiveNewsletter' => $_POST["newuser_ReceiveNewsletter"],
                                        ];
                                        
                                        if ($insert_logging) {
                                            echo "Trying to insert values: <br>";
                                            foreach ($data as $key => $value) {
                                                echo "$key: $value<br>";
                                            }
                                        }
                                    
                                        $stmt->execute($data);

                                        if ($insert_logging) {echo 'New records created successfully';}

                                    }catch(PDOException $e){

                                        echo $e->getMessage();

                                    }
                                }
                            }
                        }
                        
                    }
                ?>
            </form>      
        </div>

    </body>

</html>