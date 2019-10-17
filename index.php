<?php // ROUTEUR

require('Controller/commentController.php');
require('Controller/postController.php');

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
					$postController->printPost($postID);
				} 
				else
				{
					throw new Exception('Un post doit etre ciblé d\un ID');
				}
			}
		}
		else if ($URL[0] === 'admin')
		{
			//BLABLABLA 
		}
		else if ($URL[0] === 'api')
		{
			if ($URL[1] === 'post')
			{
				$postController = new postController();
				if ($URL[2] === 'create')
				{
					if (!isset($_POST['title']) || !isset($_POST['content']) || empty($_POST['title']) || empty($_POST['content'])) throw new Exception ('Impossible d\'upload le post : Titre ou Contenu manquant !');
					$postController->createPost($_POST['title'],$_POST['content']);
				}
				else if(is_numeric($URL[2]))
				{
					$postID = $URL[2];
					if ($URL[3] === 'update')
					{
						if(!isset($_POST['title']) || empty($_POST['title']) || !isset($_POST['content']) || empty($_POST['content'])) throw new Exception ('Billet non conforme !');
						$postController->updatePost($postID, $_POST['title'], $_POST['content']);
					}
					else if ($URL[3] === 'delete')
					{
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
									if (!isset($_POST['content']) || empty($_POST['content'])) throw new Exception ('Commentaire vide !');
									$commentController->updateComment($commentID, $_POST['content']);
								}
								else if ($URL[5] === 'delete')
								{
									$commentController->deleteComment($commentID);
								}
							}
							else 
							{
								throw new Exeption('Erreur API : pas d\'ID pour le commentaire ni de create');
							}
						}  
						else 
						{
							$commentController->getComments($postID);
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
			else 
			{
				throw new Exception ('Tu t\'es perdu poto');
			}
		}
		else
		{
			throw new Exception('El famoso Error 404 ! : Ni post, ni Admin, ni api ... Je ne sais pas ce que tu recherches la...');
		}
	}
}
catch(Exception $e) { // S'il y a eu une erreur, alors...
	require('view/errorView.php');
}
