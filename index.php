<?php

use Controllers\Application;
use Controllers\Authentification\Security;
use Controllers\Database\Table;
use Controllers\Router;
use Models\BaseModel;
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
$personneTable = new Table(Personnes::class);

$todo = new Todo("a", 'z', 'e', 'f', 'g');

$idPers = $personneTable->Select(7);
$idPers = BaseModel::Cast($idPers, Personnes::class);

$idTodo = $todoTable->Select(1);
$idTodo = BaseModel::Cast($idTodo, Todo::class);
$gerer = new Gerer($idPers->ID, $idTodo->ID);


//$todoTable->Insert($todo);
//$gererTable->Insert($gerer);

/*$model->Nom = "a";
$model->Prenom = "az";*/
//$table->Insert($personne);
//var_dump($table->Select(1)); // récupère l'id 0 de la table personne
//var_dump($table->SelectAll()); // récupère tous les enregistrements de la table personne