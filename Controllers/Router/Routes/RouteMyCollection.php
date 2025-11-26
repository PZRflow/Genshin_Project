<?php
namespace Controllers\Router\Routes;

use Controllers\PersonnageController;

class RouteMyCollection extends Route
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
        $this->controller->displayCollection();
    }

    protected function post(array $params): void
    {
        // Pas de formulaire POST sur cette page
        $this->get($params);
    }
}