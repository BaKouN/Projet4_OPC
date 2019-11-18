<?php // ROUTEUR //test GIT
session_start();
require_once('Controller/commentController.php');
require_once('Controller/postController.php');
require_once('Controller/userController.php');
require_once('Controller/adminController.php');
require_once('Model/Manager.php');

$GLOBALS['dbConnected']=false;
$GLOBALS['websitePath'] = 'http://localhost/Projet4_OPC';
$URL = explode('/',$_SERVER['REQUEST_URI']);
array_shift($URL);
array_shift($URL);

try {
	if (!isset($URL[0])) throw new Exception('Erreur d\'URL');

	if (empty($URL[0]))
	{
		$postController = new postController();
		$postController->listPosts();
	} 
	else 
	{
		if ($URL[0] == 'post')
		{
			$postController = new postController();
			if (!isset($URL[1]) || empty($URL[1]))
			{
				$postController->listPosts();
			}
			else 
			{
				if(is_numeric($URL[1]))
				{
					$postID = $URL[1];
					if(!isset($URL[2]) || empty($URL[2]))
					{
						$postController->printPost($postID);
					}
					else if($URL[2] === 'update')
					{
						$postController->printUpdateView($postID);
					}
					else
					{
						throw new Exception ('Le site est un peu rigide.. Il ne comprends pas ce que vous voulez à ce pauvre post !');
					}
				} 
				else if ($URL[1] === 'create')
				{
					$postController->printCreateView();
				}
				else
				{
					throw new Exception('Un post doit etre ciblé d\un ID');
				}
			}
		}
		else if ($URL[0] === 'login')
		{
			$userController  = new UserController();
			$userController->printLoginView();
		}
		else if ($URL[0] === 'logout')
		{
			$userController  = new UserController();
			$userController->userLogout();
		}
		else if ($URL[0] === 'register')
		{
			$userController  = new UserController();
			$userController->printRegisterView();
		}
		else if ($URL[0] === 'adminPanel')
		{
			$adminController = new AdminController();
			$adminController->printAdminPanel();
		}
		else if ($URL[0] === 'api')
		{	
			if ($URL[1] === 'post')
			{
				$postController = new postController();
				if ($URL[2] === 'create')
				{
					if (!isset($_POST['title']) || !isset($_POST['content']) || empty($_POST['title']) || empty($_POST['content'])) throw new Exception ('Impossible d\'upload le post : Titre ou Contenu manquant !');
					$adminController = new AdminController();
					$postController->createPost($_POST['title'],$_POST['content']);
				}
				else if(is_numeric($URL[2]))
				{
					$postID = $URL[2];
					if ($URL[3] === 'update')
					{
						if(!isset($_POST['title']) || empty($_POST['title']) || !isset($_POST['content']) || empty($_POST['content'])) throw new Exception ('Billet non conforme !');
						$adminController = new AdminController();
						$postController->updatePost($postID, $_POST['title'], $_POST['content']);
					}
					else if ($URL[3] === 'delete')
					{
						$adminController = new AdminController();
						$postController->deletePost($postID);
					}
					else if($URL[3] === 'comment')
					{
						$commentController = new CommentController();
						if (isset($URL[4]) && !empty($URL[4]))
						{
							if ($URL[4] === 'create')
							{
								if (!isset($_POST['author']) || !isset($_POST['content']) || empty($_POST['author']) || empty($_POST['content'])) throw new Exception ('Commentaire vide !');
								$commentController->createComment($postID, $_POST['author'], $_POST['content']);
							}
							else if (is_numeric($URL[4]))
							{
								$commentID = $URL[4];
								if ($URL[5] === 'update')
								{
									$adminController = new AdminController();
									$commentController->updateComment($commentID);
								}
								else if ($URL[5] === 'delete')
								{
									$adminController = new AdminController();
									$commentController->deleteComment($commentID);
								}
								else if ($URL[5] === 'report')
								{
									if ($_SESSION['connected'] !== true) throw new Exception ("Vous devez etre connecté pour signaler un commentaire ! :)");
									$commentController->reportComment($commentID);
								}
								else
								{
									throw new Exeption('Erreur API : pas d\'action valide pour le commentaire');
								}
							}
							else 
							{
								throw new Exeption('Erreur API : pas d\'ID pour le commentaire ni de create');
							}
						}  
						else 
						{
							$commentController->printCommentsJSON($postID);
						}
					}
					else 
					{
						throw new Exception('L\'API ne sert pas à ca, dis donc...');
					}
				} 
				else
				{
					throw new Exception('Qu\'est ce que tu viens chercher ?');
				}
			}
			else if ($URL[1] === 'user')
			{
				if ($URL[2] === 'login')
				{
					$userController  = new UserController();
					if (!isset($_POST['login']) || !isset($_POST['password']) || empty($_POST['login']) || empty($_POST['password'])) throw new Exception ('INFOS LOGIN VIDE');
					$userController->userLogin($_POST['login'],$_POST['password']);
				}
				else if ($URL[2] === 'register')
				{
					$userController  = new UserController();
					if (!isset($_POST['login']) || !isset($_POST['password']) || empty($_POST['login']) || empty($_POST['password']) || !isset($_POST['password2']) || empty($_POST['password2'])) throw new Exception ('INFOS REGISTER VIDE');
					$userController->userRegister($_POST['login'], $_POST['password'], $_POST['password2']);
				}
				else
				{
					throw new Exception ('API::USER mais en dehors du CRUD, sérieusement ?');
				}
			}
		}
		else
		{
			throw new Exception('El famoso Error 404 ! : Ni post, ni login, ni api ... Je ne sais pas ce que tu recherches la...');
		}
	}
	if($GLOBALS['dbConnected']===true)
	{
		$Manager = new Manager();
		$Manager->dbDisconnect();
	}
}
catch(Exception $e) { // S'il y a eu une erreur, alors...
	require_once('view/errorView.php');
}
