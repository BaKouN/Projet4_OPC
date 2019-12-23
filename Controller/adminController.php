<?php
require_once('userController.php');
require_once('postController.php');

class AdminController
{
	function __construct()
	{
		if (!isset($_SESSION['user']) || !isset($_SESSION['token']) || empty($_SESSION['user']) || empty($_SESSION['token'])) 
			throw new Exception ('Informations de connexion perdues. Veullez vous reconnecter !');

		if(!$this->isAdmin($_SESSION['token']))
			throw new Exception('Accès Refusé ! Vous n\'etes pas administrateur !');
	}

	public function isAdmin($token)
	{
		$this->userController = new userController();
		if (!$this->userController->findUserByToken($token)) 
			return false;

		$user = $this->userController->findUserByToken($token);

		if (!($user['rank'] == 1)) 
			return false;
			
		return true;
	}


	public function printAdminPanel()
	{
		$this->postController = new postController();
		$posts = $this->postController->getPosts();

		$this->commentController = new commentController();
		$reportedComments = $this->commentController->getReportedComments();
		require_once('View/adminPanelView.php');
	}
} 
