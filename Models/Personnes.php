<?php
namespace Models;

class Personnes extends BaseModel
{
    public $ID;
    public $Nom;
    public $Prenom;
    public $AdresseMail;
    public $MotDePasse;
    public $Role;

	public function __construct5($Nom, $Prenom, $AdresseMail, $MotDePasse, $Role){
		$this->Nom = $Nom;
		$this->Prenom = $Prenom;
		$this->AdresseMail = $AdresseMail;
		$this->MotDePasse = $MotDePasse;
		$this->Role = $Role;
	}
}