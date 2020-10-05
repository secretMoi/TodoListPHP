<?php

use Controllers\Application;
use Controllers\Authentification\Security;
use Controllers\Database\RequestBuilder;
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