<?php


namespace Controllers\Parts;


class Alert extends BaseParts
{
	private $__type; // type de l'alerte
	private $__message; // message à afficher
	protected $_filePart = "alert"; // fichier de vue à afficher

	public static $Warning = "warning";
	public static $Error = "danger";
	public static $Success = "success";
	public static $Information = "primary";

	public function __construct2($type, $message){
		$this->__type = $type;
		$this->__message = $message;
	}


	/**
	 * Affiche le code HTML de l'alerte
	 */
	public function Display(){
		extract($this->GetThisAttributes());
		$this->AddPart($this->_filePart, compact('type', 'message'));
	}

	/**
	 * @return array Retourne la liste des propriétés de l'objet
	 */
	protected function GetInternalAttributes() : array{
		return get_object_vars($this);
	}
}