<?php

namespace Controllers\Database;

use Controllers\Application;
use Controllers\HandleModel;
use Models\BaseModel;
use PDO;
use PDOException;

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
		try {
			$result = $this->_database->query($req); // exécute la req
			$result = $result->fetchAll(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) {
			return null;
		}

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

	public function ExecuteUpdate(string $req, BaseModel $model){

		try {
			$result = $this->_database->prepare($req);

			return $result->execute($this->Model2Array($model));
		}
		catch (PDOException $e) {
			return null;
		}
	}

	/**
	 * Permet d'exécuter une requête SQL SELECT sur un ID particulier
	 * @param int $id id de l'enregistrement à récupérer
	 * @return BaseModel Retourne un model
	 */
	public function Select(int $id) : ?BaseModel{
		$req = "SELECT * FROM {$this->_table} WHERE ID={$id}"; // req sql

		try {
			$result = $this->_database->query($req); // exécute la req
			$result = $result->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) {
			return null;
		}

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

		try {
			$result = $this->_database->query($req);
			$result = $result->fetchAll(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) {
			return array();
		}

		$models = array();

		foreach ($result as $record){
			$model = HandleModel::LoadModel($this->_table);
			$model->Hydrate($record);

			array_push($models, $model);
		}

		return $models;
	}

	/**
	 * Permet d'exécuter une requête SQL DELETE sur un ID particulier
	 * @param int $id id de l'enregistrement à supprimer
	 * @return object Le résultat de la requete
	 */
	public function DeleteId(int $id){
		return $this->Delete("ID", $id);
	}

	/**
	 * Permet d'exécuter une requête SQL DELETE sur un ID particulier
	 * @param string $field Nom ud champ sur lequel supprimer
	 * @param int $value Valeur de l'enregistrement à supprimer
	 * @return object Le résultat de la requete
	 */
	public function Delete(string $field, int $value){
		$sql = "DELETE FROM {$this->_table} WHERE {$field}={$value}"; // req sql

		try {
			$req = $this->_database->prepare($sql);

			return $req->execute(array($value));
		}
		catch (PDOException $e) {
			return null;
		}
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

		try {
			$result = $this->_database->prepare($req);

			return $result->execute($data);
		}
		catch (PDOException $e) {
			return false;
		}
	}

	/**
	 * Permet de mettre à jour les données selon l'ID
	 * @param BaseModel $model
	 * @return bool
	 */
	public function Update(BaseModel $model) : bool
	{
		$data = $this->Model2Array($model);

		$fields = array_keys($data);

		$req = "UPDATE {$this->_table} ";
		$req .= "SET ";

		foreach ($fields as $field)
			$req .= $field . " = :" . $field . ', ';

		$req = substr($req, 0, -2) . ' ';

		$req .= "WHERE {$fields[0]} = {$data[$fields[0]]}";

		try {
			$result = $this->_database->prepare($req);

			return $result->execute($data);
		}
		catch (PDOException $e) {
			return false;
		}
	}

	/**
	 * @return int L'id du dernier élément ajouté dans la bdd
	 */
	public function LastInsert() : int{
		try {
			return $this->_database->lastInsertId();
		}
		catch (PDOException $e) {
			return -1;
		}
	}

	/**
	 * Convertit un model en tableau associatif
	 * @param object $model Model à convertir
	 * @return array Tableau associatif créé
	 */
	private function Model2Array(object $model) : array{
		$data = get_object_vars($model); // récupère les données du modèle

		$index = 0;
		foreach ($data as $key => $value)
		{
			if(is_null($value)) // si aucune valeur n'est settée
				unset($data[$key]); // supprime les entrées vides des tableaux

			$index++;
		}

		return $data;
	}
}