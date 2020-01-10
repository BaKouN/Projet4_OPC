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
        $db = $GLOBALS['workEnvironnement'] === ('dev') ? new PDO('mysql:host=localhost;dbname=localhost;charset=utf8', 'root', '') : new PDO('mysql:host=localhost;dbname=OpenClassrooms_Haroun_P4_PROD_2019;charset=utf8', 'HAROUNP4_ADMIN', '-BddHaroun2019!-');
        return $db;
	}

	public function dbDisconnect()
	{
		$db = null;
	}
}
