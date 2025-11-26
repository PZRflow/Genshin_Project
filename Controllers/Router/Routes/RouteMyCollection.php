<?php
namespace Controllers\Router\Routes;

use Controllers\PersonnageController;

class RouteMyCollection extends Route
{
    /**
     * Constructeur de la route de visualisation de la collection personnelle.
     *
     * @param PersonnageController $controller Contrôleur de gestion des personnages.
     */
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
        $this->get($params);
    }
}