<?php
if ( ! function_exists ("set_error_message") )
{
	/**
	 * Sets error message in form of flashdata
	 *
	 * @param mixed $message
	 * @return void
	 */
	function set_error_message ( $message )
	{
		$ci =& get_instance();
		$ci->session->set_flashdata ('error_message', $message);
	}
}

if ( ! function_exists ("set_success_message") )
{
	/**
	 * Sets success message in form of flashdata
	 *
	 * @param mixed $message
	 * @return void
	 */
	function set_success_message ( $message )
	{
		$ci =& get_instance();
		$ci->session->set_flashdata ('success_message', $message);
	}
}

if ( ! function_exists ("show_error_message") )
{
	/**
	 * Formats the error message to HTML
	 *
	 * @return void
	 */
	function show_error_message ()
	{
		$ci =& get_instance();
		$message = $ci->session->flashdata ('error_message');

		//	Do not show message if no error message exists
		if ( $message == NULL || $message == "" ) return;

		if ( is_array ($message) )
		{
			$html_message = "<ul>";
			foreach ($message as $m)
				$html_message .= "<li>" . $m . "</li>";
			$html_message .= "</ul>";
		}
		else
			$html_message = $message;

		$html = 
		'<div class="card-panel red white-text" id="error_message">
			<div class="right"><a href="#"><i class="material-icons closer white-text">close</i></a></div>
			<div class="row valign-wrapper">
				<i class="material-icons" style="font-size: 45px;">error_outline</i><span style="padding-left: 2rem; font-size: 45px;"> ERROR</span>
			</div>
			<div style="padding-left: 2rem">
				<div>' . $html_message . '</div>
			</div>
		</div>';

		$js =
		'<script>
			$(".closer").click (function ()
			{	$("#error_message").fadeOut();	});
		</script>';

		echo $html . $js;
	}
}

if ( ! function_exists ("show_success_message") )
{
	/**
	 * Formats the success message to HTML
	 *
	 * @return void
	 */
	function show_success_message ()
	{
		$ci =& get_instance();
		$message = $ci->session->flashdata ('success_message');

		//	Do not show message if no error message exists
		if ( $message == NULL || $message == "" ) return;

		if ( is_array ($message) )
		{
			$html_message = "<ul>";
			foreach ($message as $m)
				$html_message .= "<li>" . $m . "</li>";
			$html_message .= "</ul>";
		}
		else
			$html_message = $message;

		$html = 
		'<div class="card-panel green lighten-2 white-text" id="success_message">
			<div class="right"><a href="#"><i class="material-icons closer white-text">close</i></a></div>
			<div class="row valign-wrapper">
				<i class="material-icons" style="font-size: 45px;">check</i><span style="padding-left: 2rem; font-size: 45px;"> BERHASIL</span>
			</div>
			<div style="padding-left: 2rem">
				<div>' . $html_message . '</div>
			</div>
		</div>';

		$js =
		'<script>
			$(".closer").click (function ()
			{	$("#error_message").fadeOut();	});
		</script>';

		echo $html . $js;
	}
}