<?php


namespace Controllers\Pages\Parts;


use Controllers\Pages\BaseController;

abstract class BaseParts extends BaseController
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
	 * Permet de générer la liste des attributs à transmettre à la vue commencant par '__'
	 * @return array La liste des attributs
	 */
	protected function GetThisAttributes() : array{
		$attributes = $this->GetInternalAttributes(); // récupère la liste des attributes internes à l'objet
		$return = array(); // tableau de retour

		foreach ($attributes as $key => $value){ // parcourt tous les attributes d'un objet
			if(strpos($key, '__') === 0){ // si le nom de l'attribut commence par '__'
				$key = ltrim($key, '__'); // supprime les '__' du début
				$return[$key] = $value; // ajoute au tableau de retour
			}
		}

		return $return;
	}

	/**
	 * @return array Retourne la liste des propriétés de l'objet
	 */
	abstract protected function GetInternalAttributes();
}