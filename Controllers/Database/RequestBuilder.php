<?php


namespace Controllers\Database;


use Models\BaseModel;

class RequestBuilder
{
	private $request = "";

	public function Select(){
		$fields = func_get_args();
		//todo vérifier que les champs existent dans le model
		$this->Add("SELECT " . implode(', ', $fields));
		return $this;
	}

	public function Where(string $field, int $id){
		$this->Add("WHERE {$field} = {$id}");
	}

	public function WhereId(int $id){
		$this->Where("ID", $id);
	}

	public function From(string $table){
		$table = $this->CleanClassNameFromNamespace($table);
		$this->Add("FROM " . $table);
		return $this;
	}

	public function Insert(string $table, BaseModel $model){
		$table = $this->CleanClassNameFromNamespace($table);
		$data = $this->Model2Array($model);
		$fields = array_keys($data);
		var_dump($data);
		var_dump($table);

		$this->Add("INSERT INTO {$table}");
		$this->Add("(" . implode(', ', $fields) . ")");
		$this->Add("VALUES (:" . implode(', :', $data) . ")");

		var_dump($this->request);
	}

	private function Add($request){
		$this->request .= $request . " ";
	}

	private function Model2Array($model) : array{
		$data = get_object_vars($model); // récupère les données du modèle
		//$fields = array_keys($data); // récupère les champs du modèle

		$index = 0;
		foreach ($data as $key => $value)
		{
			if(is_null($value)){ // si aucune valeur n'est settée
				// supprime les entrées vides des tableaux
				//unset($fields[$index]);
				unset($data[$key]);
			}

			$index++;
		}

		return $data;
	}

	/**
	 * @param string $namespace Namespace avec la classe à nettoyer
	 * @return string Renvoie uniquement la classe sans le namespace
	 */
	private function CleanClassNameFromNamespace(string $namespace) : string{
		return substr(strrchr($namespace, '\\'), 1);
	}

	public function __toString() {
		return $this->request;
	}
}