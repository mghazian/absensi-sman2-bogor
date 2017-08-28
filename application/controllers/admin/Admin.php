<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct ()
	{
		parent::__construct();
		$this->load->helper ('dialog_helper');
		$this->load->library ('authentifier');

		$this->authentifier->guard (array ('admin'));
	}

	public function index()
	{
		$this->dashboard();
	}

	public function dashboard()
	{
		$asset['css'] = array ('sidebar.css');
		$this->load->view ('general/header', $asset);
		$this->load->view ('admin/navbar');
		$this->load->view ('admin/sidebar');
		$this->load->view ('admin/dashboard');
		$this->load->view ('general/footer');
	}

	public function pengaturan_kelas()
	{
		$this->load->model ('kelas_model');

		$asset['css'] = array ('sidebar.css');

		$data['jurusan'] = $this->kelas_model->get_jurusan ()['record'];
		$this->load->view ('general/header', $asset);
		$this->load->view ('admin/navbar');
		$this->load->view ('admin/sidebar');
		$this->load->view ('admin/pengaturan_kelas', $data);
		$this->load->view ('general/footer');
	}

	public function anggota_kelas()
	{
		$this->load->model ('kelas_model');

		$asset['css'] = array ('sidebar.css');

		$data['kelas'] = $this->kelas_model->get_kelas (NULL, true, false)['record'];

		$this->load->view ('general/header', $asset);
		$this->load->view ('admin/navbar');
		$this->load->view ('admin/sidebar');
		$this->load->view ('admin/anggota_kelas', $data);
		$this->load->view ('general/footer');
	}

	public function data_siswa()
	{
		$asset['css'] = array ('sidebar.css');

		$this->load->view ('general/header', $asset);
		$this->load->view ('admin/navbar');
		$this->load->view ('admin/sidebar');
		$this->load->view ('admin/data_siswa');
		$this->load->view ('general/footer');
	}

	public function input_data_siswa()
	{
		$asset['css'] = array ('sidebar.css');

		$this->load->model ('kelas_model');
		$data['kelas'] = $this->kelas_model->get_kelas (NULL, true, true)['record'];

		$this->load->view ('general/header', $asset);
		$this->load->view ('admin/navbar');
		$this->load->view ('admin/sidebar');
		$this->load->view ('admin/input_data_siswa', $data);
		$this->load->view ('general/footer');
	}

	public function histori_absensi()
	{
		$asset['css'] = array ('sidebar.css', 'attendance.css');

		$this->load->view ('general/header', $asset);
		$this->load->view ('admin/navbar');
		$this->load->view ('admin/sidebar');
		$this->load->view ('admin/histori_absensi');
		$this->load->view ('general/footer');
	}

	public function input_absensi()
	{
		$asset['css'] = array ('sidebar.css');

		$this->load->model ('kelas_model');
		$data['kelas'] = $this->kelas_model->get_kelas (NULL, true, false)['record'];

		$this->load->view ('general/header', $asset);
		$this->load->view ('admin/navbar');
		$this->load->view ('admin/sidebar');
		$this->load->view ('admin/input_absensi', $data);
		$this->load->view ('general/footer');
	}

	public function user_setting()
	{
		$asset['css'] = array ('sidebar.css');

		$this->load->view ('general/header', $asset);
		$this->load->view ('admin/navbar');
		$this->load->view ('admin/sidebar');
		$this->load->view ('admin/user_setting');
		$this->load->view ('general/footer');
	}
}
