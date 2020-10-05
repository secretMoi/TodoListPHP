<?php


namespace Controllers;


use Controllers\Database\Database;
use PDO;

/**
 * Class Application
 * Gère toute la configuration du programme
 * @package Controllers
 */
class Application
{
	public $title = "La todo à gougoune";

	private $_database; // stocke la database
	private static $Instance; // instance de App comme singleton

	private $_css = "Views/css/bootstrap-slate.css";
	private $_menu = "Views/Parts/navbar.php";

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
	 * @return string Retourne le chemin du fichier CSS à utiliser pour les vues
	 */
	public function GetCss() : string{
		return str_replace('\\', '/', $this->_css);
	}

	/**
	 * @return string Retourne le chemin du fichier de menu à afficher
	 */
	public function GetMenu() : string{
		return $this->_menu;
	}
}