<?php
require_once('Manager.php');

class CommentManager extends Manager
{
    public function getComments($postId)
    {
        $req = $this->db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date');
		$req->execute(array($postId));
		$comments = $req->fetchAll();
		$req->closeCursor();
        return $comments;
    }

    public function createComment($postId, $author, $comment)
    {
        $req = $this->db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
		$status = $req->execute(array($postId, $author, $comment));
		$req->closeCursor();
        return $status;
    }

	public function commentExist($commentId)
	{
		$req = $this->db->prepare("SELECT COUNT(*) FROM comments WHERE id = ?");
		$req->execute(array($commentId));
		$count = $req->fetch();
		$req->closeCursor();
		
		return !!$count[0];
	}

	public function deleteComment($commentId)
	{
		$req = $this->db->prepare('DELETE FROM comments WHERE id = ?');
		$status = $req->execute(array($commentId));
		$req->closeCursor();
		
		return $status;
	}

	public function deleteRelatedComments($postID)
	{
		$req = $this->db->prepare('DELETE * FROM comments WHERE post_id = ?');
		$status = $req->execute(array($postID));
		$req->closeCursor();
	}

	public function updateComment($commentId, $content)
	{
		$req = $this->db->prepare('UPDATE comments SET comment = ? WHERE id = ?');
		$status = $req->execute(
			array(
				$content,
				$commentId
		));
		$req->closeCursor();
		
		return $status;
	}
}
