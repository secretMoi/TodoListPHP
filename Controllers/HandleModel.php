<?php


namespace Controllers;


use Models\BaseModel;

class HandleModel
{
	private static $_path = "\Models\\"; // charge les classes dans le namespace Models

	public static function LoadModel(string $modelName) : ?BaseModel{
		$modelName = self::$_path . $modelName; // concatène le namespace avec le nom de la classe

		if(class_exists($modelName)) // si la classe existe
			return new $modelName(); // retourne une nouvelle instance de la classe

		return null;
	}
}