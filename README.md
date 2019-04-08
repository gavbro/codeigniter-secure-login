# codeigniter-secure-login

### Description

An simple secure login solution using MySQL SP for CodeIgniter 3.x.

This is intended to be a collection of libraries and database structures designed as a starter point for a secure login solution for CodeIgniter (Current version 3.3.10). Being a little frustrated myself with not being able to find what I wanted online already made (Maybe I am just bad at searching), I decided to make my own. Since it seemed to work ok, I thought that maybe hosting it on Github will allow others to use it and improve on it if they want. This is really just for fun and to be useful at the same time.

The main goal of this is to create a database user with execute database access only, authenticate using only stored procedures in MySQL, then set session data appropriatly. 

## Current version Alpha 1.0

### Table of Contents

1. What's the plan
1. Installation (To be added)
1. Usage (To be Added)
1. Contributing (To be Added)
1. Credits
1. Licence

### 1. So ...... What's the Plan?

**The initial main components of this little project should be**:
	* a login library that contains all of the methods for login, logged in check and logout.
	* a custom /login controller and view file with a basic login and password form included.
	* a custom controller that is then extended into a secure controller for any areas that should be secure.
	* an importable SQL file that will setup all of the database structures and stored procedures, including a test account.
	
**If things progress smoothly, I would like to add the features**:
  * Integrated CAPTCHA or ReCAPTCHA support.
	* User registration with email confirmation.
	* Meaningful logging of all login related events.

**If this becomes a PHP superproject (I know right!), I would like to add the following features**:
	* Customizable user heirarchies for varied access to a site. (admin, moderator, publisher, etc..)
	* Complete backend admin area for user creation, suspension and administration of users
	* Two-factor authentication.
	* More I can't think of right now...
	
### 2. Installation

This is where the installation instructions will be.

### 3. Usage 

This is where the usage information will be.

### 4. Contributing

This is where the contributing instructions will be.

### 5. Credits.

So far, just me:(

### 6. License

Free!. Download it and use it as you please!. I mean, I would appreciate a tweet or a mention, but it is totally not neccessary. 

