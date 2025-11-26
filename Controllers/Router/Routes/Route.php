<?php
namespace Controllers\Router\Routes;

use Exception;

abstract class Route
{
    protected $controller;

    /**
     * Constructeur de la route abstraite.
     *
     * @param object $controller Le contrôleur associé à cette route.
     */
    public function __construct($controller)
    {
        $this->controller = $controller;
    }

    /**
     * Détermine la méthode HTTP (GET ou POST) et appelle la fonction correspondante.
     *
     * @param array $params Les paramètres de la requête.
     * @return void
     */
    public function action(array $params = []): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->post($params);
        } else {
            $this->get($params);
        }
    }

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

    abstract protected function get(array $params): void;
    abstract protected function post(array $params): void;
}