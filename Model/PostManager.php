<?php
require_once('Manager.php');

class PostManager extends Manager
{
    public function getPosts()
    {
        $req = $this->db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5');

        return $req;
    }

    public function getPost($postId)
    {
        $req = $this->db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
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
}