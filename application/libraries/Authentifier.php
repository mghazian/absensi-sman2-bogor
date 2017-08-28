<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentifier
{
	private $ci;

	public function __construct ()
	{
		$this->ci =& get_instance();
		$this->ci->load->library ('session');
	}

	/**
	 * Authenticate login request
	 *
	 * @param string $username
	 * @param string $raw_password
	 * @return bool
	 */
	public function authenticate ($username, $raw_password)
	{
		$this->ci->load->model ('user_model');
		$data = $this->ci->user_model->get_user (array ('username' => $username));

		if ( $data['count'] == 0 ) return FALSE;
		if ( password_verify ($raw_password, $data['record']['password']) )
		{
			$this->login($data['record']);
			return TRUE;
		}

		return FALSE;
	}

	/**
	 * Bookkeeps things that needs to be registered when logged in
	 *
	 * @param array $data
	 * @return void
	 */
	private function login ($data)
	{
		$this->ci->session->set_userdata ('id', $data['id']);
		$this->ci->session->set_userdata ('username', $data['username']);
		$this->ci->session->set_userdata ('privilege', 'admin');
	}

	/**
	 * Destroys session
	 *
	 * @return void
	 */
	public function logout ()
	{
		$this->ci->session->sess_destroy();
	}

	/**
	 * Protects page from being accessed without proper privilege
	 *
	 * @param string $privileges
	 * @param string $url_redirection
	 * @return void
	 */
	public function guard ($privileges, $url_redirection = 'home')
	{
		foreach ($privileges as $p)
			if ($this->ci->session->userdata ('privilege') == $p)
				return;
		
		redirect ($url_redirection);
	}

	public function get_login_data ($key = NULL)
	{
		if ( $key != NULL )
			return $this->ci->session->userdata ($key);
		
		$ud = $this->ci->session->userdata();
		return array_intersect_key ($ud, array ('id' => NULL, 'username' => NULL, 'privilege' => NULL));
	}
}