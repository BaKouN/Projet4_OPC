<?php
require_once('Manager.php');

class UserManager extends Manager
{
	public function userExist($login)
	{
		$req = $this->db->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
		$req->execute(array($login));
		$count = $req->fetch();
		return !!$count[0];
	}

	public function getUser($login)
	{
		$req = $this->db->prepare("SELECT * FROM users WHERE username = ?");
		$req->execute(array($login));
		$user = $req->fetch();
		return $user;
	}

	public function setToken($login,$token)
	{
		$req = $this->db->prepare('UPDATE users SET token = ? WHERE username = ?');
		$status = $req->execute(
			array(
				$token,
				$login
		));

		return $status;
	}
}
