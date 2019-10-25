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
		return password_verify($password, $user['password']);
	}

	protected function setToken($login, $token)
	{
		return $this->userManager->setToken($login, $token);
	}

	protected function passwordMatch($password, $password2)
	{
		if($password === $password2) return true;
		return false;
	}

	public function printLoginView()
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

	public function userRegister($login, $password, $password2)
	{
		// verifier si le nom d'utilisateur est déjà pris
		if($this->userExist($login))
		{
			echo json_encode('Erreur Inscription : Nom d\'utilisateur déjà utilisé !');
			return;}
		// verifier si les deux mots de passes sont les memes
		if(!$this->passwordMatch($password, $password2))
		{
			echo json_encode('Erreur Inscription : Les deux mots de passes ne correspondent pas !');
			return;}
			// sinon autoriser l'inscription
		// IMPORTANT : DEMANDER A STAN COMMENT CHECKER AVEC LE STATUT MAIS NE PAS LANCER LA FONCTION DEUX FOIS (UN IF ! ET UN IF SANS  ????)
		echo json_encode('Inscription effectué ! Vous serez redirigé vers l\'accueil dans un instant !');
		$hashPassword = password_hash($password , PASSWORD_DEFAULT);
		$this->userManager->UserRegister($login, $hashPassword);
	}

	

	public function printRegisterView()
	{
		require("View/registerView.php");
	}

	public function findUserByToken($token)
	{
		return $this->userManager->findUserByToken($token);
	}
}
