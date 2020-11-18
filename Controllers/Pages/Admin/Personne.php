<?php


namespace Controllers\Pages\Admin;

use Controllers\Application;
use Controllers\Database\RequestBuilder;
use Controllers\Database\RequestExecuter;
use Controllers\FormValidator;
use Controllers\Pages\BaseController;
use Controllers\Parts\Alert;
use Models\BaseModel;
use Models\Gerer;
use Models\Personnes;
use Models\Role;
use Models\Todo;

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
    }

	/**
	 * Update une personne
	 */
    function Update()
    {
        // vérification des champs
        if (!FormValidator::IsSet($_POST, array("ID", "Nom", "Prenom", "AdresseMail", "Role")))
            return;
	    if (!FormValidator::IsSet($_GET, array("Controller", "Action")))
		    return;

        // supprimer le dernier élément de $_POST
        array_pop($_POST);

	    $personneInBdd = (new RequestExecuter(Personnes::class))->Select($_POST['ID']);
	    $password = BaseModel::Cast($personneInBdd, Personnes::class)->MotDePasse;

        $PersonneMAJ = new Personnes($_POST['Nom'], $_POST['Prenom'], $_POST['AdresseMail'], $password, $_POST['Role']);
        $PersonneMAJ->ID = $_POST['ID'];

        // met à jour le client
        $personneRequest = new RequestBuilder();
        $personneRequest->Update(Personnes::class, $PersonneMAJ)
                      ->Where("ID", $_POST['ID']);
        $personneTable = new RequestExecuter(Personnes::class);

        $result = $personneTable->ExecuteUpdate($personneRequest, $PersonneMAJ);

        if ($result)
	        Application::SetAlert(new Alert(Alert::$Success, "La personne {$PersonneMAJ->Nom} a été modifiée avec succès"));
		else
			Application::SetAlert(new Alert(Alert::$Error, "La personne {$PersonneMAJ->Nom} n'a pas pu être modifiée"));

	    header("Location: " . Application::Instance()->Link($_GET['Controller'], $_GET['Action']));
    }

	/**
	 * Supprime une personne et la délie de ses tâches
	 */
    public function Delete(){
	    // vérification des champs
	    if (!FormValidator::IsSet($_GET, array("ID", "Controller", "Action")))
		    return;

	    $idToDelete = $_GET['ID'];

		// Suppression des tâches
	    $req = new RequestExecuter(Gerer::class);
	    $result = $req->Delete("IDPers", $idToDelete);

		$req = new RequestExecuter(Personnes::class);
		$result &= $req->DeleteId($idToDelete);

	    if ($result){
		    Application::SetAlert(new Alert(Alert::$Success, "La personne a été supprimée avec succès"));
		    header("Location: " . Application::Instance()->Link($_GET['Controller'], $_GET['Action']));
	    }
		else{
			Application::SetAlert(new Alert(Alert::$Error, "La personne n'a pas pu être supprimée"));
			header("Location: " . Application::Instance()->Link($_GET['Controller'], $_GET['Action']));
		}
    }
}