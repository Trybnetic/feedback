# Feedback

[![License](https://img.shields.io/github/license/Trybnetic/feedback.svg)](https://github.com/Trybnetic/feedback/blob/master/LICENSE.txt)  

This feedback script is forked from Tim Beckmann ([@elogy ](https://github.com/elogy/)) and provides a small website to give feedback anonymously. In comparison to elogy's [feedbackscript](https://github.com/elogy/feedbackscript) this fork uses the [Foundation CSS Framework](https://foundation.zurb.com/) for styling.

## Installation
To install this PHP application clone this repository to your desired location:

```
git clone https://github.com/Trybnetic/feedback.git
cd feedback  
```

### Configuration
In the next step you have to configure your installation by changing the parameters in the `settings.php` file:

#### SMTP server
Add the information about your mailsever:
```
$mail_server = "<mailserver url>";
$mail_user = "<mailserver username>";
$mail_port = "<mailserver port>";
$mail_pw = "<mailserver password>";
```

#### Mail headers
Specify the recipient and sender of the mail and change optionally the subject line and the sender name:
```
$sender_friendlyname = "Feedback-Mail";
$sender_mail = "<from>";
$recipient_mail = "<to>";
$mail_subject = "[Feedback] neuer Eintrag";
```

##### Database
Add the credentials to your database:
```
$sql_server = "localhost";
$sql_user = "<username>";
$sql_db = "<database>";
$sql_pw = "<password>";
$sql_table = "<table>";
```

**Note:** if you want to provide several feedback installations you can use the same database with different tables.

### Set up your database
Open your browser and navigate to the `_initdb.php`. If your changed `settings.php` is valid, the `_initdb.php` should successfully set up your database. You will get a notification in your browser about success or failure of your database setup.    
Once the table is set up, you can (and probably should) delete this file.

## Usage
After installation you can provide the link to the `index.php` or to the folder of the `index.php` file to the group of people you want to get feedback from.  
Once a new entry is received, it is recorded in the MySQL database, along with a timestamp and a pseudonym, if the student chose one. Moreover, you will receive an mail to the mail adress provided in `settings.php` once there is a new entry.

## Authors
See also the list of [contributors](https://github.com/Trybnetic/feedback/contributors) who participated in this
project.


## License
This project is licensed under the MIT License - see the [LICENSE.txt](https://github.com/Trybnetic/feedback/blob/master/LICENSE.txt) file for details
