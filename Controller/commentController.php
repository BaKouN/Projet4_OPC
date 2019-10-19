<?php
require_once('./Model/CommentManager.php');

class CommentController
{
	function __construct()
	{
		$this->commentManager = new CommentManager();
		$this->postController = new PostController();
	}

	public function createComment($postId, $author, $content)
	{
		$clean_author = htmlentities($author);
		$clean_content = htmlentities($content);
		if (!$this->postController->postExist($postId))throw new Exception ('Post inexistant');
		$status = $this->commentManager->createComment($postId, $clean_author, $clean_content);
		echo (!!$status);
	}

	public function getComments($postId)
	{
		echo(json_encode($this->commentManager->getComments($postId)->fetchAll()));
	}

	protected function commentExist($commentID)
	{
		return $this->commentManager->commentExist($commentID);
	}

	public function deleteComment($commentID)
	{
		if (!$this->commentExist($commentID))throw new Exception ('Commentaire inexistant');
		$status = $this->commentManager->deleteComment($commentID);
		echo (!!$status);
	}

	public function updateComment($commentID, $content)
	{
		if (!$this->commentExist($commentID))throw new Exception ('Commentaire inexistant');
		$status = $this->commentManager->updateComment($commentID, $content);
		echo (!!$status);
	}
} 
