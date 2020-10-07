<?php

namespace Controllers\Database;

use Controllers\Application;
use Controllers\HandleModel;
use Models\BaseModel;
use PDO;

class RequestExecuter
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
		$this->_table = $this->CleanClassNameFromNamespace($table);
	}

	/**
	 * Utilise la connexion settée dans la classe application
	 * @param string $table Nom de la table à utiliser
	 */
	public function __construct1(string $table)
	{
		$this->__construct2(Application::Instance()->Connection(), $table);
	}

	/**
	 * @param string $namespace Namespace avec la classe à nettoyer
	 * @return string Renvoie uniquement la classe sans le namespace
	 */
	private function CleanClassNameFromNamespace(string $namespace) : string{
		return substr(strrchr($namespace, '\\'), 1);
	}

	public function Execute(string $req){

		if (strpos($req, 'SELECT') === 0)
			return $this->ExecuteSelect($req);

		return null;
	}

	public function ExecuteSelect(string $req){
		$result = $this->_database->query($req); // exécute la req
		$result = $result->fetchAll(PDO::FETCH_ASSOC);

		if(!$result)
			return null;

		$models = array();

		foreach ($result as $record){
			$model = HandleModel::LoadModel($this->_table);
			$model->Hydrate($record);

			array_push($models, $model);
		}

		return $models;
	}

	/**
	 * Permet d'exécuter une requête SQL SELECT sur un ID particulier
	 * @param int $id id de l'enregistrement à récupérer
	 * @return BaseModel Retourne un model
	 */
	public function Select(int $id) : ?BaseModel{
		$req = "SELECT * FROM {$this->_table} WHERE ID={$id}"; // req sql
		$result = $this->_database->query($req); // exécute la req
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

	/**
	 * Permet d'insérer des données dans la bdd
	 * @param BaseModel $model Modèle de données à insérer dans la bdd
	 * @return bool true si l'insertion s'est bien passée, false sinon
	 */
	public function Insert(BaseModel $model) : bool{
		$data = get_object_vars($model); // récupère les données du modèle
		$fields = array_keys($data); // récupère les champs du modèle

		$index = 0;
		foreach ($data as $key => $value)
		{
			if(is_null($value)){ // si aucune valeur n'est settée
				// supprime les entrées vides des tableaux
				unset($fields[$index]);
				unset($data[$key]);
			}

			$index++;
		}

		// prépare la req sql
		$req = "INSERT INTO {$this->_table} (" . implode(', ', $fields) . ") ";
		$req = $req . "VALUES (:" . implode(', :', $fields) . ")";

		$result = $this->_database->prepare($req);

		return $result->execute($data);
	}

	/**
     * Permet de mettre à jour les données selon l'ID
     * A vérifier /!\
     */
	/*public function Update(BaseModel $model, $id, $array) : bool
    {
        $data = get_object_vars($model);
        $fields = array_keys($data);

        $req = "UPDATE {$this->_table} SET ";
        foreach ($array as $val)
        {
            $req= $req."{$fields}={$val}";
        }
        $req = $req."WHERE id={$id}";

        $result = $this->_database->prepare($req);

        return $result->execute();
    }*/
}