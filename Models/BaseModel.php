<?php


namespace Models;


class BaseModel
{
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

	/**
	 * Associe les colonne d'un enregistrement de la bdd dans nos modèles
	 * @param array $fields
	 */
	public function Hydrate(array $fields)
	{
		foreach ($fields as $key => $value) // parcourt le tableau des champs
			$this->$key = $value;
	}
}