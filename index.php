<?php // ROUTEUR

require('Controller/commentController.php');
require('Controller/postController.php');

$GLOBALS['websitePath'] = 'http://localhost/Projet4';
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
			$postController= new postController();
			if (!isset($URL[1]) || empty($URL[1]))
			{
				$postController->listPosts();
			}
			else 
			{
				if(is_numeric($URL[1]))
				{
					$postID = $URL[1];
					if (isset($URL['2']) && !empty($URL[2]))
					{
						// BLABLALBLALBLA ( CA VA ETRE LES TRUCS GENRE: "COMMENT"/"REPORT" )
					}
					else 
					{
						$postController->printPost($postID);
					}
				} 
				else
				{
					throw new Exception('El famoso Error 404 !');
				}
			}
		}
		else if ($URL[0] == 'admin')
		{
			//BLABLABLA 
		}
		else
		{
			throw new Exception('El famoso Error 404 !');
		}
	}
}
catch(Exception $e) { // S'il y a eu une erreur, alors...
	require('view/errorView.php');
}
