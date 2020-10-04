<?php

use Controllers\Application;
use Controllers\Authentification\Security;
use Controllers\Database\Table;
use Controllers\Router;
use Models\Gerer;
use Models\Personnes;
use Models\Todo;


// trouve le dossier courant
define ('ROOT', dirname(__DIR__) . '/Todo/');
require ROOT . 'Controllers/Application.php';
Application::Instance();

$router = new Router(); // init le routeur
$router->Route($_GET); // lui donne la page de l'url

// génération d'un hash de sécurité
$s = new Security();
//echo $s->Hash("coucou");

$todoTable = new Table(Todo::class);
$gererTable = new Table(Gerer::class);

$todo = new Todo("a", 'z', 'e', 'f', 'g');
$gerer = new Gerer('q', 's');



/*$model->Nom = "a";
$model->Prenom = "az";*/
//$table->Insert($personne);
//var_dump($table->Select(1)); // récupère l'id 0 de la table personne
//var_dump($table->SelectAll()); // récupère tous les enregistrements de la table personne