<?php
require_once('Manager.php');

class PostManager extends Manager
{
    public function getPosts()
    {
        $req = $this->db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5');

        return $req;
    }

    public function getPost($postId)
    {
        $req = $this->db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
	}
	
	public function postExist($postId)
	{
		$req = $this->db->prepare("SELECT COUNT(*) FROM posts WHERE id = ?");
		$req->execute(array($postId));
		$count = $req->fetch();
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

        return $status;
    }

	public function deletepost($postId)
	{
		$req = $this->db->prepare('DELETE FROM posts WHERE id = ?');
		$status = $req->execute(array($postId));

		return $status;
	}

	public function updatePost($postId, $title, $content)
	{
		$req = $this->db->prepare('UPDATE posts SET title = ? ,content = ? WHERE id = ?');
		$status = $req->execute(
			array(
				$title,
				$content,
				$postId
		));
		
		return $status;
	}
}
