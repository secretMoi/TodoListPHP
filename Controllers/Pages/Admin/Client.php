<?php


namespace Controllers\Pages\Admin;

use Controllers\Database\RequestBuilder;
use Controllers\Database\RequestExecuter;
use Controllers\FormValidator;
use Controllers\Pages\BaseController;
use Models\Personnes;

class Client extends BaseController
{
    function UpdateClient()
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

		    $this->Render("Admin\Clients\updateClient", compact("Personne"));
	    }

        // todo render erreur
    }
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
        $clientRequest->Update(Personnes::class,$ClientMAJ)
                      ->Where("ID", $_POST['ID']);
        $clientTable = new RequestExecuter(Personnes::class);
        var_dump($clientRequest);
        $result = $clientTable->ExecuteUpdate($clientRequest, $ClientMAJ);

        if ($result) {
            header("Location: index.php?page=ControlPanel/ControlPanel");
        }
    }
}