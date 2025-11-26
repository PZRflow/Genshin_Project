<?php
namespace Controllers\Router\Routes;

use Controllers\AuthController;

class RouteLogout extends Route
{
    public function __construct(AuthController $controller)
    {
        parent::__construct($controller);
    }

    // Déconnecte l'utilisateur (GET ou POST)
    protected function get(array $params): void
    {
        $this->controller->logout();
    }

    protected function post(array $params): void
    {
        $this->get($params);
    }
}
