<?php
namespace Controllers\Router\Routes;

use Exception;

abstract class Route
{
    protected $controller;

    public function __construct($controller)
    {
        $this->controller = $controller;
    }

    // Méthode principale pour traiter la requête
    public function action(array $params = []): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->post($params);
        } else {
            $this->get($params);
        }
    }

    // Récupère un paramètre de la requête
    protected function getParam(array $array, string $paramName, bool $canBeEmpty = true): string
    {
        if (!isset($array[$paramName])) {
            throw new Exception("Paramètre '$paramName' absent.");
        }
        if (!$canBeEmpty && empty($array[$paramName])) {
            throw new Exception("Paramètre '$paramName' vide.");
        }
        return $array[$paramName];
    }

    // Méthodes à implémenter dans les classes filles
    abstract protected function get(array $params): void;
    abstract protected function post(array $params): void;
}
