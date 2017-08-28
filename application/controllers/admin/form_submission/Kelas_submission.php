<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas_submission extends CI_Controller {

	public function __construct ()
	{
		parent::__construct();
		$this->load->helper ('dialog_helper');
	}
	
	//---------------------------------------------------------------------------
	//	FORM REQUEST

	public function insert_jurusan ()
	{
		$p = $this->input->post();

		$this->load->library('form_validation', NULL, 'fv');
		$this->fv->set_rules ('jurusan', 'Jurusan', 'required|max_length[20]');
		
		if ( $this->fv->run() )
		{
			$this->load->model ('kelas_model');
			$success = $this->kelas_model->insert_jurusan_kelas ($p);

			if ( $success === TRUE )
				set_success_message ( 'Data berhasil masuk' );
			else
				set_error_message ( $success );
		}

		else
			set_error_message ( validation_errors() );
		
		redirect ('/admin/pengaturan_kelas#tab_jurusan_tambah');
	}

	public function insert_kelas ()
	{
		$p = $this->input->post();
		
		$this->load->library('form_validation', NULL, 'fv');
		$this->fv->set_rules ('jenjang', 'Jenjang', 'required|max_length[10]');
		$this->fv->set_rules ('id_jurusan', 'Jurusan', 'required');
		$this->fv->set_rules ('nomor', 'Nomor Kelas', 'required|integer');

		if ( $this->fv->run() )
		{
			$this->load->model ('kelas_model');
			
			$success = $this->kelas_model->insert_kelas ($p);

			if ( $success === TRUE )
				set_success_message ( 'Data berhasil masuk' );
			else
				set_error_message ( $success );
		}

		else
			set_error_message ( validation_errors() );
		
		redirect ('/admin/pengaturan_kelas#tab_kelas_tambah');
	}

	public function delete_jurusan ()
	{
		$p = $this->input->post();
		
		$this->load->model ('kelas_model');
		$success = $this->kelas_model->delete_jurusan_kelas ($p['id']);

		if ( $success === TRUE )
			set_success_message ( 'Data berhasil dihapus' );
		else
			set_error_message ( $success );
		
		redirect ('/admin/pengaturan_kelas#tab_jurusan_daftar');
	}

	public function delete_kelas ()
	{
		$p = $this->input->post();
		
		$this->load->model ('kelas_model');
		$success = $this->kelas_model->delete_kelas ($p['id']);

		if ( $success === TRUE )
			set_success_message ( 'Data berhasil dihapus' );
		else
			set_error_message ( $success );
		
		redirect ('/admin/overview_kelas#tab_kelas_daftar');
	}

	public function update_jurusan ()
	{
		$p = $this->input->post();
		
		$this->load->model ('kelas_model');
		$success = $this->kelas_model->update_jurusan_kelas ($p['id'], $p);
		
		if ( $success === TRUE )
			set_success_message ( 'Data berhasil diubah' );
		else
			set_error_message ( $success );
		
		redirect ('/admin/pengaturan_kelas#tab_jurusan_daftar');
	}

	public function update_kelas ()
	{
		$p = $this->input->post();
		
		$this->load->model ('kelas_model');
		$success = $this->kelas_model->update_kelas ($p['id'], $p);

		if ( $success === TRUE )
			set_success_message ( 'Data berhasil diubah' );
		else
			set_error_message ( $success );
		
		redirect ('/admin/pengaturan_kelas#tab_kelas_daftar');
	}

	public function insert_kepesertaan_kelas ()
	{
		$p = $this->input->post();
		
		$this->load->library ('form_validation', NULL, 'fv');
		$this->fv->set_rules ('siswa[]', 'Siswa', 'required');
		$this->fv->set_rules ('kelas', 'Kelas', 'required');
		
		if ( $this->fv->run() === TRUE )
		{
			$this->load->model ('kelas_model');

			foreach ($p['siswa'] as $siswa)
			{
				$data = array ( 'id_kelas' => $p['kelas'], 'id_siswa' => $siswa, 'tahun_ajar' => $p['tahun_ajar'] );
				$success = $this->kelas_model->insert_kepesertaan_kelas ($data);

				if ( $success !== TRUE ) break;
			}

			if ( $success === TRUE )
				set_success_message ( count ($p['siswa']) . ' siswa telah didaftarkan pada kelas yang dipilih' );
			else
				set_error_message ( $success );
		}
		else
			set_error_message ( validation_errors() );

		redirect ('/admin/anggota_kelas#tab_daftarkan_siswa');

		
	}
}
