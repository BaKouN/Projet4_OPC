<?php
require_once('./Model/CommentManager.php');

class CommentController
{
	function __construct()
	{
		$this->commentManager = new CommentManager();
		$this->postController = new PostController();
	}

	public function postComment($postId, $author, $content)
	{
		if (!$this->postController->postExist($postId)){throw new Exception ('Post inexistant');}
		$status = $this->commentManager->postComment($postId, $author, $content);
		return (!!$status);
	}

	public function getComments($postId)
	{
		echo(json_encode($this->commentManager->getComments($postId)->fetchAll()));
	}
} 
