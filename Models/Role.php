<?php
namespace Models;

class Role extends BaseModel
{
    public $ID;
    public $Nom;

	public function __construct2($ID, $Nom){
		$this->ID = $ID;
		$this->__construct1($Nom);
	}

	public function __construct1($Nom){
		$this->Nom = $Nom;
	}
}