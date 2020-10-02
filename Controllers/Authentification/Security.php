<?php

namespace Controllers\Authentification;

class Security
{
	private $_hashMethod = "sha256";

	public function GetHash(){
		return $this->_hashMethod;
	}

	public function Hash($string){
		return hash($this->_hashMethod, $string);
	}
}