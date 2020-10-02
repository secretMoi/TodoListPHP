<?php


namespace Models;


class BaseModel
{
	public function __get($key) { // pas besoin d'inclure le fichier, PHP trouvera les sous-fonctions grâce à la méthode magique
		$method = 'get' . ucfirst($key); // Génère un getter
		$this->$key = $this->$method(); // apelle la méthode correspondante au getter

		return $this->$key; // exécute
	}
}