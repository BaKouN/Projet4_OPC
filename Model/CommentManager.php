<?php
require_once('Manager.php');

class CommentManager extends Manager
{
	public function getComment($commentID)
    {
        $req = $this->db->prepare('SELECT id, author, comment, reported FROM comments WHERE id = ?');
        $req->execute(array($commentID));
		$comment = $req->fetch();
		$req->closeCursor();
		
        return $comment;
	}


    public function getComments($postID)
    {
        $req = $this->db->prepare('SELECT id, author, comment, reported, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date');
		$req->execute(array($postID));
		$comments = $req->fetchAll();
		$req->closeCursor();
        return $comments;
    }

    public function createComment($postID, $author, $comment)
    {
        $req = $this->db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
		$status = $req->execute(array($postID, $author, $comment));
		$req->closeCursor();
        return $status;
    }

	public function commentExist($commentID)
	{
		$req = $this->db->prepare("SELECT COUNT(*) FROM comments WHERE id = ?");
		$req->execute(array($commentID));
		$count = $req->fetch();
		$req->closeCursor();
		
		return !!$count[0];
	}

	public function deleteComment($commentID)
	{
		$req = $this->db->prepare('DELETE FROM comments WHERE id = ?');
		$status = $req->execute(array($commentID));
		$req->closeCursor();
		
		return $status;
	}

	public function deleteRelatedComments($postID)
	{
		$req = $this->db->prepare('DELETE * FROM comments WHERE post_id = ?');
		$status = $req->execute(array($postID));
		$req->closeCursor();
	}

	public function reportComment($commentID)
	{
		$req = $this->db->prepare('UPDATE comments SET reported = 1 WHERE id = ?');
		$status = $req->execute(
			array(
				$commentID
		));
		$req->closeCursor();

		return $status;
	}

	public function updateComment($commentID, $content)
	{
		$req = $this->db->prepare('UPDATE comments SET comment = ?, reported = -1 WHERE id = ?');
		$status = $req->execute(
			array(
				$content,
				$commentID
		));
		$req->closeCursor();
		
		return $status;
	}

	public function getReportedComments()
    {
		$req = $this->db->query('SELECT id, post_id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin\') AS comment_date_fr  FROM comments where reported = 1 ORDER BY comment_date DESC');
		$reportedComments = $req->fetchAll();
		$req->closeCursor();
        return $reportedComments;
    }
}
