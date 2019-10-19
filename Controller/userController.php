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
		// check session, 
		// si session 1 -> Index
		// Si session 0 -> loginView
		require('./View/Frontend/loginView.php');
	}

	public function loginUser($login, $password)
	{
		if(!$this->userExist($login)) {
			echo 'Erreur Authentification : Utilisateur inexistant !';
			return;}

		if (!$this->checkCredentials($login,$password)) {
			echo 'Erreur Authentification : Mot de passe éronné !';
			return;}

		$token = bin2hex(random_bytes(32));
		if (!$this->setToken($login, $token)) {
			echo 'Erreur Authentification : Token non généré !';
			return;}

		$_SESSION['token']=$token;
		$_SESSION['token_expiration_date']="";
		$_SESSION['connected']=true;

		echo json_encode($_SESSION);
	}
}
