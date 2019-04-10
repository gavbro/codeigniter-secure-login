<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends MY_Secure_Controller 
{
	/**
	* Logout controller for codeigniter secure login.
	*
	* Maps to the following URL
	* 		https://example.com/logout
	*	- or -
	* 		https://example.com/index.php/logout
	*	- or -
	*			https://example.com/index.php/logout/index
	*	
	* Originally created by Gavin Brown (http://gavinbrown.ca/) 
	* or @gavbro on twitter!
	* Created on April 09, 2019
	*
	*
	* @see https://www.codeigniter.com/user_guide/general/controllers.html
	*/
	public function index()
	{
		$sessStatus = $this->session->userdata('loggedin');
		if($sessStatus == TRUE)
    {
	    $this->session->set_userdata('loggedin', FALSE); //Set it to FALSE before destroying it
		}
		
		//Destroy the session
		$this->session->sess_destroy();
		
		//close all and return to webroot directory
		redirect("/");
	}
}
