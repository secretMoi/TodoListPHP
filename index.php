<?php

use Controllers\Application;
use Controllers\Database\RequestBuilder;
use Controllers\Router;


// trouve le dossier courant
define ('ROOT', dirname(__DIR__) . '/Todo/');
require ROOT . 'Controllers/Application.php';
Application::Instance();

$router = new Router(); // init le routeur
$router->Route($_GET); // lui donne la page de l'url

$req = new RequestBuilder();
$req->Select("coucou", "test")
	->From("tyty")
	->WhereId(5);

//var_dump($req);