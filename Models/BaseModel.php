<?php


namespace Models;


class BaseModel
{

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