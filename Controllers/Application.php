<?php


namespace Controllers;


use Controllers\Database\Database;
use Controllers\Parts\Alert;
use PDO;

/**
 * Class Application
 * Gère toute la configuration du programme
 * @package Controllers
 */
class Application
{
	public $title = "ToutDoux";

	private $_database; // stocke la database
	private static $Instance; // instance de App comme singleton

	public $Css = "Views/css/bootstrap-slate.css";
	private $_javascriptPath = "Views/Javascript/";
	public $Menu = "Views/Parts/menu.php";
	public $Navbar = "Views/Parts/navbar.php";

	private function __construct()
	{
		session_start();

		// autoloader des controllers
		require ROOT . 'Controllers/Autoloader.php';
		Autoloader::register();

		// autoloader des models
		require ROOT . 'Models/Autoloader.php';
		\Models\Autoloader::register();

		$this->_database = new Database(); // connexion à la db
	}

	/**
	 * @return Application L'instance du Singleton
	 */
	public static function Instance() { // Singleton pour 1 seule instance comme statique mais plus simple à hériter et construire
		if(is_null(self::$Instance)) // si l'instance n'est pas encore définie
			self::$Instance = new Application(); // on la définit

		return self::$Instance; // on retourne l'instance
	}

	/**
	 * @return PDO La connexion PDO
	 */
	public function Connection() : PDO{
		return $this->_database->GetConnection();
	}

	/**
	 * Génère un lien avec la configuration de routage
	 * @param string|null $controller Nom du controleur
	 * @param string|null $action Action du controleur à exécuter
	 * @param array $paramsGet Tableau associatif des paramètres pour transmettre des get
	 * @return string Renvoie l'url créée
	 */
	public function Link(?string $controller, ?string $action, array $paramsGet = []) : string{
		$router = new Router();
		return $router->Link("index.php", $controller, $action, $paramsGet);
	}

	/**
	 * Génère le chemin des fichiers js
	 * @param string $file Nom du fichier sans extension
	 * @return string Retourne le chemin complet du fichier js
	 */
	public function Javascript(string $file) : string{
		return $this->_javascriptPath . $file . ".js";
	}

	/**
	 * Ajoute une alerte
	 * @param Alert $alert Alerte à afficher
	 */
	public static function SetAlert(Alert $alert){
		$_SESSION["alerts"][] = $alert;
	}

	/**
	 * Retourne un tableau d'alertes
	 * @return array Tableau des alertes
	 */
	public static function GetAlerts() : array{
		if(empty($_SESSION['alerts']))
			return array();

		$result = $_SESSION["alerts"];
		unset($_SESSION['alerts']);
		return $result;
	}

	/**
	 * Vérifie si il y a des alertes
	 * @return bool true si il y a au moins une alerte, false sinon
	 */
	public static function AnyAlert() : bool{
		if(empty($_SESSION['alerts']))
			return false;

		return true;
	}

	public function IsAdmin() : bool{
		return
			!empty($_SESSION) && // si on est connecté
			$_SESSION['Role'] == 1 // si on est staff
			&& isset($_GET['page']) // si on demande une page
			&& strpos($_GET['page'], 'ControlPanel') !== false; // si on demande une page admin
	}
}