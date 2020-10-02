<?php

use Controllers\Authentification\Security;
use Controllers\Autoloader;

define ('ROOT', dirname(__DIR__) . '/Todo/');
require ROOT . 'Controllers/Autoloader.php';
Autoloader::register();

$s = new Security();
echo $s->Hash("coucou");

new \Controllers\Database\Database();