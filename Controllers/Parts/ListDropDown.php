<?php

namespace Controllers\Parts;

class ListDropDown extends BaseParts
{
	private $_filePart = "ListDropDown"; // fichier de vue à afficher
	private $__elements; // données à afficher
	private $__name; // nom de la liste

	public function __construct1($name){
		$this->__name = $name;
	}

	/**
	 * Rempli la ListDropDown avec des éléments
	 * @param array $elements Eléments à insérer
	 */
	public function Fill(array $elements) : void{
		$this->__elements = $elements;
	}

	/**
	 * Affiche la ListDropDown avec les données déjà entrées
	 */
	public function Display() : void{
		$this->Elements($this->__elements);
	}

	/**
	 * Affiche directement la partie avec ses arguments
	 * @param array $elementList Eléments à afficher dans la liste
	 */
	public function Elements(array $elementList) : void{
		$this->Fill($elementList);
		extract($this->GetThisAttributes());
		$this->AddPart($this->_filePart, compact('elements', 'name'));
	}

	/**
	 * @return array Retourne la liste des propriétés de l'objet
	 */
	protected function GetInternalAttributes() : array{
		return get_object_vars($this);
	}
}