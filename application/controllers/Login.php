<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller
{
	/**
	* Login controller for codeigniter secure login.
	*
	* Maps to the following URL
	* 		https://example.com/login
	*	- or -
	* 		https://example.com/index.php/login
	*	- or -
	*			https://example.com/index.php/login/index
	*	
	* Originally created by Gavin Brown (http://gavinbrown.ca/) 
	* or @gavbro on twitter!
	* Created on April 08, 2019
	*
	*
	* @see https://www.codeigniter.com/user_guide/general/controllers.html
	*/
	public function index()
	{
		// Default is two-step login (email -> password)
		//set to $this->one(); for one step as default;
		//both can be accessed at login/one or login/two
		$this->two();
	}
	
	/**
	*	Public method to load the single page login option at login/one
	*/
	public function one()
	{
		$this->authent('one');
	}
	
	/**
	*	Public method to load the two page login option at login/two
	*/
	public function two()
	{
		$this->authent('two');
	}
	
	/**
	*	Private method to load the requested one or two page login option
	* and process the posted data either way.
	*/
	private function authent($num)
	{
		// Check to see if both username and password fields have submitted values
		// if they do, process as email/password submission, or second part of
		// two-part login
		if(($this->input->post('email') != NULL || $this->input->post('password') != NULL))
		{
			// Load the verify method below passing the login type with it
			$this->verify($num);
		}
		else
		{
			// If user is already logged in, 
			if($this->session->userdata('loggedin') == TRUE)
			{
				
				// Check if the current page is the login page.
				// Redirect to secure home if it is, otherwise
				// do nothing.
				$this->isBegin();
			}
			else
			{ 
				// User is not logged in already, so show login
				$this->load->view('login-' . $num);
			}
		}
	}
	
	/**
	*	Private method to check the email or email/password combo
	* and redirect accordingly.
	*/
	private function verify($num)
	{
		// Load the custom login library
		$this->load->library('MY_Login');
		
		// Check if both the email and password fields have input
		if($this->input->post('email') != NULL && $this->input->post('password') != NULL)
		{
			// If they do, send the input to the checkPass method of the MY_Login library 
			// for verification.
			if($this->my_login->checkPass($this->input->post('email'), $this->input->post('password')))
			{
				// If checkPass returns true, the session variables are already set
				// so redirect to the secure area
				redirect("/securearea/");
			}
			else
			{
				// Something went wrong with the email/password combo
				// return to the appropriate login option page.
				$this->load->view('login-' . $num);
			}
		}
		// Check to see if the email field wasn't blank at least.
		elseif($this->input->post('email') != NULL)
		{
			// It wasn't blank, so send the input to the checkEmail
			// method of the MY_Login library to see if it matches
			// an account.
			if($this->my_login->checkEmail($this->input->post('email')))
  	  {
  	  	// On Success, set a variable available to the
  	  	// login-password view file as $email to be
  	  	// assigned to a hidden input for the password
  	  	// step.
  	  	$app["email"] = $this->input->post('email');
				$this->load->view('login-password', $app);
  		}
  		else
  		{
  			// Not a recognized email. try again please!
  			redirect("/Login/" . $num);
  		}
		}
		// Both email and password were blank
		else
		{
			// Send the user back to try again.
			redirect("/Login/" . $num);
		}
	}
	
	/**
	*	Private method to see if the user has navigated back to a login
	* page by accident and redirect to the secure home if so.
	*/
	private function isBegin()
	{
	
		// Assign the current url to a variable
		$url = substr(base_url(), 0, -1) . $_SERVER['SCRIPT_NAME'];
		
		// The login page as a variable
		$base = base_url() . "index.php";
		
		// If they are the same, redirect to the secure zone!
		if($url == $base)
		{
			redirect("/securearea/");
		}
	}
}