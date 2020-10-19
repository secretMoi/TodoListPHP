<?php


namespace Controllers\Pages\Admin;

use Controllers\Database\RequestBuilder;
use Controllers\Database\RequestExecuter;
use Controllers\FormValidator;
use Controllers\Pages\BaseController;
use Models\Personnes;
use Models\Status;
use Models\Todo;

class Client extends BaseController
{
    function updateClient()
    {
        $this->Render("Admin\Clients\updateClient");
    }
    function Update()
    {
        // vérification des champs
        if (!FormValidator::IsSet($_POST, array("ID", "Nom", "Prenom", "AdresseMail","MotDePasse","Role")))
            return;

        // Pas besoin de convertir $_POST le fait dans update

        //var_dump($_POST);
        // supprimer le dernier élément de $_POST
        array_pop($_POST);

        $ClientMAJ = new Personnes($_POST['Nom'],$_POST['Prenom'],$_POST['AdresseMail'],$_POST['MotDePasse'],$_POST['Role']);
        $ClientMAJ->ID = $_POST['ID'];

        // met à jour le client
        $clientRequest = new RequestBuilder();
        $clientRequest->Update(Personnes::class,$ClientMAJ)
                      ->Where("ID", $_POST['ID']);
        $clientTable = new RequestExecuter(Personnes::class);
        var_dump($clientRequest);
        $Client = $clientTable->ExecuteUpdate($clientRequest, $ClientMAJ);

    }
}