<?php


namespace Models;


use function strlen;

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

	/**
	 * Cast un objet en une classe
	 * @param object $instance Objet par défaut à caster
	 * @param string $className Classe de destination (avec namespace)
	 * @return mixed Retourne une instance hydratée de l'objet demandé
	 */
	public static function Cast(object $instance, string $className)	{
		return unserialize(sprintf(
			'O:%d:"%s"%s',
			strlen($className),
			$className,
			strstr(strstr(serialize($instance), '"'), ':')
		));
	}

	/**
	 * Convertit un tableau associatif en model
	 * @param array $array Valeur à récupérer
	 * @return $this Retourne l'objet hydraté
	 */
	public function Array2Model(array $array){
		foreach ($array as $key => $value){ // parcourt le tableau
			if(property_exists($this, $key)) // si la propriété dans l'objet existe
				$this->$key = $value;
		}

		return $this;
	}
}