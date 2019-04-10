<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	/**
	* Custom sitewide controller for codeigniter-secure-login. (use this for unsecure areas)
	*
	* Version Alpha 1.0
	* Available on GitHub at https://github.com/gavbro/codeigniter-secure-login
	*
	* Loads directly on all non-login required controllers.
	* Extended from default CI_Controller
	*
	* Originally created by Gavin Brown (http://gavinbrown.ca/) 
	* or @gavbro on twitter!
	* Created on April 08, 2019
	*
	* @see https://www.codeigniter.com/user_guide/general/core_classes.html for 
	* assistance in updating or creating custom core controllers for codeigniter.
	*
	*/
	
  public function __construct()
  {
  	 // Reference CI_Controller construct to access all CI related methods
     parent::__construct();
	}
}

class MY_Secure_Controller extends MY_Controller
{
	/**
	* Custom sitewide controller for codeigniter-secure-login. (use this for secure areas)
	*
	* Version Alpha 1.0
	* Available on GitHub at https://github.com/gavbro/codeigniter-secure-login
	*
	* Usage: Extend directly on all login required controllers.
	* Extended from custom MY_Controller
	*
	* Created and maintained by Gavin Brown (http://gavinbrown.ca/) or @gavbro on twitter!
	*
	* @see https://www.codeigniter.com/user_guide/general/core_classes.html for 
	* assistance in updating or creating custom core controllers for codeigniter.
	*
	*/
	
  public function __construct()
  {
  		// Reference MY_Controller construct to access all CI_Controller related methods
      parent::__construct();

      // Get the status which is an array
      $login_status = $this->check_session();
			

      // Send it to the views, it will be available everywhere

      // Make $login_status available in your views
      $this->load->vars(array('loggedin' => $login_status));
  }


	/**
	*	Method to check the session and destroy it if the value is false;
	*/
  protected function check_session()
  {
		// Check if the session variable is set to TRUE, if not kill it
		// if it exists and show a 404.
    if($this->session->userdata('loggedin') != TRUE)
    {
    	// Not set correctly, set to false, then destroy it
    	$this->session->set_userdata('loggedin', FALSE); 
    	$this->session->sess_destroy();
    	
    	// Show 404 for current page.
    	show_404("Secure Area - " . current_url(), TRUE);
    }
  }
}
?>