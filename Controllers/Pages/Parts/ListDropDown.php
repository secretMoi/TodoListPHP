<?php

namespace Controllers\Pages\Parts;

use Controllers\Pages\BaseController;

class ListDropDown extends BaseController
{
	private $_filePart = "ListDropDown"; // fichier de vue à afficher
	private $_elements; // données à afficher

	/**
	 * Permet d'avoir plusieurs constructeurs
	 */
	public function __construct()
	{
		$arguments = func_get_args();
		$numberOfArguments = func_num_args();

		if (method_exists($this, $function = '__construct'.$numberOfArguments)) {
			call_user_func_array(array($this, $function), $arguments);
		}
	}

	public function __construct1($elements){
		$this->Fill($elements);
	}

	/**
	 * Rempli la ListDropDown avec des éléments
	 * @param array $elements Eléments à insérer
	 */
	public function Fill(array $elements) : void{
		$this->_elements = $elements;
	}

	/**
	 * Affiche la ListDropDown avec les données déjà entrées
	 */
	public function Display() : void{
		$this->Elements($this->_elements);
	}

	/**
	 * Affiche directement la partie avec ses arguments
	 * @param array $elements Eléments à afficher dans la liste
	 */
	public function Elements(array $elements) : void{
		$this->AddPart($this->_filePart, $elements);
	}
}