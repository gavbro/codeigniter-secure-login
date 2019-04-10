<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Login 
{
	/**
	* Login library for codeigniter-secure-login 
	*
	* Version Alpha 1.0
	* Available on GitHub at https://github.com/gavbro/codeigniter-secure-login
	*
	* Can be automatically loaded by autoload config, or loaded in-line 
	* with $this->library->load('MY_login');
	*
	* Originally created by Gavin Brown (http://gavinbrown.ca/) 
	* or @gavbro on twitter!
	* Created on April 08, 2019
	*
	* @see https://www.codeigniter.com/user_guide/general/creating_libraries.html for 
	* assistance in updating or creating custom libraries for codeigniter.
	* 
	*/
 
 	// declare private database variable to hold DB object.
	private $dbl;
	
	// declare pricate CI variable to contain parent construct as object.
	private $CI;
	
	public function __construct()
	{
		// Set CI private variable to access CI controller methods.
		// need to test parent::__construct();
		$this->CI =& get_instance();
		
		// Set DB private variable using login prefix (load only specific login credentials)
		$this->dbl = $this->CI->load->database('login', TRUE);
	}
	
	/**
	* Method for checking if inputed email address is a valid address and also check if
	* it matches an account.
	*
	* Used for the first part of two stage login like outlook.com or gmail.com (input email, then password
	* in seperate screens)
	*/
	public function checkEmail($email)
	{
		
		// Preformat the email to lower case, with only valid characters. 
		// Limit to 100 characters to match the VARCHAR (100) of the email
		// field in the MySQL DB
		$email = substr(preg_replace("/[^a-z0-9.\@\-]*/", "", strtolower($email)), 0, 100);

		// Use PHP built in email validation function as a first line of checking the input
		// If it is not valid, return false.
		if(filter_var($email, FILTER_VALIDATE_EMAIL))
	  {
	  	// Call the preset stored procedure for validating the email only.
  	  $this->dbl->trans_start();
		  	$this->dbl->query("CALL login_checkEmail('{$email}', @isEmailOK)");
		  	$result = $this->dbl->query("SELECT @isEmailOK");
	  	$this->dbl->trans_complete();
	  	
	  	// check to see if the returned value is greater than 0 (row IDs start at 1)
	  	if($result->row("@isEmailOK") != 0)
	  	{
	  		// return the row ID if successful
	  		return $result->row("@isEmailOK");
	  	}
	  	else
	  	{
	  		// return false if row ID is not fetched
	  		return false;
	  	}
	  }
	  else
	  {
	  	// return false if the email is not valid.
	  	return false;
	  }
	}
	
	
	/**
	* Method for checking that the email entered is valid and verifying the entered
	* password against the hashed password in the database.
	*/
	public function checkPass($email, $pass)
	{
		// check if email is valid, also checking to see if the password isn't blank.
		if(filter_var($email, FILTER_VALIDATE_EMAIL) && strlen(trim($pass)) > 3)
		{
			// preformat the password to only contain accepted characters, omit the rest.
			$pass = preg_replace("/[^a-zA-Z0-9.\!\\$\%\&\*@\_]*/", "", $pass);
			
			// start the database transaction
  		$this->dbl->trans_start();
  		
  			// call the stored procedure to pull out the hashed password based on the email address, which has to be unique.
  			$this->dbl->query("CALL login_checkPass('{$email}', @passwordHash, @firstName, @lastName, @userId)");
  			
  			// assign the results to variables.
  	  	$resPass = $this->dbl->query("SELECT @passwordHash");
				$resnf = $this->dbl->query("SELECT @firstName");
				$resnl = $this->dbl->query("SELECT @lastName");
				$uInfo = $this->dbl->query("SELECT @userId");
				
			// complete the transaction
  		$this->dbl->trans_complete();
  		
  		// compare the stored hashed password against a hashed version of the password input
			if(password_verify($pass, $resPass->row("@passwordHash")))
			{
				
				// assign the output to a session array 
	  		$inData = array(
	  			"userid" => $uInfo->row("@userId"),
	  			"fname" => $resnf->row("@firstName"),
	  			"lname" => $resnl->row("@lastName"),
	  			"loggedin" => TRUE
	  		);
	  		
	  		// set the session array values to session variables 
	  		$this->CI->session->set_userdata($inData);
	  		return true;
	  	}
	  	else
	  	{
	  		// password didn't match, so there.. FALSE!
	  		return false;
	  	}
	  }
	  else
	  {
	  	// The email was invalid or the entered password was blank (less than 3 characters long).
	  	return false;
	  }
	}
}