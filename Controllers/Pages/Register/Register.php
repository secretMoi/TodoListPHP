<?php

namespace Controllers\Pages\Register;

use Controllers\Authentification\Security;
use Controllers\Database\RequestBuilder;
use Controllers\Database\RequestExecuter;
use Controllers\FormValidator;
use Controllers\Pages\BaseController;
use Models\Personnes;
use Models\Role;

class Register extends BaseController
{
    public function Register()
    {
        $this->RenderSimple("Register\\register");
    }

    public function Add(){
    	// vérification des champs
		if(!FormValidator::IsSet($_POST, array("Nom", "Prenom", "AdresseMail", "MotDePasse", "conf_MotDePasse")))
			return;

	    // concordance des mdp
		if($_POST["MotDePasse"] != $_POST["conf_MotDePasse"])
			return;

	    // convertit les var post en model
		$personne = new Personnes();
	    $personne->Array2Model($_POST);

	    // hash le mdp
	    $security = new Security();
	    $personne->MotDePasse = $security->Hash($personne->MotDePasse);

	    // récupère le rôle
	    $roleRequest = new RequestBuilder();
	    $roleRequest->Select("*")
		    ->From(Role::class)
		    ->Where("Nom", "Client");
	    $roleTable = new RequestExecuter(Role::class);
	    $roleResult = $roleTable->Execute($roleRequest);

	    $personne->Role = $roleResult[0]->ID;

	    // ajout le model dans la bd
	    $personneTable = new RequestExecuter(Personnes::class);
		$result = $personneTable->Insert($personne);

		if($result)
        {
            $host = $_SERVER['HTTP_HOST'];
            header("Location: http://$host/Todo");
        }
    }
}