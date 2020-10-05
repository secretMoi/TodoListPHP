<?php

namespace Controllers\Pages;

class Home extends BaseController
{
	public function Home(){
		$coucou = "coucou";
		$this->Render("home", compact($coucou));
	}

	public function Homes(){
		$this->Render("homes");
	}
}