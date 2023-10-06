<?php include_once('Header.php'); ?>

<html>
    <head>
        <title> Home </title>
    </head>

    <body>
        <div class="centered-column pixel-text centered-text">
            <h1> Welcome to The Augmented Eye </h1>
            <div class='article-text centered-text'>
                <p > This recreation was made by <a href='https://github.com/Bergbok'> Albertus Cilliers </a> </p>
                <p > It's open source and available on Github <a href='https://github.com/Bergbok/The-Augmented-Eye'> here </a> </p>
            </div>
            <fieldset id='newest-article-preview'>
                <h2> Newest Articles </h2>
                <hr>
                <br>
                <div id="article-list">
                    <?php
                        include_once('PHP Scripts/Article-Display-Handler.php');
                        echoArticleLinks('articlePublishDate','DESC',3);
                        echo "<h2><a class='dark-text' href='/The Augmented Eye/News.php'> View More Here </a></h2>";
                        echo "<br>";
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