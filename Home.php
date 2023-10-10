<!-- 
    Filename: Home.php
    Author: Albertus Cilliers   
    Description: Home page, didn't really know what to include here, ended up deciding on a simple welcome message,
                 brief description of this project, 3 newest articles and a BEEFBRAIN SHIELD PRO sticker cause I think it's funny.
 -->

<?php 
    // Purpose: Displays header.
    include_once 'Header.php'; 
?>

<html>
    <head>
        <title> Home </title>
    </head>

    <body>
        <div class='centered-column pixel-text centered-text'>
            <h1> Welcome to The Augmented Eye </h1>
            <div class='article-text centered-text'>
                <p > This recreation was made by <a href='https://github.com/Bergbok'> Albertus Cilliers </a> </p>
                <p > It's open source and available on Github <a href='https://github.com/Bergbok/The-Augmented-Eye'> here </a> </p>
            </div>
            <fieldset id='newest-article-preview'>
                <h2> Newest Articles </h2>
                <hr>
                <br>
                <div id='article-list'>
                    <?php
                        // Purpose: Used to display a preview of the 3 newest articles.
                        include_once 'PHP Scripts/Article-Display-Handler.php';
                        show_article_links('articlePublishDate','DESC',3);
                        echo '<h2><a class=\'dark-text\' href=\'/The Augmented Eye/News\'> View More Here </a></h2>';
                        echo '<br>';
                    ?>
                </div>
            </fieldset>
            <br><br>
            <a href='https://hypnospace.fandom.com/wiki/Beefbrain'>
                <img width=30% src='/The Augmented Eye/Images/beefbrainshieldbadge.webp' alt='This brain is protected by BEEFBRAIN SHIELD PRO'></img>
            </a>
        </div>
    </body>

</html>