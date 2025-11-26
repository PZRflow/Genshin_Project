<?php

require_once 'Helpers/Psr4AutoloaderClass.php';

use Helpers\Psr4AutoloaderClass;
use League\Plates\Engine;
use Controllers\Router\Router;

$loader = new Psr4AutoloaderClass();
$loader->register();
$loader->addNamespace('Helpers', 'Helpers');
$loader->addNamespace('League\Plates', 'Vendor/plates-3.5.0/src');
$loader->addNamespace('Controllers', 'Controllers');
$loader->addNamespace('Config', 'Config');
$loader->addNamespace('Models', 'Models');
$loader->addNamespace('Services', 'Services');
$loader->addNamespace('Exceptions', 'Exceptions');

session_start();

$templates = new Engine('Views');

try {
    $router = new Router($templates);
    $router->routing($_GET, $_POST);

} catch (Exception $e) {
    echo "<h1>Erreur critique</h1>";
    echo "<p>" . $e->getMessage() . "</p>";
    echo "<a href='index.php'>Retour à l'accueil</a>";
}