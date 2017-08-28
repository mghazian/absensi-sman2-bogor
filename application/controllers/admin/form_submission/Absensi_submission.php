<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi_submission extends CI_Controller {

	public function __construct ()
	{
		parent::__construct();
		$this->load->helper ('dialog_helper');
	}
	
	public function import_absensi()
	{
		$p = $this->input->post();
		
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
		
		$this->fv->set_rules ('tanggal', 'Tanggal', 'required');
		$this->fv->set_data (array ('tanggal' => $p['tanggal'], 'file' => 'absensi'));
		
		if ( $this->fv->run() === TRUE )
		{
			$this->load->library ('csv');
			$data = $this->csv->read_csv_file ($_FILES['absensi']['tmp_name'], "\n", ",", array ('nis', 'status'));

			//	Second checkpoint: csv content validation
			$this->fv->reset_validation();
			$this->fv->set_rules ('nis', 'NIS', 'required|max_length[15]');
			$this->fv->set_rules ('status', 'Status presensi', 'required|exact_length[1]|in_list[H,S,I,A,T,D]');
			
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
				$this->load->model ('kelas_model');
				$this->load->model ('siswa_model');
				$this->load->helper ('date_formatting_helper');

				$success = FALSE;
				foreach ($data as $row)
				{
					//	Third checkpoint: Data existence check
					$data_siswa = $this->siswa_model->get_siswa ( array ('nis' => $row['nis']) );
					if ($data_siswa['count'] == 0)
					{
						set_error_message ('Data untuk siswa dengan NIS ' . $row['nis'] . ' tidak ditermukan pada database');
						break;
					}

					$status_kehadiran = $this->siswa_model->get_status_kehadiran ( array ('kode' => $row['status']) );
					if ($status_kehadiran['count'] == 0)
					{
						set_error_message ('Status kehadiran (' . $row['status'] . ') tidak valid. Periksa kembali file yang dikirim');
						break;
					}
					
					$input = array
					(
						'id_siswa'				=> $data_siswa['record']['id'],
						'tanggal'				=> mysql_friendly_date ( $p['tanggal'], 'd-m-Y' ),
						'id_status_kehadiran' 	=> $status_kehadiran['record']['id']
					);
					
					//	Third checkpoint: DB insertion process
					$success = $this->siswa_model->insert_kehadiran_siswa ( $input, true );
					if ( $success !== TRUE )
					{
						set_error_message ( $success );
						break;
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
		
		redirect ('admin/input_absensi');
	}
}
