<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'Generic_model.php';

class Siswa_model extends Generic_model {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	//-------------------------CRUD Siswa---------------------------//
	public function insert_siswa ( $data, $force_update = false )
	{
		//	Filter for specified column
		$data = $this->filter ( $data, array ('nama', 'nisn', 'nis', 'jenis_kelamin') );

		$column_identifier = array_diff_key ( $data, array ('id' => NULL) );
		if ( $this->is_exist ( 'data_siswa', $column_identifier ) )
		{
			if ( $force_update )
			{
				$this->db->set ($data);
				$this->db->where ($column_identifier);

				return $this->write_result_wrapper ( $this->db->update ('data_siswa') );
			}

			return TRUE;
		}
		
		return $this->write_result_wrapper ( $this->db->insert('data_siswa', $data) );
	}

	public function update_siswa ( $id, $data )
	{	
		//	Filter for specified column
		$data = $this->filter ( $data, array ('nama', 'nisn', 'nis', 'jenis_kelamin') );

		$this->db->set ($data);
		$this->db->where ('id', $id);
		
		return $this->write_result_wrapper ( $this->db->update ('data_siswa') );
	}

	public function delete_siswa ( $id )
	{
		$this->db->where ('id', $id);
		return $this->write_result_wrapper ( $this->db->delete ('data_siswa') );
	}

	//-------------------------CRUD Kehadiran---------------------------//
	public function insert_kehadiran_siswa ( $data, $force_update = false )
	{
		//	Filter for specified column
		$data = $this->filter ( $data, array ('id_siswa', 'tanggal', 'id_status_kehadiran') );

		$column_identifier = array_diff_key ( $data, array ('id_status_kehadiran' => NULL) );
		if ( $this->is_exist ( 'transaksi_kehadiran_siswa', $column_identifier ) )
		{
			if ( $force_update )
			{
				$this->db->set ($data);
				$this->db->where ($column_identifier);

				return $this->write_result_wrapper ( $this->db->update ('transaksi_kehadiran_siswa') );
			}

			return TRUE;
		}
		
		return $this->write_result_wrapper ( $this->db->insert('transaksi_kehadiran_siswa', $data) );
	}

	public function update_kehadiran_siswa ( $id, $data )
	{	
		//	Filter for specified column
		$data = $this->filter ( $data, array ('id_siswa', 'tanggal', 'id_status_kehadiran') );

		$this->db->set ($data);
		$this->db->where ('id', $id);
		
		return $this->write_result_wrapper ( $this->db->update ('transaksi_kehadiran_siswa') );
	}

	public function delete_kehadiran_siswa ( $id )
	{
		$this->db->where ('id', $id);
		return $this->write_result_wrapper ( $this->db->delete ('transaksi_kehadiran_siswa') );
	}

	//--------------------------GET----------------------------//
	public function get_siswa ( $condition = NULL )
	{
		if ( $condition != NULL )
			$this->db->where ($condition);
		
		return $this->get_wrapper ('data_siswa');
	}

	public function get_kehadiran_siswa ( $condition = NULL, $readable = false, $complete = false )
	{
		if ( $condition != NULL )
			$this->db->where ($condition);
		
		if ( $readable )
		{
			//	Collect foreign kyes?
			if ( ! $complete )
				$this->db->select ('
					transaksi_kehadiran_siswa.tanggal,
					
					data_siswa.nama,
					data_siswa.nisn,
					data_siswa.nis,
					data_siswa.jenis_kelamin,
					
					ref_status_kehadiran.status');
			
			$this->db->join ('ref_status_kehadiran', 'ref_status_kehadiran.id = transaksi_kehadiran_siswa.id_status_kehadiran');
			$this->db->join ('data_siswa', 'data_siswa.id = transaksi_kehadiran_siswa.id_siswa');
		}

		return $this->get_wrapper ('transaksi_kehadiran_siswa');
	}

	public function get_status_kehadiran ( $condition = NULL )
	{
		if ( $condition != NULL )
			$this->db->where ( $condition );
		
		return $this->get_wrapper ('ref_status_kehadiran');
	}

	public function get_kehadiran_dengan_kelas ( $condition = NULL )
	{
		if ( $condition != NULL )
			$this->db->where ( $condition );
		
		$this->db->join ('ref_status_kehadiran', 'ref_status_kehadiran.id = transaksi_kehadiran_siswa.id_status_kehadiran');
		$this->db->join ('data_siswa', 'data_siswa.id = transaksi_kehadiran_siswa.id_siswa');
		$this->db->join ('transaksi_kepesertaan_kelas', 'data_siswa.id = transaksi_kepesertaan_kelas.id_siswa');
		$this->db->join ('ref_kelas', 'ref_kelas.id = transaksi_kepesertaan_kelas.id_kelas');
		$this->db->join ('ref_jurusan', 'ref_jurusan.id = ref_kelas.id_jurusan');

		return $this->get_wrapper ('transaksi_kehadiran_siswa');
	}
}
