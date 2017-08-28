<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'Ajax_request.php';

class Kelas_request extends Ajax_request {

	public function __construct()
	{
		parent::__construct();
	}
	
	//---------------------------------------------------
	//	AJAX REQUEST
	
	public function ajax_jurusan_kelas ()
	{
		$this->load->model ('kelas_model');
		$result = $this->kelas_model->get_jurusan();
		
		$data = $this->prepareData ( $result['record'], $result['count'] );
		//	Only process if there are data available
		if ( $result['count'] > 0 )
		{
			$data = $this->formatId ( $data );
			$data = $this->prepareNumbering ( $data );
			$data = $this->prepareActionButton ( $data );
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

	public function ajax_list_kelas ()
	{
		$this->load->model ('kelas_model');
		$result = $this->kelas_model->get_kelas (NULL, true);
		
		$data = $this->prepareData ( $result['record'], $result['count'] );
		//	Only process if there are data available
		if ( $result['count'] > 0 )
		{
			$data = $this->formatId ( $data );
			$data = $this->prepareNumbering ( $data );
			$data = $this->prepareActionButton ( $data );
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

	public function ajax_anggota_kelas ()
	{
		$this->load->model ('kelas_model');
		$result = $this->kelas_model->get_anggota_kelas ();
		
		$data = $this->prepareData ( $result['record'], $result['count'] );
		//	Only process if there are data available
		if ( $result['count'] > 0 )
		{
			$data = $this->formatId ( $data );
			$data = $this->prepareActionButton ( $data );
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
