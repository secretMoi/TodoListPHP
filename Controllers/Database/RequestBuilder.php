<?php


namespace Controllers\Database;


class RequestBuilder
{
	private $request = "";

	public function Select(){
		$fields = func_get_args();
		$this->Add("SELECT (" . implode(', ', $fields) . ')');
		return $this;
	}

	public function Where(string $field, int $id){
		$this->Add("WHERE {$field} = {$id}");
	}

	public function WhereId(int $id){
		$this->Where("ID", $id);
	}

	public function From(string $table){
		$this->Add("FROM " . $table);
		return $this;
	}

	private function Add($request){
		$this->request = $this->request . $request . " ";
	}

	public function __toString() {
		return $this->request;
	}
}