<?php

// 1. Chargement de l'autoloader
require_once 'Helpers/Psr4AutoloaderClass.php';

use Helpers\Psr4AutoloaderClass;
use League\Plates\Engine;
use Controllers\Router\Router; // On utilise ta nouvelle classe Router

// 2. Configuration de l'autoloader
$loader = new Psr4AutoloaderClass();
$loader->register();
$loader->addNamespace('Helpers', 'Helpers');
$loader->addNamespace('League\Plates', 'Vendor/plates-3.5.0/src');
$loader->addNamespace('Controllers', 'Controllers');
$loader->addNamespace('Config', 'Config');
$loader->addNamespace('Models', 'Models');
$loader->addNamespace('Services', 'Services');
$loader->addNamespace('Exceptions', 'Exceptions');

// 3. Démarrage de la session
session_start();

// 4. Initialisation du moteur de template
$templates = new Engine('Views');

try {
    // 5. Instanciation du Routeur
    // Le routeur va s'occuper de créer les Contrôleurs, les Services et les DAO tout seul (voir ton Router.php)
    $router = new Router($templates);

    // 6. Lancement du routage
    // Il analyse l'URL ($_GET) et les données envoyées ($_POST) pour trouver la bonne route
    $router->routing($_GET, $_POST);

} catch (Exception $e) {
    // Gestion globale des erreurs si le routeur échoue
    echo "<h1>Erreur critique</h1>";
    echo "<p>" . $e->getMessage() . "</p>";
    echo "<a href='index.php'>Retour à l'accueil</a>";
}