<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller to handle ajax request. Due to how routing works, any class extending
 * this class must has '_request' suffix. Calling the corresponding controller must,
 * however, without the '_request' suffix, and prepended with 'ajax/'
 * 
 * Example
 * foo_request/my_ajax -> ajax/foo/my_ajax
 * bar_request/another_ajax/data -> ajax/bar/another_ajax/data
 */

class Ajax_request extends CI_Controller {

	protected $markup;

	public function __construct()
	{
		parent::__construct();

		$this->markup['edit_button_class'] = "waves-effect waves-light edit-button";
		$this->markup['delete_button_class'] = "waves-effect waves-light delete-button";
		$this->markup['button_style'] = "padding: 6px";
	}

	protected function prepareData ( $data, $data_count )
	{
		if 		( $data_count > 1 ) 	return $data 			; 	//	Assumes the data is already in proper format
		else if ( $data_count == 0 ) 	return array() 			; 	//	Empty data
		else if ( count ($data) == 1 ) 	return $data 			; 	//	Only one item -- and assumed to be already in proper format
		else 							return array ( $data )	;	//	Only one item -- and not in proper format
	}
	
	protected function prepareActionButton ( $data )
	{
		$output = array();
		
		for ($i = 0; $i < count ($data); $i++)
		{
			$output[$i] = array_merge ($data[$i], array (
				'action'	=>
					'<a class="' . $this->markup['edit_button_class'] . '" style="' . $this->markup['button_style'] . '" href="#"><i class="material-icons">create</i></a>
					<a class="' . $this->markup['delete_button_class'] . '" style="' . $this->markup['button_style'] . '" href="#"><i class="material-icons">delete</i></a>'
				)
			);
		}

		return $output;
	}

	protected function formatId ( $data, $id_key = 'id', $format = 'id{id}' )
	{
		for ($i = 0; $i < count ($data); $i++)
			$data[$i][$id_key] = preg_replace ('/{id}/', $data[$i][$id_key], $format);
		
		return $data;
	}

	protected function prepareNumbering ( $data )
	{
		for ($i = 0; $i < count ($data); $i++)
			$data[$i]['no'] = $i + 1;
		
		return $data;
	}
}
