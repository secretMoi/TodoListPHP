<?php

namespace Controllers\Pages;

use Controllers\Application;
use Controllers\Database\RequestBuilder;
use Controllers\Database\RequestExecuter;
use Models\Gerer;
use Models\Todo;

class Home extends BaseController
{
	public function Home(){
		if(!isset($_SESSION['Id']))
			header('Location: ' .  Application::Instance()->Link('SignIn', 'Log'));

		// récupère toutes les tâches de la session
		$gererRequest = new RequestBuilder();
		$gererRequest->Select("*")
			->From(Gerer::class)
			->Where("IDPers", $_SESSION['Id']);
		$table = new RequestExecuter(Todo::class);
		$gerer = $table->Execute($gererRequest);

		$taches = array();
		$table = new RequestExecuter(Todo::class);
		foreach ($taches as $tache){
			array_push($taches, $table->Select($tache->ID));
		}

		$this->Render("home", compact('taches'));
	}

	public function Homes(){
		$this->Render("homes");
	}
}