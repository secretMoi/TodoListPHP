<?php
namespace Models;

class Todo extends BaseModel
{
    public $ID;
    public $Titre;
    public $Contenu;
    public $DateCreation;
    public $DateModif;
    public $Status;

    public function __construct6($ID, $Titre, $Contenu, $DateCreation, $DateModif, $Status){
    	$this->ID = $ID;
    	$this->__construct5($Titre, $Contenu, $DateCreation, $DateModif, $Status);
    }

	public function __construct5($Titre, $Contenu, $DateCreation, $DateModif, $Status){
		$this->Titre = $Titre;
		$this->Contenu = $Contenu;
		$this->DateCreation = $DateCreation;
		$this->DateModif = $DateModif;
		$this->Status = $Status;
	}
}