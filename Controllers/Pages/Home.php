<?php

namespace Controllers\Pages;

class Home extends BaseController
{
	public function Home(){
		$coucou = "coucou";
		$this->Render("home", compact($coucou));
	}
}