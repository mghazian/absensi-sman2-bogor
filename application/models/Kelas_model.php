<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'Generic_model.php';

class Kelas_model extends Generic_model {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	//-------------------------CRUD Kelas---------------------------//
	public function insert_kelas ( $data )
	{
		//	Filter for specified column
		$data = $this->filter ( $data, array ('nomor', 'id_jurusan', 'jenjang') );

		//	Unique index test
		if ( $this->is_exist ('ref_kelas', $data) )
			return "Data sudah ada pada database. Data tidak boleh duplikat.";
		
		return $this->write_result_wrapper ( $this->db->insert('ref_kelas', $data) );
	}

	public function update_kelas ( $id, $data )
	{
		//	Unique index test
		if ( $this->is_exist ('ref_kelas', $data) )
			return "Data sudah ada pada database. Data tidak boleh duplikat.";
		
		//	Filter for specified column
		$data = $this->filter ( $data, array ('nomor', 'id_jurusan', 'jenjang') );
		$this->db->set ($data);
		$this->db->where ('id', $id);
		
		return $this->write_result_wrapper ( $this->db->update ('ref_kelas') );
	}

	public function delete_kelas ( $id )
	{
		$this->db->where ('id', $id);
		return $this->write_result_wrapper ( $this->db->delete ('ref_kelas') );
	}

	//-------------------------CRUD Jurusan---------------------------//
	public function insert_jurusan_kelas ( $data )
	{
		//	Filter for specified column
		$data = $this->filter ( $data, array ('jurusan') );

		//	Unique index test
		if ( $this->is_exist ('ref_jurusan', $data) )
			return "Data sudah ada pada database. Data tidak boleh duplikat.";
		
		return $this->write_result_wrapper ( $this->db->insert ('ref_jurusan', $data) );
	}

	public function update_jurusan_kelas ( $id, $data )
	{	
		//	Unique index test
		if ( $this->is_exist ('ref_jurusan', $data) )
			return "Data sudah ada pada database. Data tidak boleh duplikat.";
		
		//	Filter for specified column
		$data = $this->filter ( $data, array ('jurusan') );
		$this->db->set ($data);
		$this->db->where ('id', $id);

		return $this->write_result_wrapper ( $this->db->update ('ref_jurusan') );
	}

	public function delete_jurusan_kelas ( $id )
	{
		$this->db->where ('id', $id);
		return $this->write_result_wrapper ( $this->db->delete ('ref_jurusan') );
	}

	//----------------------CRUD Kepesertaan kelas--------------------------//
	public function insert_kepesertaan_kelas ( $data )
	{
		//	Filter for specified column
		$data = $this->filter ( $data, array ('id_siswa', 'id_kelas', 'tahun_ajar') );

		//	Unique index test
		if ( $this->is_exist ('transaksi_kepesertaan_kelas', $data) )
			return "Data sudah ada pada database. Data tidak boleh duplikat.";
		
		return $this->write_result_wrapper ( $this->db->insert ('transaksi_kepesertaan_kelas', $data) );
	}

	public function update_kepesertaan_kelas ( $id, $data )
	{	
		//	Unique index test
		if ( $this->is_exist ('transaksi_kepesertaan_kelas', $data) )
			return "Data sudah ada pada database. Data tidak boleh duplikat.";
		
		//	Filter for specified column
		$data = $this->filter ( $data, array ('id_siswa', 'id_kelas', 'tahun_ajar') );
		$this->db->set ($data);
		$this->db->where ('id', $id);

		return $this->write_result_wrapper ( $this->db->update ('transaksi_kepesertaan_kelas') );
	}

	public function delete_kepesertaan_kelas ( $id )
	{
		$this->db->where ('id', $id);
		return $this->write_result_wrapper ( $this->db->delete ('transaksi_kepesertaan_kelas') );
	}

	//--------------------------GET----------------------------//
	public function get_jurusan ( $condition = NULL )
	{
		if ( $condition != NULL )
			$this->db->where ($condition);

		return $this->get_wrapper ('ref_jurusan');
		
	}

	public function get_kelas ( $condition = NULL, $readable = false, $complete = false )
	{
		if ( $condition != NULL )
			$this->db->where ($condition);
		
		if ( $readable )
		{
			//	No foreign keys id?
			if ( ! $complete )
				$this->db->select ('ref_kelas.id, ref_kelas.nomor, ref_jurusan.jurusan, ref_kelas.jenjang');
			else
				$this->db->select ('ref_kelas.*, ref_jurusan.jurusan');

			$this->db->join ('ref_jurusan', 'ref_jurusan.id = ref_kelas.id_jurusan');
		}

		return $this->get_wrapper ('ref_kelas');
	}

	public function get_anggota_kelas ( $condition = NULL )
	{
		if ( $condition != NULL )
			$this->db->where ($condition);

		$this->db->join ('ref_kelas', 'ref_kelas.id = transaksi_kepesertaan_kelas.id_kelas');
		$this->db->join ('data_siswa', 'data_siswa.id = transaksi_kepesertaan_kelas.id_siswa');
		$this->db->join ('ref_jurusan', 'ref_jurusan.id = ref_kelas.id_jurusan');

		return $this->get_wrapper ('transaksi_kepesertaan_kelas');
	}
}
