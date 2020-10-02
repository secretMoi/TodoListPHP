<?php


namespace Controllers;


class HandleModel
{
	private static $_path = "\Models\\";

	public static function LoadModel(string $modelName){
		$modelName = self::$_path . $modelName;

		if(class_exists($modelName))
			$model = new $modelName(); // instancie le controleur

		return $model;
	}
}