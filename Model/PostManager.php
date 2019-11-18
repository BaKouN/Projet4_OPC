<?php
require_once('Manager.php');

class PostManager extends Manager
{
    public function getPosts()
    {
        $req = $this->db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin\') AS creation_date_fr FROM posts ORDER BY creation_date DESC');
		$posts = $req->fetchAll();
		$req->closeCursor();
        return $posts;
    }

    public function getPost($postID)
    {
        $req = $this->db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postID));
		$post = $req->fetch();
		$req->closeCursor();
		
        return $post;
	}
	
	public function postExist($postID)
	{
		$req = $this->db->prepare("SELECT COUNT(*) FROM posts WHERE id = ?");
		$req->execute(array($postID));
		$count = $req->fetch();
		$req->closeCursor();
		
		return !!$count[0];
	}

	public function createPost($title, $content)
    {
        $post = $this->db->prepare('INSERT INTO posts(title, content , creation_date) VALUES(?, ?, NOW())');
        $status = $post->execute(
			array(
				$title,
				$content
			));
		$post->closeCursor();
		
        return $status;
    }

	public function deletepost($postID)
	{
		$req = $this->db->prepare('DELETE FROM posts WHERE id = ?');
		$status = $req->execute(array($postID));
		$req->closeCursor();
		
		return $status;
	}

	public function updatePost($postID, $title, $content)
	{
		$req = $this->db->prepare('UPDATE posts SET title = ? ,content = ? WHERE id = ?');
		$status = $req->execute(
			array(
				$title,
				$content,
				$postID
		));
		$req->closeCursor();
		
		return $status;
	}
}
