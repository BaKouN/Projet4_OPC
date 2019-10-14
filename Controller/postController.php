<?php

require_once('./Model/PostManager.php');

class postController
{
	function __construct()
	{
		$this->postManager = new PostManager();
	}

	public function listPosts()
	{
		$posts = $this->postManager->getPosts();
		require('view/frontend/listPostsView.php');
	}

	public function printPost($postID)
	{
			if ($this->postManager->postExist($postID))
			{
				$post = $this->postManager->getPost($postID);
				require('view/frontend/postView.php');
			}	
			else 
			{
				throw new Exception('Ce post n\'existe pas');
			}
	}
} 

