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
		$table = new RequestExecuter(Gerer::class);
		$gerer = $table->Execute($gererRequest);

		$taches = array();
		foreach ((array) $gerer as $gererItem){
			$tache = (new RequestExecuter(Todo::class))->Select($gererItem->IDTodo);

			array_push($taches, $tache);
		}

		$this->Render("home", compact('taches'));
	}

	public function Homes(){
		$this->Render("homes");
	}
}