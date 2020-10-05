<?php

namespace Controllers\Pages\Parts;

use Controllers\Pages\BaseController;

class FinishedBox extends BaseController
{
	private $_filePart = "Boxes/Finished"; // fichier de vue à afficher
	private $__header; // données à afficher
	private $__title; // données à afficher
	private $__content; // données à afficher

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

	public function __construct3(string $header, string $title, string $content){
		$this->Header($header);
		$this->Title($title);
		$this->Content($content);
	}

	private function GetThisAttributes() : array{
		$attributes = get_object_vars($this);
		$return = array();

		foreach ($attributes as $key => $value){
			if(strpos($key, '__') === 0){
				$key = ltrim($key, '__');
				$return[$key] = $value;
			}

		}

		return $return;
	}

	public function Header(string $header) : string{
		$this->__header = $header;
		return $this->__header;
	}

	public function Title(string $title) : string{
		$this->__title = $title;
		return $this->__title;
	}

	public function Content(string $content) : string{
		$this->__content = $content;
		return $this->__content;
	}

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
}