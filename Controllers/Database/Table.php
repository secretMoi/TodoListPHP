<?php


namespace Controllers\Database;


use Controllers\Application;
use Controllers\HandleModel;
use Models\BaseModel;
use PDO;

class Table
{
	private $_database;
	private $_table;

	/**
	 * Permet d'avoir plusieurs constructeurs
	 */
	public function __construct()
	{
		$arguments = func_get_args();
		$numberOfArguments = func_num_args();

		if (method_exists($this, $function = '__construct'.$numberOfArguments)) {
			call_user_func_array(array($this, $function), $arguments);
		}
	}

	/**
	 * Utilise la connexion $database pour travailler sur la table $table
	 * @param PDO $database Connexion à la bdd à utiliser
	 * @param string $table Nom de la table à utiliser
	 */
	public function __construct2(PDO $database, string $table)
	{
		$this->_database = $database;
		$this->_table = $table;
	}

	/**
	 * Utilise la connexion settée dans la classe application
	 * @param string $table Nom de la table à utiliser
	 */
	public function __construct1(string $table)
	{
		$this->__construct(Application::Instance()->Connection(), $table);
	}

	/**
	 * Permet d'exécuter une requête SQL SELECT sur un ID particulier
	 * @param int $id id de l'enregistrement à récupérer
	 * @return BaseModel Retourne un model
	 */
	public function Select(int $id) : ?BaseModel{
		$req = "SELECT * FROM {$this->_table} WHERE ID={$id}";
		$result = $this->_database->query($req);
		$result = $result->fetch(PDO::FETCH_ASSOC);

		if(!$result)
			return null;

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