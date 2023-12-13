<?php

class Auth_model extends CI_Model
{
	public function login($username, $password)
	{
		$query = $this->db->get_where('user', [
			'username' => $username,
			'password' => $password
		]);
		if ($query->num_rows() == 1) {
			return true;
		} else {
			return false;
		}
	}

	public function current_user()
	{
		return $this->session->userdata('username');
	}
}
?>