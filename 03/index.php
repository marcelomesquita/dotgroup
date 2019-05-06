<?php

class MyUserClass
{
	private $dbhost = "localhost";
	private $dbuser = "user";
	private $dbpass = "password";

	public function getConnection()
	{
		return new DatabaseConnection($this->dbhost, $this->dbuser, $this->dbpass);
	}

	public function getUserList()
	{
		$results = $this->getConnection->query('select name from user');

		sort($results);

		return $results;
	}
}
