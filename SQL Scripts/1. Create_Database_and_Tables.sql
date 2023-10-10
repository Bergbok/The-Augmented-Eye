 /*=============================================================
Filename: 1. Create_Database_And_Tables.sql
Author: Albertus Cilliers
Description: This file will create the database and tables with the necessary constraints.
=============================================================*/

DROP DATABASE IF EXISTS the_augmented_eye;
CREATE DATABASE the_augmented_eye;

USE the_augmented_eye;

CREATE TABLE users
(
	user_id INT NOT NULL AUTO_INCREMENT,
    user_password VARCHAR(30) NOT NULL,
	user_name VARCHAR(30) NOT NULL,
	user_surname VARCHAR(30) NOT NULL,
	user_gender VARCHAR(30) NOT NULL,
    user_birthday DATE NOT NULL,
    user_email VARCHAR(100) NOT NULL,
    user_contact_num VARCHAR(10) NOT NULL,
    user_subscribed_to_newsletter BOOL NOT NULL,
    user_registration_datetime DATETIME NOT NULL,    
    user_profile_picture_filename VARCHAR(100),
	PRIMARY KEY (user_id)
);

CREATE TABLE admins
(
	admin_id INT NOT NULL AUTO_INCREMENT,
	user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    PRIMARY KEY (admin_id)
);

CREATE TABLE articles
(
	article_id INT NOT NULL AUTO_INCREMENT,
    article_author_id INT NOT NULL,
	article_title VARCHAR(150) NOT NULL,
    article_text TEXT NOT NULL,
    article_publish_datetime DATETIME NOT NULL,
    article_view_count INT NOT NULL DEFAULT 0, 
    FOREIGN KEY (article_author_id) REFERENCES users(user_id),
	PRIMARY KEY (article_id)
);

CREATE TABLE comments
(
	comment_id INT NOT NULL AUTO_INCREMENT,
    article_id INT NOT NULL,
    comment_poster_id INT NOT NULL,
    comment_text TEXT,
    comment_post_date DATETIME NOT NULL,
    FOREIGN KEY (comment_poster_id) REFERENCES users(user_id),
    FOREIGN KEY (article_id) REFERENCES articles(article_id),
    PRIMARY KEY (comment_id)
);