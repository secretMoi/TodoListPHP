<?php

namespace Controllers\Database;

use PDO;
use PDOException;

class Database
{
	private $host = "localhost";
	private $port = "3306";
	private $name = "todo";
	private $user = "root";
	private $password = "";

	private $pdo;

	public function __construct()
	{
		try{
			$this->pdo = new PDO("mysql:host={$this->host};dbname={$this->name};port={$this->port}",$this->user,$this->password);
		}
		catch (PDOException $e) {

		}
	}

	public function GetConnection(): PDO{
		return $this->pdo;
	}
}