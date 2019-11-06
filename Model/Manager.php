<?php

class Manager
{
	function __construct()
	{
			$this->db = $this->dbConnect();
	}
	
    protected function dbConnect()
    {
		$GLOBALS['dbConnected']=true;
        $db = new PDO('mysql:host=localhost;dbname=localhost;charset=utf8', 'root', '');
        return $db;
	}

	public function dbDisconnect()
	{
		$db = null;
	}
}
