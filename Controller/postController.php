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
		$posts = $this->getPosts();
		require_once('view/listPostsView.php');
	}

	public function getPosts()
	{
		$posts = $this->postManager->getPosts();
		return $posts;
	}

	public function printPost($postID)
	{
		if ($this->postExist($postID))
		{
			$post = $this->postManager->getPost($postID);
			require_once('view/postView.php');
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

	public function updatePost($postID, $title, $content)
	{
		$this->adminController = new AdminController();
		if (!$this->postExist($postID))throw new Exception ('Billet inexistant');
		$status = $this->postManager->updatePost($postID, $title, $content);
		echo (!!$status);
	}

	public function deletePost($postID)
	{
		$this->adminController = new AdminController();
		$this->commentController = new CommentController();
		if (!$this->postExist($postID)) throw new Exception ('Billet inexistant');
		$status = $this->postManager->deletePost($postID);
		$this->commentController->deleteRelatedComments($postID);
		echo (!!$status);
	}

	public function printCreateView()
	{
		$this->adminController = new AdminController();
		require_once('view/CUView.php');
	}

	public function createPost($title, $content)
	{
		$this->adminController = new AdminController();
		$cleanContent = htmlspecialchars($content);
		$status = $this->postManager->createPost($title, $cleanContent);
		echo (!!$status);
	}

	public function shortText($input) 
	{	
		$length = 100;
		if (strlen($input) <= $length)
			return $input;
	
		$last_space = strrpos(substr($input, 0, $length), ' ');
		if($last_space !== false) {
			$trimmed_text = substr($input, 0, $last_space);
		} else {
			$trimmed_text = substr($input, 0, $length);
		}

			$trimmed_text .= '...';
	
		return $trimmed_text;
	}
} 
