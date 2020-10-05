<?php

namespace Controllers\Database;

use PDO;

class Database
{
	private $host = "localhost";
	private $port = "3306";
	private $name = "todo";
	private $user = "root";
	private $password = "Cedrus@2604";

	private $pdo;

	public function __construct()
	{
		$this->pdo = new PDO("mysql:host={$this->host};dbname={$this->name};port={$this->port}",$this->user,$this->password);
	}

	public function GetConnection(): PDO{
		return $this->pdo;
	}
}