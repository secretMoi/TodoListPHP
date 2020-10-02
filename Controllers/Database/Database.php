<?php

namespace Controllers\Database;

class Database
{
	private $host = "192.168.1.124";
	private $port = "1433";
	private $name = "todo";
	private $user = "sa";
	private $password = "Nax2J,/nwdbLQGj";

	//private $connection = "mysql:host=".$this->port.";dbname=".$this->name.";port=".$this->port,$this->user,$this->password;

	private $pdo;

	public function __construct()
	{
		//$this->pdo = new \PDO("mysql:host={$this->host};dbname={$this->name};port={$this->port}",$this->user,$this->password);
		$this->pdo = new \PDO("sqlsrv:server={$this->host}:{$this->port};Database={$this->name}",$this->user,$this->password);
	}
}