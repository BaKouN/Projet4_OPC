<?php
require_once('Manager.php');

class UserManager extends Manager
{
	public function userExist($login)
	{
		$req = $this->db->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
		$req->execute(array($login));
		$count = $req->fetch();
		$req->closeCursor();
		return !!$count[0];
	}

	public function userRegister($login, $password)
	{
		$user = $this->db->prepare('INSERT INTO users(username, password) VALUES(?, ?)');
        $status = $user->execute(
			array(
				$login,
				$password
			));
		$user->closeCursor();
		
        return $status;
	}

	public function getUser($login)
	{
		$req = $this->db->prepare("SELECT * FROM users WHERE username = ?");
		$req->execute(array($login));
		$user = $req->fetch();
		$req->closeCursor();
		
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
		$req->closeCursor();
		
		return $status;
	}

	public function findUserByToken($token)
	{
		$req = $this->db->prepare("SELECT * FROM users WHERE token = ?");
		$req->execute(array($token));
		$user = $req->fetch();
		$req->closeCursor();
		
		return $user;
	}
}
