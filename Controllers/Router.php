<?php


namespace Controllers;


class Router
{
	private $_delimiter = '/'; // délimiteur séparant le controleur de l'action dans l'url
	private $_pageGetter = "page";
	private $_defaultPage = "Home/Home";

	private $_controller;
	private $_action;

	/**
	 * Permet de router une url vers un controleur
	 * @param string $page Url de la page à charger
	 */
	public function Route(string $page): void{
		if(!isset($page) || empty($page)) {
			$this->_controller = "Home";
			$this->_action = "Home";
		}

		$page = explode($this->_delimiter, $page); // on sépare l'url grâce aux .

		$this->_controller = '\Controllers\Pages\\' . ucfirst($page[0]); // génère le nom et le namespace du controleur à appeler
		$this->_action = ucfirst($page[1]); // la page à afficher correspond au 2e élément

		$this->Instantiate();
	}


	/**
	 * Instancie un controleur et appelle son action
	 */
	public function Instantiate(){
		if(class_exists($this->_controller)){
			$this->_controller = new $this->_controller(); // instancie le controleur
			if(method_exists ($this->_controller, $this->_action))
				$this->_controller->{$this->_action}(); // appelle la méthode affichant la page
		}
	}
}