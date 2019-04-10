# codeigniter-secure-login

### Description

A simple login solution using MySQL Stored Procedures for CodeIgniter 3.x.

This is intended to be a collection of libraries and database structures designed as a starter point for a secure login solution for CodeIgniter (Current version 3.3.10). Being a little frustrated myself with not being able to find what I wanted online already made (Maybe I didn't search hard enough?), I decided to make my own. Since it seemed to work ok, I thought that maybe hosting it on GitHub will allow others to use it and improve on it if they want. This is really just for fun and to hopefully be useful at the same time.

The main goal of this is to create a database user with execute database access only, authenticate using only stored procedures in MySQL, then set session data appropriatly. 


## DEMO: https://gavbro.howlhost.ca/


### Table of Contents

1. What's the plan
1. Requirements
1. Recommendations
1. Installation 
1. Usage
1. Contributing (To be Added)
1. FAQ
1. Credits
1. Licence
1. Disclaimer

### 1. So ...... What's the Plan?

**The initial main components of this little project are**:

* A login library that contains all the methods for login, logged in check and logout.
* A custom login controller and view file with a basic login and password form included.
* A custom controller that is then extended into a secure controller for any areas that should be secure.
* Importable SQL files that will setup all the database structures and stored procedures, including a test account.
	
**Time permitting, I would like to add the following features**:

* Relevant error messages to the user (Example: 'Password incorred, try again')
* Integrated CAPTCHA or ReCAPTCHA support.
* Outlook/Facebook/Gmail login options.
* User registration with email confirmation.
* Meaningful logging of all login related events.

**If this becomes a PHP super-project (I know right!), I would like to see the following features added**:

* Customizable user hierarchies for varied access to a site. (admin, moderator, publisher, etc..).
* Complete backend admin area for user creation, suspension and administration of users.
* Two-factor authentication.
* More I can't think of right now...
	
### 2. Requirements

* CodeIgniter version 3.1.10 or higher installed and working (not tested on anything previous)
* The CI `url` and `form` helpers are initiated, current setup is globally in application/config/autoload.php (Line #92 in CI version 3.1.10), see https://codeigniter.com/user_guide/general/helpers.html#auto-loading-helpers
* The CI `database` and `session` libraries are initiated globally in application/config/autoload.php (Line #61 in CI version 3.1.10), see https://codeigniter.com/user_guide/general/autoloader.html
* File or FTP access to the web server.
* PHP version 5.6 or higher minimum.
* MySQL version 5.0 or higher minimum. 
* MySQL PDO Driver loaded and ready.
* The capacity for untold amounts of fun and wonder!

### 3. Recommendations

#### Although this script will work without the following security considerations, it will be much less secure.

* Use HTTPS instead of HTTP. see https://en.wikipedia.org/wiki/HTTPS
* Store your CI files outside of the webroot. see https://codeigniter.com/user_guide/general/security.html#hide-your-files
* Enable CSRF protection in the application/config/config.php file (Starts on Line# 451 for version 3.1.10) see https://codeigniter.com/user_guide/general/security.html#csrf-protection

### 4. Installation

Please note: These instructions assume that you have a running webserver configured and ready to go with MySQL 5.0 or higher and CodeIgniter 3.1.10 or newer installed and working. Also, that you already have/know how to make a database and database user setup. For CodeIgniter installation see https://codeigniter.com/user_guide/installation/index.html

1. Copy the /applications folder contents to your CI installation /applications folder 
2. Create a MySQL database. (utilized example is 'test_database')
	* If you use a different database name, you will have `CTRL+R` replace/update all instances of "test_database" with your new database name in 2 files:
		1. /MySql/procedures.sql
		1. /MySql/dbsetup.sql
3. Import the database setup file into your new database using command line or phpmyadmin (/MySQL/dbsetup.sql).
4. Import the procedures setup file into your new database using command line or phpmyadmin (/MySQL/procedures.sql).
5. Create a new passworded database user with **EXECUTE privileges only**. (Not even SELECT or UPDATE are required)
6. Modify your /applications/config/database.php file and add the following to the bottom:
```
$db['login'] = array(
	'dsn'	=> 'mysql:host=localhost;dbname=test_database', //replace this with your new database name if needed
	'hostname' => '',
	'username' => 'test_user', //your database user name
	'password' => '', //your database user password
	'database' => '',
	'dbdriver' => 'pdo',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => TRUE, 
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
```

###### _Please note: If you do not already have a default database configured in CodeIgniter, you will have to set the `$active_group` variable to `'login'` instead of `'default'` after step 6. (located on line# 73 of /applications/config/database.php in CodeIgniter 3.1.10)_

7. Test and Enjoy!

### 5. Usage 

	1. Navigate to yourdomain.com/login -or-yourdomain.com/login/one -or- yourdomain.com/login/two
	2. Login using the user email address: `test@somedomain.com` and password: `password`.
	3. Enjoy!

### 6. Contributing

Feel free to submit contributions to the project. I can't promise that I will accept all submissions, but even any suggestions, helpful points or criticisms that impact development will gain you a note as the contributor. My only request is to keep things similar to what I have started in terms of organization and commenting, just to keep things simple.

### 7. Frequently Asked Questions

**Question**: How do I change the user password?

* __Answer__: For now, use `echo password_hash("password", PASSWORD_DEFAULT);` where 'password' is what you want the new password to be. Run that command somewhere on your site, then copy and paste the output into the password column of the database. Don't forget to comment out or delete the code when you are done!

### 8. Credits.

So far, just me:(

### 9. License

Free! Download it and use it as you please! I mean, I would appreciate a tweet or a mention, but it is really not necessary.

### 10. Disclaimer

Please don't just assume this script is secure. Although I intend to progressively make it more secure as time goes on, no login script is 100% secure and this one certainly isn't either. This is intended as a starting point to something bigger, so none of its contributors take any responsibility for how you use it or any damages that might occur from using/misusing it.

