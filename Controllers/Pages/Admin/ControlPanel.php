<?php

namespace Controllers\Pages\Admin;

use Controllers\Database\RequestBuilder;
use Controllers\Database\RequestExecuter;
use Controllers\Pages\BaseController;
use Models\Personnes;

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
            ->Where("Role","2");
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
            ->Where("Role","3");
        $personneTable = new RequestExecuter(Personnes::class);
        $Personnes = $personneTable->Execute($personnesRequest);

        $this->Render("Admin\LstTravailleurs", $Personnes);
    }



}