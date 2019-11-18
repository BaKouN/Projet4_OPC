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

	public function getComment($commentID)
	{
		if (!$this->commentExist($commentID)) throw new Exception('Ce commentaire n\'existe pas');
		$comment = $this->commentManager->getComment($commentID);
		return $comment;
	}

	public function printCommentsJSON($postId)
	{
		echo(json_encode($this->getComments($postId)));
	}

	public function getComments($postId)
	{
		if (!$this->postController->postExist($postId)) throw new Exception ('Post inexistant');
		return $this->commentManager->getComments($postId);
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

	public function deleteRelatedComments($postID)
	{
		$this->commentManager->deleteRelatedComments($postID);
	}

	public function updateComment($commentID)
	{
		if (!$this->commentExist($commentID))throw new Exception ('Commentaire inexistant');
		$content = '(Commentaire modéré par l\'administrateur.)';
		$status = $this->commentManager->updateComment($commentID, $content);
		echo (!!$status);
	}

	public function reportComment($commentID)
	{
		if (!$this->commentExist($commentID))throw new Exception ('Commentaire inexistant');
		$comment = $this->getComment($commentID);
		if ($comment['reported'] != 0) throw new Exception ('Commentaire non signalable.');
		$this->commentManager->reportComment($commentID);
	}
} 
