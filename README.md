<p align="center">
  <img src="https://github.com/Bergbok/The-Augmented-Eye/assets/66174189/2ee6c729-9147-4f55-b498-abf709e34054"/></img>
</p>

# Table of Contents:
- [Description of Application](https://github.com/Bergbok/The-Augmented-Eye/edit/main/README.md#description-of-application)
- [Installation & Setup](https://github.com/Bergbok/The-Augmented-Eye/edit/main/README.md#table-of-contents)
  - [Install XAMPP & services](https://github.com/Bergbok/The-Augmented-Eye/edit/main/README.md#installation--setup)
  - [Setting up emails](https://github.com/Bergbok/The-Augmented-Eye/edit/main/README.md#setting-up-emails)
    - [Edit sendmail.ini](https://github.com/Bergbok/The-Augmented-Eye/edit/main/README.md#edit-sendmailini)
    - [Edit php.ini](https://github.com/Bergbok/The-Augmented-Eye/edit/main/README.md#edit-phpini)
    - [If you plan on using a Gmail email](https://github.com/Bergbok/The-Augmented-Eye/edit/main/README.md#if-you-plan-on-using-a-gmail-email) 
  - [Enabling mod_rewrite](https://github.com/Bergbok/The-Augmented-Eye/edit/main/README.md#enabling-mod_rewrite)
  - [Setting up FileZilla (FTP)](https://github.com/Bergbok/The-Augmented-Eye/edit/main/README.md#setting-up-filezilla-ftp-)
  - [Setting up database (MySQL)](https://github.com/Bergbok/The-Augmented-Eye/edit/main/README.md#setting-up-database-mysql)
  - [Moving files to appropriate locations](https://github.com/Bergbok/The-Augmented-Eye/edit/main/README.md#moving-files-to-appropriate-locations)
- [How To Use](https://github.com/Bergbok/The-Augmented-Eye/edit/main/README.md#how-to-use)
  - [Features](https://github.com/Bergbok/The-Augmented-Eye/edit/main/README.md#features)   
- [Error Handling](https://github.com/Bergbok/The-Augmented-Eye/edit/main/README.md#error-handling)
  - [Unable to connect](https://github.com/Bergbok/The-Augmented-Eye/edit/main/README.md#unable-to-connect)
  - [Pictures not showing](https://github.com/Bergbok/The-Augmented-Eye/edit/main/README.md#pictures-not-showing)
  - [Database errors](https://github.com/Bergbok/The-Augmented-Eye/edit/main/README.md#database-errors)
- [Style Guide Followed](https://github.com/Bergbok/The-Augmented-Eye/edit/main/README.md#style-guide-followed)
- [Features I would've liked to implement](https://github.com/Bergbok/The-Augmented-Eye/edit/main/README.md#features-i-wouldve-liked-to-implement)
- [Resources Used](https://github.com/Bergbok/The-Augmented-Eye/edit/main/README.md#resources-used)

[Database-Handler.php](/PHP%20Scripts/Database-Handler.php)

## Description of Application:

**The Augmented Eye** is a digital news source from the game VA-11 Hall-A: Cyberpunk Bartender Action

One of the project options for a PHP course I did was to create a news website, at the time I was playing through VA-11 HALL-A and I thought recreating The Augmented Eye could be more fun than simply creating a basic news website.

This version is slightly more involved than the version found in-game, it features user accounts, article & gallery posting and more. 

# Installation & Setup:
## Install XAMPP & services: 

https://www.apachefriends.org/download.html

Open XAMPP Control Panel and install the following services:
- Apache
- MySQL
- FileZilla

## Setting up emails:
### Edit sendmail.ini:
Find your sendmail.ini file at: XAMPP_INSTALLATION_FOLDER/sendmail/sendmail.ini

Update the following fields:

smtp_server=YOUR_SMTP_SERVER

auth_username=YOUR_SMTP_USERNAME

auth_password=YOUR_SMTP_PASSWORD

### Edit php.ini:

In the XAMPP Control Panel, click on Config next to Apache
Select php.ini
#### Search for \[mail function] & update the following fields:

SMTP=YOUR_SMTP_SERVER

sendmail_from=YOUR_SMTP_EMAIL

#### While you're here, if you plan on uploading large files:
1. Search for output_buffering
2. Switch it to On
### If you plan on using a Gmail email:
#### Generate an app password:
Go to https://myaccount.google.com/security  
Use the search bar to search for _app passwords_

##### Update the fields as follows:

###### sendmail.ini:
smtp_server=smtp.gmail.com

auth_username=YOUR_GMAIL_EMAIL

auth_password=GENERATED_APP_PASSWORD

###### php.ini:
SMTP=smtp.gmail.com

sendmail_from=YOUR_GMAIL_EMAIL

## Enabling mod_rewrite

In the XAMPP Control Panel, click on Config next to Apache
Select httpd.conf

Look for the following line

```
#LoadModule rewrite_module modules/mod_rewrite.so
```

Uncomment it by removing # at its beginning.

```
LoadModule rewrite_module modules/mod_rewrite.so
```

Find all occurrences of

```
AllowOverride None
```

and change them to

```
AllowOverride
```

## Setting up FileZilla (FTP) :

Within XAMPP Control Panel, click Admin next to FileZilla

When prompted to connect to a server, just click OK

Select **Edit** > **Users** from the menu

Click the **Add** button in the Users section

Enter FILEZILLA_USER_NAME as the name of the user account.

Under Account settings enable the Password checkbox.

Enter FILEZILLA_PASSWORD as the password of the user.

If you'd like to use a different username/password: you'll need to edit lines 18 & 19 in [PHP Scripts/FTP-Handler.php](/PHP%20Scripts/FTP-Handler.php)

```
$ftp_username = 'FILEZILLA_USER_NAME';

$ftp_password = 'FILEZILLA_PASSWORD';
```

Under Page, select Shared folders

Add a directory as a Shared folder.

Select all eight checkbox options that are available in the **Files and Directories** section

Set it as the home directory at the bottom right of the Shared folders section.

Navigate to the directory you selected:

Create a directory called Profile Pictures

Copy [pfp-placeholder.png](/Images/pfp-placeholder.png) from [Images](/Images) to the folder.

Copy [Kimberly.webp](/Images/Staff/Kimberly.webp) to from [Images/Staff](/Images/Staff) to the folder & rename it to 1.webp

Copy [Donovan.webp](/Images/Staff/Donovan.webp) to from [Images/Staff](/Images/Staff) to the folder & rename it to 3.webp

## Setting up database (MySQL):

[Download and install MySQL](https://dev.mysql.com/downloads/installer/)
- During installation, when prompted, select the **Full** installation type.

Open MySQL Workbench
Select Local Instance under MySQL connections.

[Download this repository](https://github.com/Bergbok/The-Augmented-Eye/archive/refs/heads/main.zip)

Open the zip file and navigate to the [SQL Scripts folder](/SQL%20Scripts) in it.

Drag and drop the 3 scripts into MySQL Workbench and run them.

After running the third:

Edit line 18 & 19 in [PHP Scripts/Database-Handler.php](/PHP%20Scripts/Database-Handler.php) to values from the [3. View_MySQL_Users.sql](/SQL%20Scripts/3.%20View_MySQL_Users.sql) script results:

```
$db_username = '~~username~~ -> a value from the User column'; 

$db_password = 'password -> that users password, probably empty';
```

## Moving files to appropriate locations:

1. Navigate to your XAMPP installation folder.
2. Create a folder in the htdocs folder named: The Augmented Eye
3. [Download this repository](https://github.com/Bergbok/The-Augmented-Eye/archive/refs/heads/main.zip)
4. Open the zip file.
5. Extract the contents of The-Augmented-Eye-main in the zip into the folder from step 2.
# How To Use:

Preloaded user account info (Email -> Password):
- admin -> admin
- albertus.cilliers@gmail.com -> awe
- lana.smithee@theaugmentedeye.com -> awe
- kimberly.lavallette@theaugmentedeye.com -> awe
- donovan.d.dawson@theaugemnetedeye.com -> Large Beer

Open a web browser and navigate to [localhost/The Augmented Eye/Home](localhost/The Augmented Eye/Home)

To view your profile/logout, hover over the welcome message at the top left.

If you're having issues, ensure you did everything from the Installation & Setup section.

If you're still having issues, check the Error Handling section.

*This website is best browsed getting comfortable. Grab some drinks, some snacks, and enjoy!*

*So sit back and relax. I hope you have a good time!*
## Features:
### User related:
- [x] User accounts
- [x] Admin accounts
- [x] Profiles
- [x] Profile Pictures
- [x] Password emailing upon registration
- [x] Password & profile picture changing
### Article related:
- [x] Viewing 
- [x] Sorting
- [x] Posting
- [x] Tags
- [x] Sharing
- [x] Comments
### Gallery related:
- [x] Viewing
- [x] Sorting
- [x] Posting
### Other:
- [x] Newsletter Sending (admins only)
- [x] Articles from [the game](https://store.steampowered.com/app/447530/VA11_HallA_Cyberpunk_Bartender_Action)
- [x] URL rewriting to remove the .php file from browser URLs
- [x] 404 page

# Error Handling:

## Unable to connect:

Open XAMPP Control Panel.

Ensure Apache, MySQL and FileZilla are all running and configured correctly.

## Pictures not showing:

Change line 17 in [PHP Scripts/FTP-Handler.php](/PHP%20Scripts/FTP-Handler.php)

```
$ftp_hostname = '~~127.0.0.1~~ -> localhost';
```

Also, ensure lines 18 & 19 match a valid users credentials in FileZilla.

If you're still getting errors, ensure the FileZilla user your using has permissions on their shared folder.
## Database errors:

### Create a new MySQL user

Run the following in MySQL workbench:
```
CREATE USER 'username'@'localhost' IDENTIFIED BY 'password';
```

Run the following in the MySQL Command Line Interface:
```
GRANT ALL PRIVILEGES ON the_augmented_eye.* TO 'username'@'localhost';
```

Change lines 18 & 19 in [PHP Scripts/Database-Handler.php](/PHP%20Scripts/Database-Handler.php) if needed.
# Style Guide Followed:

https://gist.github.com/ryansechrest/8138375

I made an exception for file name format since I wanted uppercase characters in my page names.

# Features I would've liked to implement:

I was kinda in a rush to get this finished tho, wanted to move on to the next project yaknow.

- [ ] Media queries for resizing elements based on viewport size.
- [ ] Responsive arrow when hovering over welcome message.
- [ ] User bio.
- [ ] View users post history on profile.
- [ ] Let the user update the rest of their information aswell, at the moment they can only update their password and profile picture.
- [ ] Seperating article/gallery view counts into its own table.
- [ ] Filtering articles by tag.
- [ ] More admin pages.
- [ ] Proper [Post/Redirect/Get](https://en.wikipedia.org/wiki/Post/Redirect/Get) on submit

# Resources Used:
- https://va11halla.fandom.com/wiki
- http://www.htaccesseditor.com/en.shtml
- https://www.addtoany.com/buttons/for/website
- https://docs.phpdoc.org/3.0/guide/references/phpdoc/
