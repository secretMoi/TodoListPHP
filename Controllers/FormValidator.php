<?php


namespace Controllers;


class FormValidator
{
	/**
	 * Vérifie que les champs d'un tableau soit initialisés
	 * @param array $tab Tableau à vérifier
	 * @param array $names CHamps à vérifier
	 * @return bool true si tous les champs sont initialisés, false sinon
	 */
	public static function IsSet(array $tab, array $names) : bool{
		foreach ($names as $name)
			if(!isset($tab[$name]))
				return false;

		return true;
	}
}