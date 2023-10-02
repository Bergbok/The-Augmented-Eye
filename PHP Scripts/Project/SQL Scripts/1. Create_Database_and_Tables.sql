 /*=============================================================
Filename: Create_Database_And_Tables.sql
Programmer: Albertus Cilliers
Description: This file will create the database and tables with the necessary constraints.
=============================================================*/

DROP DATABASE IF EXISTS TheAugmentedEye;
CREATE DATABASE TheAugmentedEye;

USE TheAugmentedEye;

CREATE TABLE Users
(
	userID INT NOT NULL AUTO_INCREMENT,
	userName VARCHAR(30) NOT NULL,
	userSurname VARCHAR(30) NOT NULL,
	userGender VARCHAR(30) NOT NULL,
    userBirthday DATE NOT NULL,
    userEmail VARCHAR(30) NOT NULL,
    userContactNo VARCHAR(10) NOT NULL,
    userSubscribedToNewsletter BOOL NOT NULL,
	PRIMARY KEY (userID)
);

-- CREATE TABLE Manufacturers
-- (
-- 	manufacturerID INT NOT NULL AUTO_INCREMENT,
-- 	manufacturerName VARCHAR(30) NOT NULL,
-- 	manufacturerContactNo VARCHAR(10) NOT NULL,
-- 	manufacturerEmail VARCHAR(30) NOT NULL,
-- 	PRIMARY KEY (manufacturerID)
-- );

-- CREATE TABLE Food
-- (
-- 	foodID INT NOT NULL AUTO_INCREMENT,
-- 	foodType VARCHAR(30) NOT NULL,
-- 	foodExpiryDate DATE NOT NULL,
-- 	manufacturerID INT NOT NULL,
-- 	PRIMARY KEY (foodID),
-- 	FOREIGN KEY (manufacturerID) REFERENCES Manufacturers(manufacturerID) ON DELETE CASCADE
-- );

-- CREATE TABLE Pets
-- (
-- 	petID INT NOT NULL AUTO_INCREMENT,
-- 	petName VARCHAR(30) DEFAULT 'No Name',
-- 	categoryID INT NOT NULL,
-- 	PRIMARY KEY (petID),
-- 	FOREIGN KEY (categoryID) REFERENCES Categories(categoryID)
-- );

-- CREATE TABLE FoodAllocation
-- (
-- 	foodAllocationQuantity DOUBLE NOT NULL,
-- 	foodAllocationMeasurement VARCHAR(30) NOT NULL,
-- 	categoryID INT NOT NULL,
-- 	foodID INT NOT NULL,
-- 	PRIMARY KEY(categoryID, foodID),
-- 	CONSTRAINT FK_categoryID FOREIGN KEY (categoryID) REFERENCES Categories(categoryID),
-- 	CONSTRAINT FK_foodID FOREIGN KEY (foodID) REFERENCES Food(foodID) ON DELETE CASCADE
-- );