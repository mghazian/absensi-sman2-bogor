<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'Generic_model.php';

class User_model extends Generic_model {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	//----------------------------CRUD-----------------------------//
	public function update_user ( $id, $data )
	{
		//	Filter for specified column
		$data = $this->filter ( $data, array ('username', 'password') );

		$this->db->set ($data);
		$this->db->where ('id', $id);
		
		return $this->write_result_wrapper ( $this->db->update ('data_user') );
	}
	
	//-----------------------------GET----------------------------//
	public function get_user ( $condition = NULL )
	{
		if ( $condition != NULL )
			$this->db->where ( $condition );
		
		return $this->get_wrapper ('data_user');
	}
}
