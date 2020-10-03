<?php

use Controllers\Application;
use Controllers\Authentification\Security;
use Controllers\Database\Table;
use Controllers\Router;


// trouve le dossier courant
define ('ROOT', dirname(__DIR__) . '/Todo/');
require ROOT . 'Controllers/Application.php';
Application::Instance();

$router = new Router(); // init le routeur
$router->Route($_GET); // lui donne la page de l'url

// génération d'un hash de sécurité
$s = new Security();
//echo $s->Hash("coucou");

$table = new Table("Personnes"); // objet pour manipuler la table Personne
//var_dump($table->Select(1)); // récupère l'id 0 de la table personne
//var_dump($table->SelectAll()); // récupère tous les enregistrements de la table personne