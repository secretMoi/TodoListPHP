<?php


namespace Controllers;


use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class Router
{
	private $_delimiter = '/'; // délimiteur séparant le controleur de l'action dans l'url
	private $_pageGetter = "page"; // élément du get qui sera cherché pour l'url
	private $_defaultPage; // page par défaut à appeler

	private $_controller;
	private $_action;

	private static $Files = null;

	public function __construct()
	{
		$this->_defaultPage = "Home{$this->_delimiter}Home";
		$this->LoadClasses();
	}

	public function Link(string $prefix, ?string $controller, ?string $action) : string{
		if($controller == null || $action == null)
			return "{$prefix}";
		else
			return "{$prefix}?{$this->_pageGetter}={$controller}{$this->_delimiter}{$action}";
	}

	/**
	 * Charge toutes les classes des contrôleurs de page
	 */
	private function LoadClasses(){
		if(self::$Files == null)
			self::$Files = new RecursiveDirectoryIterator(ROOT . 'Controllers/Pages/');
	}

	/**
	 * Trouve le namespace complet d'un controleur selon le nom de la classe
	 * @param string $className Nom de la classe à trouver
	 * @return string Namespace complet de la classe
	 */
	private function FindClass(string $className) : string {
		$res = null;

		// Loop through files
		foreach(new RecursiveIteratorIterator(self::$Files) as $file) {
			if ($file->getExtension() == 'php' && strpos($file, $className) !== false) {
				$res = (string) $file;
				$res = strstr($res, '/Controllers'); // supprime ce qui est avant /Controllers
				$res = str_replace('/', '\\', $res); // converti les / en \
				$res = strstr($res, '.php', true); // supprime l'extension
			}
		}

		return $res;
	}

	/**
	 * Génère la page par défaut
	 */
	private function DefaultPage(){
		list($controller, $action) = $this->SeparateUrl($this->_defaultPage);
		$this->_controller =  $this->FormatController($controller);
		$this->_action = $this->FormatAction($action);
	}

	/**
	 * Permet de router une url vers un controleur
	 * @param array $page Url de la page à charger
	 */
	public function Route(array $page): void{
		// si aucune page n'est passée en paramètre
		if(!isset($page[$this->_pageGetter])){
			$this->DefaultPage(); // va sur la page par défaut
			$this->Instantiate();
			return;
		}

		$page = $page[$this->_pageGetter]; // récupère l'url de la page demandée

		list($controller, $action) = $this->SeparateUrl($page);
		$this->_controller = $this->FormatController($controller);
		$this->_action = $this->FormatAction($action); // la page à afficher correspond au 2e élément

		$this->Instantiate();
	}

	/**
	 * Explose une url
	 * @param string $url Url à séparer
	 * @return array Tableau contenant toutes les valeurs séparées
	 */
	private function SeparateUrl(string $url) : array {
		return explode($this->_delimiter, $url); // on sépare l'url grâce aux /
	}

	/**
	 * Génère le chemin d'un controleur
	 * @param string $controller Controleur à instancier
	 * @return string Retourne le namespace complet du controleur
	 */
	private function FormatController(string $controller) : string{
		return $this->FindClass(ucfirst($controller));
	}

	/**
	 * Génère le nom de l'action
	 * @param string $action Nom de base de l'action à exécuter
	 * @return string Retourne le nom de l'action
	 */
	private function FormatAction(string $action) : string{
		return ucfirst($action); // génère le nom et le namespace du controleur à appeler
	}

	/**
	 * Instancie un controleur et appelle son action
	 */
	public function Instantiate(){
		if(class_exists($this->_controller)){ // si le controleur existe
			$this->_controller = new $this->_controller(); // instancie le controleur
			if(method_exists ($this->_controller, $this->_action)) // si l'action existe
				$this->_controller->{$this->_action}(); // appelle la méthode affichant la page
		}
	}
}