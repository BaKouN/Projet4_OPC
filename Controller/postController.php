<?php

require_once('./Model/PostManager.php');

class PostController
{
	function __construct()
	{
		$this->postManager = new PostManager();
	}

	public function listPosts()
	{
		$posts = $this->postManager->getPosts();
		require('view/listPostsView.php');
	}

	public function printPost($postID)
	{
		if ($this->postExist($postID))
		{
			$post = $this->postManager->getPost($postID);
			require('view/postView.php');
		}	
		else 
		{
			throw new Exception('Ce post n\'existe pas');
		}
	}

	protected function postExist($postID)
	{
		return $this->postManager->postExist($postID);
	}

	public function updatePost($postID, $title, $content)
	{
		if (!$this->postExist($postID))throw new Exception ('Billet inexistant');
		$status = $this->postManager->updatePost($postID, $title, $content);
		echo (!!$status);
	}

	public function deletePost($postID)
	{
		if (!$this->postExist($postID)) throw new Exception ('Billet inexistant');
		$status = $this->postManager->deletePost($postID);
		echo (!!$status);
	}

	public function createPost($title, $content)
	{
		$status = $this->postManager->createPost($title, $content);
		echo (!!$status);
	}
} 
