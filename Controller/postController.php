<?php

require_once('./Model/PostManager.php');

class PostController
{
	function __construct()
	{
		$this->postManager = new postManager();
	}

	public function listPosts()
	{
		$posts = $this->postManager->getPosts();
		require('view/frontend/listPostsView.php');
	}

	public function printPost($postID)
	{
			if ($this->postExist($postID))
			{
				$post = $this->postManager->getPost($postID);
				require('view/frontend/postView.php');
			}	
			else 
			{
				throw new Exception('Ce post n\'existe pas');
			}
	}

	public function postExist($postID)
	{
		return $this->postManager->postExist($postID);
	}
} 
