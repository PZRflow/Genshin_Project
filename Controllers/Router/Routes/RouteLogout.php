<?php
namespace Controllers\Router\Routes;

use Controllers\AuthController;

class RouteLogout extends Route
{
    /**
     * Constructeur de la route de déconnexion.
     *
     * @param AuthController $controller Contrôleur d'authentification.
     */
    public function __construct(AuthController $controller)
    {
        parent::__construct($controller);
    }

    protected function get(array $params): void
    {
        $this->controller->logout();
    }

    protected function post(array $params): void
    {
        $this->get($params);
    }
}