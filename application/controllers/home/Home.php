<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function index()
	{
		$this->homepage();
	}	

	public function homepage ()
	{
		$this->load->view ('general/header');
		$this->load->view ('home/navbar');
		$this->load->view ('home/homepage');
		$this->load->view ('general/footer');
	}

	public function pencarian_kehadiran ()
	{
		$data['keyword'] = '';

		$g = $this->input->get();
		if ( ! empty ($g) )
			$data['keyword'] = $g['keyword'];
		
		$this->load->view ('general/header');
		$this->load->view ('home/navbar');
		$this->load->view ('home/pencarian_kehadiran', $data);
		$this->load->view ('general/footer');
	}

	public function login ()
	{
		$this->load->helper ('dialog_helper');
		$this->load->view ('general/header');
		$this->load->view ('home/navbar');
		$this->load->view ('home/login');
		$this->load->view ('general/footer');
	}

	public function logout ()
	{
		$this->load->library ('authentifier');
		$this->authentifier->logout();
		redirect ('home');
	}
}
