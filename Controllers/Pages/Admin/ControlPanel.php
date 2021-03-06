<?php

namespace Controllers\Pages\Admin;

use Controllers\Application;
use Controllers\Database\RequestBuilder;
use Controllers\Database\RequestExecuter;
use Controllers\FormValidator;
use Controllers\Pages\BaseController;
use Controllers\Parts\Alert;
use Models\Gerer;
use Models\Personnes;
use Models\Status;
use Models\Todo;

class ControlPanel Extends BaseController
{
	/**
	 * Affiche la page d'accueil du panneau d'administration
	 */
	public function ControlPanel()
    {
        $this->Render("Admin\ControlPanel");
    }

	/**
	 * Affiche la liste des personnes
	 */
	public function LstPersonnes()
    {
        // récupère toutes les personnes
        $personnesRequest = new RequestBuilder();
        $personnesRequest->Select("*")
            ->From(Personnes::class);
        $personneTable = new RequestExecuter(Personnes::class);
        $Personnes = $personneTable->Execute($personnesRequest);

        foreach ($Personnes as $personne){
        	switch ($personne->Role){
		        case 1:
			        $personne->Role = "Staff";
			        break;
		        case 2:
			        $personne->Role = "Client";
			        break;
		        case 3:
			        $personne->Role = "Travailleur";
			        break;
	        }
        }

        $this->Render("Admin\LstPersonnes", $Personnes);
    }

	/**
	 * Affiche la liste des clients
	 */
	public function LstClients()
    {
        // récupère toutes les personnes
        $personnesRequest = new RequestBuilder();
        $personnesRequest->Select("*")
            ->From(Personnes::class)
            ->Where("Role", "2");
        $personneTable = new RequestExecuter(Personnes::class);
        $Personnes = $personneTable->Execute($personnesRequest);

        $this->Render("Admin\LstClients", $Personnes);
    }

	/**
	 * Affiche la liste des travailleurs
	 */
	public function LstTravailleurs()
    {
        // récupère toutes les personnes
        $personnesRequest = new RequestBuilder();
        $personnesRequest->Select("*")
            ->From(Personnes::class)
            ->Where("Role", "3");
        $personneTable = new RequestExecuter(Personnes::class);
        $Personnes = $personneTable->Execute($personnesRequest);

        $this->Render("Admin\LstTravailleurs", $Personnes);
    }

	/**
	 * Affiche la liste des tâches
	 */
	public function LstTaches()
    {
        // récupère toutes les personnes
        $tachesRequest = new RequestBuilder();
        $tachesRequest->Select("*")
            ->From(Todo::class);
        $todoTable = new RequestExecuter(Todo::class);
        $Taches = $todoTable->Execute($tachesRequest);

        $this->Render("Admin\LstTaches", $Taches);
    }

	/**
	 * Affiche le formulaire d'encodage d'une nouvelle tâche
	 */
	public function AjouterTache()
    {
    	$status = (new RequestExecuter(Status::class))->SelectAll();
	    // création des status pour la liste
	    $statusList = array();
	    foreach ($status as $key => $value){
		    $statusList[$value->ID] = "{$value->Nom}";
	    }

    	// récupère les clients
	    $clients = $this->GetUsersByRole(2);

	    // création des clients pour la liste
	    $clientsList = array();
	    foreach ($clients as $key => $value){
		    $clientsList[$value->ID] = "{$value->Nom} {$value->Prenom}";
	    }

		// récupère les travailleurs
	    $travailleurs = $this->GetUsersByRole(3);

	    // création des clients pour la liste
	    $travailleursList = array();
	    foreach ((array) $travailleurs as $key => $value){
		    $travailleursList[$value->ID] = "{$value->Nom} {$value->Prenom}";
	    }

        $this->Render("Admin\AjouterTache", compact('clientsList', 'travailleursList', 'statusList'));
    }

    private function GetUsersByRole(int $role) : array{
	    $req = new RequestBuilder();

	    $req->Reset()
		    ->Select('*')
		    ->From(Personnes::class)
		    ->Where("Role", $role);

	    return (new RequestExecuter(Personnes::class))->Execute($req);
    }

	/**
	 * Traite les données pour ajouter une nouvelle tâche
	 */
	public function AjoutTache()
    {
        // vérification des champs
        if (!FormValidator::IsSet($_POST, array("Titre", "Contenu", "Status", "Client", "Travailleur")))
            return;
	    if (!FormValidator::IsSet($_GET, array("Controller", "Action")))
		    return;

        // convertit les var post en model
        $todo = new Todo();
        $todo->Array2Model($_POST);

        // date de création est aujourd'hui
        $todo->DateCreation = date("Y-m-d H:i:s");
        // date de modification est aujourd'hui
        $todo->DateModif = date("Y-m-d H:i:s");

        //ajout le model dans la bd
        $todoTable = new RequestExecuter(Todo::class);
        $result = $todoTable->Insert($todo);

	    $gererModel = new Gerer($_POST['Travailleur'], $todoTable->LastInsert());
	    $result &= (new RequestExecuter(Gerer::class))->Insert($gererModel);

	    if ($result)
		    Application::SetAlert(new Alert(Alert::$Success, "La tâche {$todo->Titre} a été ajoutée avec succès"));
	    else
		    Application::SetAlert(new Alert(Alert::$Error, "La tâche {$todo->Titre} n'a pas pu être ajoutée"));

        header("Location: " . Application::Instance()->Link($_GET['Controller'], $_GET['Action']));
    }
}