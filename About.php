<!-- 
    Filename: About.php
    Author: Albertus Cilliers   
    Description: Show misc. information about this project and employees of The Augmented Eye.
 -->

<?php 
    // Purpose: Displays header.
    include_once 'Header.php'; 
?>

<html>

    <head>
        <title> Login </title>
    </head>

    <body>
        <div class='centered-column pixel-text'>
            <div class='centered-text'>
                <h1> About </h1>
                <p> The Augmented Eye is a digital news source from the game </p>
                <p> VA-11 Hall-A: Cyberpunk Bartender Action </p>
                <iframe src='https://store.steampowered.com/widget/447530/' frameborder='0'></iframe>
            </div>
            <div class='article-text'>
                <p> One of the project options for a PHP course I did was to create a news website, at the time I was playing through VA-11 HALL-A and I thought recreating The Augmented Eye could be more fun than simply creating a basic news website. </p>
                <p> The website comes preloaded with a bunch of (but not all) articles from the game, written by Fernando Damas, obtained from the <a href='https://va11halla.fandom.com/wiki/The_Augmented_Eye'> wiki</a></p>
            </div>
            <div id='staff'>
                <h1 class='centered-text'> Meet the Staff </h1>
                <figure id='donovan' class='center staff-border'>
                    <img class='staff-image' src='/The Augmented Eye/Images/Staff/Donovan.webp'></img>
                    <hr>
                    <figcaption class='centered-text'><a href='/The Augmented Eye/Profile?profileID=3'> Donovan D. Dawson </a></figcaption>
                    <hr>
                    <b><p class='centered-text'> Owner and CEO of The Augmented Eye </p></b>
                    <p style='padding:15px;'> Donovan has a very crude personality and is often one to speak his mind. He states that he cheats on his wife almost as much as she cheats on him </p>
                </figure>
                <br>
                <figure id='kimberly' class='center staff-border'>
                    <img class='staff-image' src='/The Augmented Eye/Images/Staff/Kimberly.webp'></img>
                    <hr>
                    <figcaption class='centered-text'><a href='/The Augmented Eye/Profile?profileID=1'> Kimberly La Vallete </a></figcaption>
                    <hr>
                    <b><p class='centered-text'> Writer </p></b>
                    <p style='padding:15px;'> Kim is a somewhat short woman with tanned skin and red eyes. Exclusively wears a white striped turtle-neck jumper and red-rimmed glasses. <br><br> Journalism wasn't her first preference in college, it was robotics, but since she couldn't get into the course, she settled for journalism. </p>
                </figure>
                <br>
                <figure id='lana' class='center staff-border'>
                    <figcaption style='padding-top: 10px;' class='centered-text'><a href='/The Augmented Eye/Profile?profileID=2'> Lana Smithee </a></figcaption>
                    <hr>
                    <b><p class='centered-text'> Writer(s) </p></b>
                    <p style='padding:15px;'> You don't really think Lana Smithee is just one person, do you? - <a href='/The Augmented Eye/Profile?profileID=3'> Donovan D. Dawson </a></p>
                </figure>
                <br>
            </div>
        </div>
    </body>
</html>