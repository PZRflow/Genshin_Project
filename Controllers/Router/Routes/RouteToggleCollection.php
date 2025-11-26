<?php
namespace Controllers\Router\Routes;

use Controllers\PersonnageController;

class RouteToggleCollection extends Route
{
    /**
     * Constructeur de la route d'ajout/retrait de collection.
     *
     * @param PersonnageController $controller Contrôleur de gestion des personnages.
     */
    public function __construct(PersonnageController $controller)
    {
        parent::__construct($controller);
    }

    protected function get(array $params): void
    {
        $this->controller->toggleCollection();
    }

    protected function post(array $params): void
    {
        $this->get($params);
    }
}