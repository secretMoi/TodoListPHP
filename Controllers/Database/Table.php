<?php


namespace Controllers\Database;


use Controllers\HandleModel;
use Models\BaseModel;
use PDO;

class Table
{
	private $_database;
	private $_table;

	public function __construct(PDO $database, string $table)
	{
		$this->_database = $database;
		$this->_table = $table;
	}

	public function Select(int $id) : BaseModel{
		$req = "SELECT * FROM {$this->_table} WHERE ID={$id}";
		$result = $this->_database->query($req);
		$result = $result->fetch(PDO::FETCH_ASSOC);

		$model = HandleModel::LoadModel($this->_table);
		$model->Hydrate($result);

		return $model;
	}
}