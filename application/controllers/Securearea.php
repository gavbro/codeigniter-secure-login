<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Securearea extends MY_Secure_Controller {

	/**
	* This is the homepage controller for the secure area
	*
	* Any controller that extends MY_Secure_Controller should be 
	* accessable only while logged in.
	*
	* Maps to the following URL
	* 		https://example.com/securearea
	*	- or -
	* 		https://example.com/index.php/securearea
	*	- or -
	*			https://example.com/index.php/securearea/index
	*	
	* Originally created by Gavin Brown (http://gavinbrown.ca/) 
	* or @gavbro on twitter!
	* Created on April 08, 2019'
	*
	* @see https://www.codeigniter.com/user_guide/general/controllers.html
	*/
	public function index()
	{
		$this->load->view('securearea');
	}
}
