<?php


namespace Controllers\Pages\Admin;

use Controllers\Database\RequestBuilder;
use Controllers\Database\RequestExecuter;
use Controllers\FormValidator;
use Controllers\Pages\BaseController;
use Models\Personnes;
use Models\Role;

class Personne extends BaseController
{
    function UpdateView()
    {
    	$idPersonne = $_GET['ID'];

	    if (!empty($idPersonne))
	    {
		    // récupère le client
		    $personneRequest = new RequestBuilder();
		    $personneRequest->Select("*")
			    ->From(Personnes::class)
			    ->Where("ID", $idPersonne);
		    $personneTable = new RequestExecuter(Personnes::class);
		    $Personne = $personneTable->Execute($personneRequest);
		    $Personne = $Personne[0];

		    $role = new RequestExecuter(Role::class);
		    $roles = $role->SelectAll();

		    // création du role courant
		    $RoleCourant = null;
		    foreach ($roles as $key => $value){
			    if($value->ID == $Personne->Role)
				    $RoleCourant = $value;
		    }

		    // création des rôles pour la liste
		    $RolesList = array();
		    foreach ($roles as $key => $value){
		    	$RolesList[$value->ID] = $value->Nom;
		    }

		    $this->Render("Admin\Clients\updateClient", compact("Personne", "RolesList", "RoleCourant"));
	    }

        // todo render erreur
    }

    //todo corriger
    function Update()
    {
        // vérification des champs
        if (!FormValidator::IsSet($_POST, array("ID", "Nom", "Prenom", "AdresseMail", "MotDePasse", "Role")))
            return;

        // supprimer le dernier élément de $_POST
        array_pop($_POST);

        $ClientMAJ = new Personnes($_POST['Nom'], $_POST['Prenom'], $_POST['AdresseMail'], $_POST['MotDePasse'], $_POST['Role']);
        $ClientMAJ->ID = $_POST['ID'];

        // met à jour le client
        $clientRequest = new RequestBuilder();
        $clientRequest->Update(Personnes::class, $ClientMAJ)
                      ->Where("ID", $_POST['ID']);
        $clientTable = new RequestExecuter(Personnes::class);
	    var_dump($clientRequest);
        $result = $clientTable->ExecuteUpdate($clientRequest, $ClientMAJ);

        if ($result)
            header("Location: index.php?page=ControlPanel/ControlPanel");
    }

    //todo actions supprimer
}