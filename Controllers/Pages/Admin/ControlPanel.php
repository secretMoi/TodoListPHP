<?php

namespace Controllers\Pages\Admin;

use Controllers\Application;
use Controllers\Database\RequestBuilder;
use Controllers\Database\RequestExecuter;
use Controllers\FormValidator;
use Controllers\Pages\BaseController;
use Controllers\Parts\Alert;
use Models\Personnes;
use Models\Status;
use Models\Todo;

class ControlPanel Extends BaseController
{
    public function ControlPanel()
    {
        $this->Render("Admin\ControlPanel");
    }

    public function LstPersonnes()
    {
        // récupère toutes les personnes
        $personnesRequest = new RequestBuilder();
        $personnesRequest->Select("*")
            ->From(Personnes::class);
        $personneTable = new RequestExecuter(Personnes::class);
        $Personnes = $personneTable->Execute($personnesRequest);

        $this->Render("Admin\LstPersonnes", $Personnes);
    }

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

    public function AjouterTache()
    {
        $this->Render("Admin\AjouterTache");
    }

    public function AjoutTache()
    {
        // vérification des champs
        if (!FormValidator::IsSet($_POST, array("Titre", "Contenu", "Status")))
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

        // récupère le status
        $roleRequest = new RequestBuilder();
        $roleRequest->Select("*")
            ->From(Status::class)
            ->Where("Nom", $todo->Status);
        $roleTable = new RequestExecuter(Status::class);
        $roleResult = $roleTable->Execute($roleRequest);

        $todo->Status = $roleResult[0]->ID;

        //ajout le model dans la bd
        $todoTable = new RequestExecuter(Todo::class);
        $result = $todoTable->Insert($todo);

	    if ($result)
		    Application::SetAlert(new Alert(Alert::$Success, "La tâche {$todo->Titre} a été ajoutée avec succès"));
	    else
		    Application::SetAlert(new Alert(Alert::$Error, "La tâche {$todo->Titre} n'a pas pu être ajoutée"));

        header("Location: " . Application::Instance()->Link($_GET['Controller'], $_GET['Action']));
    }
}