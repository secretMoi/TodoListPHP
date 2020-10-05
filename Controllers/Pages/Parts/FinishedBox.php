<?php

namespace Controllers\Pages\Parts;

class FinishedBox extends BaseParts
{
	private $_filePart = "Boxes/Finished"; // fichier de vue à afficher
	private $__header; // données à afficher
	private $__title; // données à afficher
	private $__content; // données à afficher

	/**
	 * @param string $header Header à placer dans la FinishedBox
	 * @param string $title Titre à placer dans la FinishedBox
	 * @param string $content Contenu à placer dans la FinishedBox
	 */
	public function __construct3(string $header, string $title, string $content){
		$this->Header($header);
		$this->Title($title);
		$this->Content($content);
	}

	/**
	 * @param string $header Header à placer dans la FinishedBox
	 * @return string Retourne le Header de la FinishedBox
	 */
	public function Header(string $header) : string{
		$this->__header = $header;
		return $this->__header;
	}

	/**
	 * @param string $title Titre à placer dans la FinishedBox
	 * @return string Retourne le Titre de la FinishedBox
	 */
	public function Title(string $title) : string{
		$this->__title = $title;
		return $this->__title;
	}

	/**
	 * @param string $content Contenu à placer dans la FinishedBox
	 * @return string Retourne le contenu de la FinishedBox
	 */
	public function Content(string $content) : string{
		$this->__content = $content;
		return $this->__content;
	}

	/**
	 * Affiche la partie FinishedBox
	 */
	public function Display() : void{
		extract($this->GetThisAttributes());
		$this->AddPart($this->_filePart, compact('header', 'title', 'content'));
	}

	/**
	 * Affiche directement la partie avec ses arguments
	 * @param array $elements Eléments à afficher dans la liste
	 */
	public function Elements(array $elements) : void{
		$this->AddPart($this->_filePart, array($elements));
	}

	/**
	 * @return array Retourne la liste des propriétés de l'objet
	 */
	protected function GetInternalAttributes() : array{
		return get_object_vars($this);
	}
}