<?php
namespace Models;

class Gerer extends BaseModel
{
    public $ID;
    public $IDPers;
    public $IDTodo;

	public function __construct3($ID, $IDPers, $IDTodo){
		$this->ID = $ID;
		$this->__construct2($IDPers, $IDTodo);
	}

	public function __construct2($IDPers, $IDTodo){
		$this->IDPers = $IDPers;
		$this->IDTodo = $IDTodo;
	}
}