<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generic_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	/**
	 * Removes given key in given array
	 *
	 * @param array $array The filtered array
	 * @param mixed $key May be a string or an array consisting the key name(s)
	 * @return array An array without values stored in $key
	 */
	protected function expunge ($array, $key)
	{
		if ( ! is_array ($array) )
			return NULL;
		
		if ( ! is_array ($key) )
			$key = array ($key);
		
		$proper_key = array();

		foreach ($key as $k)
			$proper_key[$k] = NULL;
		
		return array_diff_key ($array, $proper_key);
	}

	/**
	 * Filters array to only have certain key
	 *
	 * @param array $array The filtered array
	 * @param mixed $key May be a string or an array consisting the key name(s)
	 * @return array An array with values under key(s) in $key
	 */
	protected function filter ($array, $key)
	{
		if ( ! is_array ($key) )
			$key = array ($key => NULL);
		
		$proper_key = array();

		foreach ($key as $k)
			$proper_key[$k] = NULL;
		
		return array_intersect_key ($array, $proper_key);
	}

	/**
	 * Check whether or not the specified data is exist in the database
	 *
	 * @param string $table
	 * @param array $data
	 * @return array
	 */
	protected function is_exist ($table, $data)
	{
		$this->db->where ($data);
		return ( $this->db->get ($table, $data)->num_rows() > 0 );
	}

	/**
	 * A closure to CI database library get function to provide clean and complete information
	 *
	 * @param string $table
	 * @param int $limit
	 * @param int $offset
	 * @return array
	 */
	protected function get_wrapper ($table, $limit = NULL, $offset = NULL)
	{
		$output = array();
		$query_result = $this->db->get ($table, $limit, $offset);
		
		$output['count'] = $query_result->num_rows();
		$output['total'] = $this->db->count_all ($table);
		$output['record'] = array ();
		
		if ($output['count'] == 1)
			$output['record'] = $query_result->row_array();
		else
			$output['record'] = $query_result->result_array();
		
		return $output;
	}

	/**
	 * Formats the output from query write (i.e. INSERT, UPDATE, DELETE) function:
	 * > TRUE if query write function returns TRUE
	 * > String of error message otherwise
	 * 
	 * @param boolean $query_result
	 * @return mixed
	 */
	protected function write_result_wrapper ($query_result)
	{
		return ( $query_result ) ?
			TRUE : $this->db->error();
	}
}
