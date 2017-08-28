<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_submission extends CI_Controller {

	public function __construct ()
	{
		parent::__construct();
		$this->load->helper ('dialog_helper');
	}
	
	public function auth ()
	{
		$p = $this->input->post();
		$this->load->library ('form_validation', NULL, 'fv');

		$this->fv->set_rules ('username', 'Username', 'required');
		$this->fv->set_rules ('password', 'Password', 'required');

		if ( $this->fv->run() )
		{
			$this->load->library ('authentifier');

			//	Hard-coded for speed
			if ( $this->authentifier->authenticate ($p['username'], $p['password']) )
				redirect ('admin');
			set_error_message ('Username atau password salah.');
		}
		else
			set_error_message ( validation_errors() );
		redirect ('home/login');
	}
}
