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

	/**
	 * Permet d'exécuter une requête SQL SELECT sur un ID particulier
	 * @param int $id id de l'enregistrement à récupérer
	 * @return BaseModel Retourne un model
	 */
	public function Select(int $id) : BaseModel{
		$req = "SELECT * FROM {$this->_table} WHERE ID={$id}";
		$result = $this->_database->query($req);
		$result = $result->fetch(PDO::FETCH_ASSOC);

		$model = HandleModel::LoadModel($this->_table);
		$model->Hydrate($result);

		return $model;
	}

	/**
	 * Permet d'exécuter une requête SQL SELECT *
	 * @return array Retourne un tableau des enregistrements trouvés
	 */
	public function SelectAll() : array{
		$req = "SELECT * FROM {$this->_table}";
		$result = $this->_database->query($req);
		$result = $result->fetchAll(PDO::FETCH_ASSOC);

		$models = array();

		foreach ($result as $record){
			$model = HandleModel::LoadModel($this->_table);
			$model->Hydrate($record);

			array_push($models, $model);
		}

		return $models;
	}
}