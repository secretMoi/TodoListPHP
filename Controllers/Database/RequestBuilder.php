<?php


namespace Controllers\Database;


class RequestBuilder
{
	private $request = "";

	/*public function Select(string $fields){
		$this->Add("SELECT " . $fields);
		return $this;
	}*/

	public function Select(array $fields){
		$this->Add("SELECT (" . implode(', ', $fields) . ')');
		return $this;
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