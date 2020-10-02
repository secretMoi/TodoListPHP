<?php

use Controllers\Authentification\Security;
use Controllers\Database\Database;
use Controllers\Database\Table;

// trouve le dossier courant
define ('ROOT', dirname(__DIR__) . '/Todo/');

// autoloader des controllers
require ROOT . 'Controllers/Autoloader.php';
Controllers\Autoloader::register();

// autoloader des models
require ROOT . 'Models/Autoloader.php';
Models\Autoloader::register();

// génération d'un hash de sécurité
$s = new Security();
echo $s->Hash("coucou");

$db = new Database(); // connexion à la db

// objet pour manipuler la table Personne
$table = new Table($db->GetConnection(), "Personnes");
var_dump($table->Select(0)); // récupère l'id 0 de la table personne
var_dump($table->SelectAll()); // récupère l'id 0 de la table personne