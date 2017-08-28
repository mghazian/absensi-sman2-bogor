<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'Ajax_request.php';

class Siswa_request extends Ajax_request {

	public function __construct()
	{
		parent::__construct();
	}
	
	//---------------------------------------------------
	//	AJAX REQUEST
	
	public function ajax_pendaftaran_kelas ()
	{
		$this->load->model ('siswa_model');
		$result = $this->siswa_model->get_siswa ();

		$data = $this->prepareData ( $result['record'], $result['count'] );
		//	Only process if there are data available
		if ( $result['count'] > 0 )
		{
			$data = $this->prepareNumbering ( $data );

			for ($i = 0; $i < $result['count']; $i++)
			{
				$data[$i]['checkbox'] = '<input type="checkbox" class="filled-in" name="siswa[]" value="' . $data[$i]['id'] . '" id="' . $data[$i]['id'] . '">';
				$data[$i]['checkbox'] .= '<label for="' . $data[$i]['id'] . '"> </label>';
			}

			$data = $this->formatId ( $data );
		}

		$output = array
		(
			//"draw" => $_POST['draw'],
			"recordsTotal" => $result['total'],
			"recordsFiltered" => $result['count'],
			"data" => $data,
		);
        //output to json format
        echo json_encode($output);
	}

	public function ajax_list_siswa ()
	{
		$this->load->model ('siswa_model');
		$result = $this->siswa_model->get_siswa ();

		$data = $this->prepareData ( $result['record'], $result['count'] );
		//	Only process if there are data available
		if ( $result['count'] > 0 )
		{
			$data = $this->prepareNumbering ( $data );
			$data = $this->prepareActionButton ( $data );
			$data = $this->formatId ( $data );
		}

		$output = array
		(
			//"draw" => $_POST['draw'],
			"recordsTotal" => $result['total'],
			"recordsFiltered" => $result['count'],
			"data" => $data,
		);
        //output to json format
        echo json_encode($output);
	}

	public function ajax_view_kehadiran ()
	{
		$this->load->model ('siswa_model');
		$this->load->helper ('date_formatting_helper');

		$result = $this->siswa_model->get_kehadiran_dengan_kelas ();
		$data = $this->prepareData ( $result['record'], $result['count'] );

		if ( $result['count'] > 0 )
		{
			$data = $this->prepareNumbering ( $data );
			$data = array_map ( function ($val)
			{
				return array (
					'no'		=>	$val['no'],
					'nisn'		=>	$val['nisn'],
					'nis'		=>	$val['nis'],
					'nama'		=>	$val['nama'],
					'kelas'		=>	$val['jenjang'] . ' ' . $val['jurusan'] . ' ' . $val['nomor'] . ' (' . $val['tahun_ajar'] . ')',
					'kehadiran'	=>	$val['status'],
					'tanggal'	=>	date_formatter ( $val['tanggal'], 'Y-m-d', 'd M Y' )
				);
			}, $data);
		}

		$output = array
		(
			//"draw" => $_POST['draw'],
			"recordsTotal" => $result['total'],
			"recordsFiltered" => $result['count'],
			"data" => $data,
		);
        //output to json format
        echo json_encode($output);
	}
}
