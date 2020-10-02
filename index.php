<?php

use Controllers\Application;
use Controllers\Authentification\Security;
use Controllers\Database\Table;

// trouve le dossier courant
define ('ROOT', dirname(__DIR__) . '/Todo/');
require ROOT . 'Controllers/Application.php';
Application::Instance();

// génération d'un hash de sécurité
$s = new Security();
echo $s->Hash("coucou");

$table = new Table("Personnes"); // objet pour manipuler la table Personne
var_dump($table->Select(0)); // récupère l'id 0 de la table personne
var_dump($table->SelectAll()); // récupère tous les enregistrements de la table personne