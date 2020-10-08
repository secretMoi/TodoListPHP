<?php

use Controllers\Application;
use Controllers\Database\RequestBuilder;
use Controllers\Database\RequestExecuter;
use Controllers\Router;
use Models\Personnes;


// trouve le dossier courant
define ('ROOT', dirname(__DIR__) . '/Todo/');
require ROOT . 'Controllers/Application.php';
Application::Instance();

$router = new Router(); // init le routeur
$router->Route($_GET); // lui donne la page de l'url

$req = new RequestBuilder();
$req->Select("*")
	->From(Personnes::class)
	->WhereId(9);

$table = new RequestExecuter(Personnes::class);
$res = $table->ExecuteSelect($req);
$res = \Models\BaseModel::Cast($res[0], Personnes::class);

$req = new RequestBuilder();

$req->Insert(Personnes::class, $res);
$req->Reset();
$req->Update(Personnes::class, $res)
	->WhereId(9);

$res->Nom = "coucou";

//var_dump($table->ExecuteUpdate($req, $res));

var_dump($table->Update($res));