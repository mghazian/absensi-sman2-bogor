<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_submission extends CI_Controller {

	public function __construct ()
	{
		parent::__construct();
		$this->load->helper ('dialog_helper');
	}
	
	public function ganti_pass ()
	{
		$p = $this->input->post();

		$this->load->library ('form_validation', NULL, 'fv');
		$this->fv->set_rules ('password_lama', 'Password lama', array
		(
			array (		
				'correct',
				function ($val)
				{
					$this->load->model ('user_model');
					$this->load->library ('authentifier');

					$user_id = $this->authentifier->get_login_data ('id');
					$data = $this->user_model->get_user ( array ('id' => $user_id) );
					
					return password_verify ($val, $data['record']['password']);
				}
			)
		), array
		(
			'correct' => 'Password lama yang dientrikan salah'
		));
		$this->fv->set_rules ('password_baru', 'Password baru', 'required');
		$this->fv->set_rules ('re_password_baru', 'Ulangi password baru', 'matches[password_baru]');
		
		if ( $this->fv->run() )
		{
			$this->load->model ('user_model');
			$this->load->library ('authentifier');
			
			$user_id = $this->authentifier->get_login_data ('id');
			$success = $this->user_model->update_user ( $user_id, array
			(
				'id' 		=> $user_id,
				'password' 	=> password_hash ($p['password_baru'], PASSWORD_BCRYPT)
			));

			if ( $success === TRUE )
				set_success_message ('Password berhasil diubah');
			else
				set_error_message ($success);
		}
		else
			set_error_message ( validation_errors() );
		
		redirect ('admin/user_setting');
	}
}
