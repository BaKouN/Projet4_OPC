<?php

require_once('./Model/UserManager.php');

class UserController
{
	function __construct()
	{
		$this->userManager = new UserManager();
	}

	protected function userExist($login)
	{
		return $this->userManager->userExist($login);
	}

	protected function  checkCredentials($login,$password)
	{
		$user = $this->userManager->getUser($login);
		return ($user['password'] === $password);
	}

	protected function setToken($login, $token)
	{
		return $this->userManager->setToken($login, $token);
	}

	public function printLoginPage()
	{
		require('View/loginView.php');
	}

	public function userLogin($login, $password)
	{
		if(!$this->userExist($login)) {
			echo json_encode('Erreur Authentification : Utilisateur inexistant !');
			return;}

		if (!$this->checkCredentials($login,$password)) {
			echo json_encode('Erreur Authentification : Mot de passe éronné !');
			return;}

		$token = bin2hex(random_bytes(32));
		if (!$this->setToken($login, $token)) {
			echo json_encode('Erreur Authentification : Token non généré !');
			return;}

		$_SESSION['token']=$token;
		$_SESSION['token_expiration_date']="";
		$_SESSION['connected']=true;
		$user = $this->findUserByToken($token);
		$_SESSION['rank']=$user['rank'];

		echo json_encode($_SESSION);
	}

	public function userLogout()
	{
		if(isset($_SESSION['connected']) && $_SESSION['connected'] == true)
		{
			$user = $this->findUserByToken($_SESSION['token']);
			if(!$user) throw new Exception ('Token expiré');
			$this->setToken($user['username'], "");
			unset($_SESSION);
			session_destroy();
		}
		header('location: '.$GLOBALS['websitePath']);
	}

	public function findUserByToken($token)
	{
		return $this->userManager->findUserByToken($token);
	}
}
