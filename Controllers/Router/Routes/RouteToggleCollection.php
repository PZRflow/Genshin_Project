<?php
namespace Controllers\Router\Routes;

use Controllers\PersonnageController;

class RouteToggleCollection extends Route
{
    /**
     * @var PersonnageController
     */
    protected $controller;

    public function __construct(PersonnageController $controller)
    {
        parent::__construct($controller);
    }

    protected function get(array $params): void
    {
        // Le contrôleur se débrouille pour récupérer l'ID (via $_GET)
        $this->controller->toggleCollection();
    }

    protected function post(array $params): void
    {
        $this->get($params);
    }
}