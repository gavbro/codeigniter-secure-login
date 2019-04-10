<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	* This is the email only input for two-part login option. 
	*
	*	If you would prefer the login and password input on one page,
	* see application/views/login.php
	*
	* Originally created by Gavin Brown (http://gavinbrown.ca/) 
	* or @gavbro on twitter!
	* Created on April 08, 2019
	*
	* @see https://codeigniter.com/user_guide/general/views.html for 
	* assistance in updating or creating custom views for codeigniter.
	*
	*/
?><!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Secure Login</title>
  <meta name="description" content="Basic Template for codeigniter-secure-login">
  <meta name="author" content="gavbro">
  <style type="text/css">
  	
  /*
	
	CSS and basic layout copied from the codeigniter welcome page
	I can't take any credit for that!
	
	*/

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>

<body>
	<div id="container">
		<div id="body">
			<h3>Enter your email to login!</h3>
			<div class="login-form">
				<?php echo form_open(); ?>
				<?php
				 	echo form_input(
				 	array(
						'type' => 'email',
						'id' => 'email',
						'name' => 'email',
						'value' => '',
						'placeholder' => 'youremail@example.net')
					); 
				?>
				<?php	echo form_submit('submit-email', '  Continue >>  ', array("class" => "button")); ?>
				<?php echo form_close(); ?>
			</div>
			<p>hint: the test email is <a href="#" onclick="(function(){document.getElementById('email').value = 'test@somedomain.com';})()">test@somedomain.com</a></p>
		</div>
		<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
	</div>
</body>
</html>