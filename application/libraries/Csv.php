<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Csv 
{
	public function __construct ()
	{
		
	}

	/**
	 * Reads a csv file and transforms it to array. Cell dlimiter that is set to newline may not work well
	 *
	 * @param string $filename 			Path to the file that will be read
	 * @param string $row_delimiter 	What character that separates csv row
	 * @param string $cell_delimiter 	What character that separates csv cell (element in the same row)
	 * @param array $keys 				Optional. Assign keys that corresponds value for every row
	 * @return void
	 */
	public function read_csv_file ($filename, $row_delimiter = "\n", $cell_delimiter = ";", $keys = NULL)
	{
		$rows = array();

		//	More effective method for newline line delimiter
		if ($row_delimiter == "\n")
			$rows = $this->read_csv_by_newline ($filename, $cell_delimiter);
		else
		{
			$rows = str_getcsv (file_get_contents ($filename), $row_delimiter);
			foreach ($rows as & $row)
				$row = str_getcsv ($row, $cell_delimiter);
			
			unset ($row);
			
			//	Filters so that only array with non NULL member exist
			$rows = array_filter ($rows, function ($val)
				{
					//var_dump ($val);
					foreach ($val as $v)
						if ($v != NULL)
							return true;
					return false;
				}
			);
		}
		
		//	Use key? Is the number of keys match with the number of element of a row?
		if ( is_array ($keys) && (count ($rows[0]) == count ($keys)) )
		{
			foreach ($rows as $current_row)
			{
				$keyed_row = array();

				//	Transform array index to key array
				for ($i = 0; $i < count ($keys); $i++)
					$keyed_row[ $keys[$i] ] = $current_row[ $i ];
				
				$output[] = $keyed_row;
			}
		}
		else
			$output = $rows;

		return $output;
	}

	private function read_csv_by_newline ($filename, $cell_delimiter = ";")
	{
		$rows = file ($filename);
		foreach ($rows as & $row)
			$row = str_getcsv ( trim ($row), $cell_delimiter );
		
		unset ($row);
		return $rows;
	}

	
}