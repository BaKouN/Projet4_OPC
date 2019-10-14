<?php

class Manager
{
	function __construct()
	{
		$this->db = $this->dbConnect();
	}
    protected function dbConnect()
    {
        $db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
        return $db;
    }
}