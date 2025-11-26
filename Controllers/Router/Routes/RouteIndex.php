<?php
namespace Controllers\Router\Routes;

use Controllers\MainController;

class RouteIndex extends Route
{
    public function __construct(MainController $controller)
    {
        parent::__construct($controller);
    }

    protected function get(array $params): void
    {
        $this->controller->index($params['message'] ?? null);
    }

    protected function post(array $params): void
    {
        $this->get($params);
    }
}
