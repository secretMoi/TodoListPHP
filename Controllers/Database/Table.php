<?php


namespace Controllers\Database;


use Controllers\HandleModel;

class Table
{
	private $_database;
	private $_table;

	public function __construct(\PDO $database, string $table)
	{
		$this->_database = $database;
		$this->_table = $table;
	}

	public function Select(int $id){
		$req = "SELECT * FROM {$this->_table} WHERE ID={$id}";
		$result = $this->_database->query($req);

		$model = HandleModel::LoadModel($this->_table);
	}
}