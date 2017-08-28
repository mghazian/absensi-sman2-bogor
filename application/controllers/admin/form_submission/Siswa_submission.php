<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa_submission extends CI_Controller {

	public function __construct ()
	{
		parent::__construct();
		$this->load->helper ('dialog_helper');
	}
	
	public function insert_siswa ()
	{
		$p = $this->input->post ();

		$this->load->library ('form_validation', NULL, 'fv');
		$this->fv->set_rules ('nisn', 'NISN', 'required|max_length[10]');
		$this->fv->set_rules ('nis', 'NIS', 'required|max_length[15]');
		$this->fv->set_rules ('nama', 'Nama Siswa', 'required|max_length[200]');
		$this->fv->set_rules ('jenis_kelamin', 'Jenis Kelamin', 'required');
		
		if ( $this->fv->run() )
		{
			$this->load->model ('siswa_model');
			$success = $this->siswa_model->insert_siswa($p);

			if ( $success === TRUE )
				set_success_message ('Data berhasil masuk');
			else
				set_error_message ( $success );
		}
		else
			set_error_message ( validation_errors() );
		
		redirect ('admin/input_data_siswa');
	}

	public function update_siswa ()
	{
		$p = $this->input->post ();

		$this->load->library ('form_validation', NULL, 'fv');
		$this->fv->set_rules ('nisn', 'NISN', 'required|max_length[10]');
		$this->fv->set_rules ('nis', 'NIS', 'required|max_length[15]');
		$this->fv->set_rules ('nama', 'Nama Siswa', 'required|max_length[200]');
		$this->fv->set_rules ('jenis_kelamin', 'Jenis Kelamin', 'required');
		
		if ( $this->fv->run() )
		{
			$this->load->model ('siswa_model');
			$success = $this->siswa_model->update_siswa($p['id'], $p);

			if ( $success === TRUE )
				set_success_message ('Data berhasil masuk');
			else
				set_error_message ( $success );
		}
		else
			set_error_message ( validation_errors() );
		
		redirect ('admin/input_data_siswa');
	}
	public function delete_siswa ()
	{
		$p = $this->input->post ();

		$this->load->model ('siswa_model');
		$success = $this->siswa_model->insert_siswa($p['id']);

		if ( $success === TRUE )
			set_success_message ('Data berhasil masuk');
		else
			set_error_message ( $success );
		
		redirect ('admin/input_data_siswa');
	}

	public function import_siswa ()
	{
		$p = $this->input->post();
		$url_redirect = 'admin/input_data_siswa';
		
		//	First checkpoint: user input validation
		$this->load->library ('form_validation', NULL, 'fv');
		$this->fv->set_rules ('file', 'File', 
			array (
				array (
					'file_required',
					function ($val) 	{	return array_key_exists ( $val, $_FILES );	}
				),
				array (
					'file_proper',
					function ($val) 	{	return ( array_key_exists ( $val, $_FILES ) ) ? ($_FILES[$val]['error'] === 0) : FALSE; }
				)
			), array (
				'file_required'	=> '%s harus diisi',
				'file_proper'	=> '%s yang diinputkan tidak tepat'
			));
		
		$this->fv->set_rules ('kelas', 'Kelas', 'required');
		$this->fv->set_rules ('tahun_ajar', 'Tahun ajar', 'required');
		$this->fv->set_data (array ('file' => 'file', 'kelas' => 'kelas', 'tahun_ajar' => 'tahun_ajar'));
		
		if ( $this->fv->run() === TRUE )
		{
			$this->load->library ('csv');
			$data = $this->csv->read_csv_file ($_FILES['file']['tmp_name'], "\n", ";", array ('no', 'nama', 'jenis_kelamin', 'nis', 'nisn'));

			//	Second checkpoint: csv content validation
			$this->fv->reset_validation();
			$this->fv->set_rules ('nama', 'Nama siswa', 'required|max_length[200]');
			$this->fv->set_rules ('nis', 'Nomor Induk Siswa', 'required|max_length[15]');
			$this->fv->set_rules ('nisn', 'Nomor Induk Siswa Nasional', 'required|max_length[10]');
			$this->fv->set_rules ('jenis_kelamin', 'Jenis Kelamin', 'required|exact_length[1]|in_list[L,P]');
			
			$is_data_proper = true;
			foreach ($data as $row)
			{
				$this->fv->set_data ($row);
				$is_data_proper = $this->fv->run();

				if ( ! $is_data_proper )
					break;
			}
			
			if ( $is_data_proper )
			{
				$this->load->model ('siswa_model');
				$this->load->model ('kelas_model');
				$this->load->helper ('date_formatting_helper');

				$success = FALSE;
				foreach ($data as $row)
				{	
					//	Third checkpoint: Data insertion process
					$success = $this->siswa_model->insert_siswa ( $row, true );
					if ( $success !== TRUE )
					{
						set_error_message ( $success );
						redirect ($url_redirect);
					}
				}

				foreach ($data as $row)
				{
					$siswa = $this->siswa_model->get_siswa ( array_diff_key ( $row, array ('no' => NULL) ) );
					
					//	Fourth checkpoint: Foreign key registration
					$success = $this->kelas_model->insert_kepesertaan_kelas (array
					(
						'id_siswa'		=>	$siswa['record']['id'],
						'id_kelas' 		=> 	$p['kelas'],
						'tahun_ajar'	=>	$p['tahun_ajar']
					));
					if ( $success !== TRUE )
					{
						set_error_message ( $success );
						redirect ($url_redirect);
					}
				}

				if ( $success === TRUE )
					set_success_message ( count ($data) . ' baris data telah dimasukkan.' );
			}
			else
				set_error_message ( validation_errors() );
		}
		else
			set_error_message ( validation_errors() );
		
		redirect ($url_redirect);
	}
}
