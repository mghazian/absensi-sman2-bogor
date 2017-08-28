<?php
if ( ! function_exists ("date_formatter") )
{
	/**
	 * Transforms a date format to another
	 *
	 * @param string $date
	 * @param string $original_format
	 * @param string $target_format
	 * @return mixed
	 */
	function date_formatter ( $date, $original_format, $target_format )
	{
		$date = date_create_from_format ( $original_format, $date );
		return date_format ( $date, $target_format );
	}

	/**
	 * Transforms a date into a form recognizable by MySQL
	 *
	 * @param string $date
	 * @param $string $original_format
	 * @return mixed
	 */
	function mysql_friendly_date ( $date, $original_format )
	{
		return date_formatter ( $date, $original_format, "Y-m-d" );
	}
}